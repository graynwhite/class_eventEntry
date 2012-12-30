<?php

Class eventEntry{
//==================================
/**
       *Begin Publishing Date
       *
       *The date that the publication first published
       *
*/
//===================================

private $Begin_publishing_date;// in time format default to may 31, 2003
private $current_publishing_date; // in time format
private $number_of_publishing_weeks;
private $mode = 'weekly';
private $volume; // first yeat published = 1
private $edition; // edition within Volume
private $dow;
private $years;
private $weeks;
private $plus_weeks;
private $todays_test_date = 0; // calculated or set
private $beginMonth;
private $beginDay;
private $beginYear;
private $editionFctr;
public  $day_of_week_array=array('SUN' => 0, 'MON' => 1, 'TUE' => 2, 'WED' => 3, 'THU' => 4, 'FRI' => 5, 'SAT' => 6);
public  $month_array=array('01' => 'January','02'=> 'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

	function setMode($modeInput){
	$this->mode = $modeInput;
	}
	function setTodaysTestDate($dateInput){
	$this->todays_test_date = $dateInput;
	}
	
  /**
  * valid email
  * @param   string
  * @return  boolean
  */
  function is_email($val)
  {
  return (bool)(preg_match("/^([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix",
  $val));
  }                	 
//==================================
/**
       *@param Date to be used in the form yyyy-mm-dd
       *@return week number of the year
       *
       *
*/
//===================================
function getWeekOfTheMonth($querydate)
{
$dateArray=explode('-',$querydate);
//print_r($dateArray);
$dateTimestamp = mktime(0,0,0,$dateArray[2],$dateArray[0],$dateArray[1]);
$dayOfMonth = $dateArray[2];
$d = date('j',$dateTimestamp);
$w = date('w',$dateTimestamp)+1; //add 1 because date returns value between 0 to 6
$dt= (floor($dayOfMonth % 7)!=0)? floor($dayOfMonth % 7) : 7;
$k = ($w-$dt);
$W= ceil(($dayOfMonth+$k)/7);
return $W ;
}
//==================================
/**
       *@param begining date and ending date in the form yyyy-dd-mm special is used to overide logic in this routine. 
       *@return the day of week
       *
       *
*/
//===================================


function get_dow($begin_date,$end_date,$special=null)

{
	
	$thisdate_array = explode('-',$begin_date);
	
	$thisstart = mktime(0,0,0,$thisdate_array[1],$thisdate_array[2],$thisdate_array[0]);
	if($begin_date === $end_date)
	{
		$thisdow= date('D',$thisstart);
		$thisdow = strtoupper($thisdow);
		return $thisdow;
	}else 
	{
		$thisdate_array = explode('-',$end_date);
		$thisend = mktime(0,0,0,$thisdate_array[1],$thisdate_array[2],$thisdate_array[0]);	
		$numberOfevent_days = $thisend-$thisstart;
		//echo "<br />Number of event seconds  = " . $numberOfevent_days . "<br />";
		$numberOfevent_days = round($numberOfevent_days/(60*60*24),0)+1;
		//echo "<br />Number of event days  = " . $numberOfevent_days . "<br />";
		if(($numberOfevent_days > 3) && (date('D',$thisstart!='Fri' && date('D',$thisstart!='Sat'))))
		{
		$thisdow = "mul";
		}else
			{
			if($numberOfevent_days > 3)
			{
				$thisdow="WE.";
			}else
				{
				$thisdow = "WE.";
				}
			
	}
	$thisdow = $special != null ? $special : $thisdow;
	return $thisdow;
	
	
	}
}
//==================================
/**
       *@param none
       *Sets the beginning date of the publication to
       *May 31, 2003 when constructed
       *
*/
//===================================
function eventEntry()
{
	$this->Begin_publishing_date = mktime(0,0,0,5,31,2003);
}
//==================================
/**
       *set begin publishing date
       *@param date in the form mm/dd/yy
       *
       *
*/
//===================================
function set_begin_publishing_date($date_input)
{
	$this->Begin_publishing_date = strtotime($date_input);
	
}
	//==================================
/**
       *Get publication dates
	   *@param $day_ofWeek The day of week
       * that the publication will cover
       *@param $ptr Null indicates upcoming week 
       *@return an array of dates including a volume sesignation
	   * such as Volume:10 Issue: 21
*/
	function getNextMonthDate($day_of_month){
	evententry::calcBeginDate();
	
	$Timestamp = mktime(0,0,0,$this->beginMonth+1,$this->beginDay,$this->beginYear);
	
	$this->current_publishing_date = $Timestamp;
	evententry::setVolumeNumber();
	
	$datebegin = date('Y',$Timestamp) . '-' . date('m',$Timestamp). '-' . $day_of_month;
	$Timestamp2 = mktime(0,0,0,date('m',$Timestamp)+1,date('d',$Timestamp)-1,date('Y',$Timestamp));
	$dateEnd = date('Y',$Timestamp) . '-' . date('m',$Timestamp). '-' . date('t',$Timestamp);
	$pubdate = date("F",$Timestamp) . ', ' . date('Y',$Timestamp);
	
	$dates = array('date_begin' => $datebegin,
	'date_end' => $dateEnd,
	'years' => $this->years,
	'plus_weeks' => $this->plus_weeks,
	 'pubdate' => $pubdate);
	return $dates;
	
	}
//===================================
	function setVolumeNumber(){
	
	//==================================
/**
       *$difference computes the number of SECONDS between the first
       * publication and this publication
       * then the number of weeks is computed by getting
	   * the floor of difference divided by 86400 (seconds in a day) 
       * times 7
	   * Then years is computed by dividing weeks by 52.
	   * Then plus weeks is the number of weeks  in the current year
	   * Years is the bumped up by 1 to adjust volume to reflect
	   * the fact that the first volume would be zero.
*/
//===================================
	$difference = $this->current_publishing_date - $this->Begin_publishing_date;
	
	if ($this->mode == 'weekly'){
	$this->weeks = floor($difference/(7*86400));
	$this->years = floor($this->weeks/52);
	$this->plus_weeks = $this->weeks -($this->years *52) + 1;
	$this->years ++;
	}
	if ($this->mode == 'monthly'){
	$yearNow= date('Y',$this->current_publishing_date);
	$yearStarted = date('Y',$this->Begin_publishing_date);
	$this->years = $yearNow-$yearStarted;
	$this->plus_weeks = date('m',$this->current_publishing_date);
	}
	}

//===================================
	function calcBeginDate(){
	$this->beginMonth = date("m");
		$this->beginDay= date("d");
		$this->beginYear = date("Y");
		$this->editionfctr = 0;
		if(is_null($ptr)) // ptr is used to get previous week or future week
		{
			$this->editionFctr = 0;
		}else{
		$this->editionFctr= 7*$ptr;
		}
	if($this->todays_test_date != 0){
	$workArray = explode('/',$this->todays_test_date);
	$this->beginMonth = $workArray[0];
	$this->beginDay = $workArray[1];
	$this->beginYear = $workArray[2];
	}	
		
	$Timestamp = mktime(0,0,0,$this->beginMonth,$this->beginDay+$this->editionFctr,$this->beginYear); // sets the timestamp to today or one week prior or one wwk in the future.

	}
//===================================
	
	function getNextWeekDay($day_of_week, $ptr=null ){
	  	evententry::calcBeginDate();
	
	    
		
/**
       *if $ptr is null it will be set ot 0
       * so the upcoming week's events will be extracted
       * from the database, otherwise $ptr will be multiplied 
       * by 7 to select future weeks or past weeks
*/
//===================================
			
	$day_fctr=0;
		if (date("w",$Timestamp) >= $day_of_week_array[$day_of_week]){
		$day_fctr = 1;
	}
		
	//echo("<br> Day factor  " . $day_fctr);	
	for ($i=0;$i<7;$i++)
	{
    $Timestamp = mktime(0,0,0,$this->beginMonth,$this->beginDay+$i+$fctr+day_fctr,$this->beginYear);
	$this_day = date("D",$Timestamp);
   //echo"<br> this day is $this_day" ;
    if ( $this_day == $day_of_week ){
        break;
    }
}
	$this->current_publishing_date = $Timestamp;
	evententry::setVolumeNumber();
		
    $datebegin = date('Y',$Timestamp) . "-" . date('m',$Timestamp) . "-" . date('d',$Timestamp);
	$pubdate = date("F",$Timestamp) . ' ' . date('j',$Timestamp) . ', ' . date('Y',$Timestamp);
	$pubdate1= strtoupper(date('D',$Timestamp)) . '. ' . date('M',$Timestamp) . '. ' . date('j',$Timestamp);
	$selectdate1 = date('Y',$Timestamp) . '-' . date('m',$Timestamp) . '-' . date('d',$Timestamp);
	$Month= date('m',$Timestamp);
	$Day = date('d',$Timestamp);
	$Year = date('Y',$Timestamp);
	
	$editiondate = $Month . "-" . $Day . "-" . $Year;
	$day2 = mktime(0,0,0,$Month,$Day+1,$Year);
	$pubdate2 = strtoupper(date('D',$day2)) . '. ' . date('M',$day2) . '. ' . date('j',$day2);
	$selectdate2 = date('Y',$day2) . '-' . date('m',$day2) . '-' . date('d',$day2);
	
	$day3 = mktime(0,0,0,$Month,$Day+2,$Year);
	$pubdate3 = strtoupper(date('D',$day3)) . '. ' . date('M',$day3) . '. ' . date('j',$day3);
	$selectdate3 = date('Y',$day3) . '-' . date('m',$day3) . '-' . date('d',$day3);
	
	$day4= mktime(0,0,0,$Month,$Day+3,$Year);
	$pubdate4 = strtoupper(date('D',$day4)) . '. ' . date('M',$day4) . '. ' . date('j',$day4);
	$selectdate4 = date('Y',$day4) . '-' . date('m',$day4) . '-' . date('d',$day4);
	
	$day5 = mktime(0,0,0,$Month,$Day+4,$Year);
	$pubdate5 = strtoupper(date('D',$day5)) . '. ' . date('M',$day5) . '. ' . date('j',$day5);
	$selectdate5 = date('Y',$day5) . '-' . date('m',$day5) . '-' . date('d',$day5);
	
	$day6 = mktime(0,0,0,$Month,$Day+5,$Year);
	$pubdate6 = strtoupper(date('D',$day6)) . '. ' . date('M',$day6) . '. ' . date('j',$day6);
	$selectdate6 = date('Y',$day6) . '-' . date('m',$day6) . '-' . date('d',$day6);
	
	$day7 = mktime(0,0,0,$Month,$Day+6,$Year);
	$pubdate7 = strtoupper(date('D',$day7)) . '. ' . date('M',$day7) . '. ' . date('j',$day7);
	$selectdate7 = date('Y',$day7) . '-' . date('m',$day7) . '-' . date('d',$day7);
	
	$day8 = mktime(0,0,0,$Month,$Day+7,$Year);
	$pubdate8 = strtoupper(date('D',$day8)) . '. ' . date('M',$day8) . '. ' . date('j',$day8);
	$selectdate8 = date('Y',$day8) . '-' . date('m',$day8) . '-' . date('d',$day8);
	
	
		
    $LastDay = mktime(0,0,0,$Month,$Day+7,$Year);
	$Month = date("m",$LastDay);
	$Day= date("d",$LastDay);
	$Year = date("Y",$LastDay);
	$dateend =$Year . "-" . $Month . "-" . $Day;
	
	$dates = array('date_begin' => $datebegin, 'date_end' => $dateend ,'pubdate' => $pubdate,
	'pubdate1' => $pubdate1,
	'pubdate2' => $pubdate2, 'pubdate3' => $pubdate3 , 'pubdate4' => $pubdate4, 'pubdate5' => $pubdate5, 'pubdate6' => $pubdate6, 'pubdate7' => $pubdate7,
	'select1' => $selectdate1, 'select2' => $selectdate2, 'select3' => $selectdate3,
	'select4' => $selectdate4, 'select5' => $selectdate5, 'select6' =>$selectdate6, 'select7' => $selectdate7, 
	'select8' => $selectdate8,
	 'weeks' => $this->weeks,
	 'years' => $this->years,
	 'plus_weeks' => $this->plus_weeks);
	  
	//echo "<br> date begin in class is " . $datebegin . " and end date " . $dateend ;
	return $dates;	
	} // end of function get Next Week Day

//==================================
/**
       *@param day in the form of 'Mon', 'Tue', 'Wke'
       * expands day 
       *
       *
*/
//===================================
function convert_dow($day)
{
	$newday = "Unknown";
	Switch($day){
		case "MON" :
		case "Mon":
		$newday = "Monday";
		break;
	case "TUE":
	case "Tue":
		$newday = "Tuesday";
		break;
	case "WED":
	case"Wed" :
		$newday = "Wednesday";
		break;	
	case "THU":
	case "Thu" :
		$newday = "Thursday";
		break;	
	case "FRI":
	case "Fri":
		$newday = "Friday";
		break;
	case "SAT":
	case "Sat" :
		$newday = "Saturday";
		break;
	case "SUN":
	case "Sun":
		$newday = "Sunday";
		break;
	case "WE.":
		$newday = "Weekend of ";
		break;
	case "WK.":
		$newday = "Week of ";
		break;	
	default:
		$newday = $day;
		break;
		
	}
	return $newday;
}
//==================================
/**
       *@param an email address
       *@return true if valid false if invalid
	   *@Todo This need to be improved.
       *
       *
*/
//===================================
	function validateEmail($email)
	{
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
  return true;
}
else {
  return false;
  
}

	}
	
	
}// end of eventEntry
?>
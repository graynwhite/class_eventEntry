<?php
require_once('../simpletest/unit_tester.php');
require_once('../simpletest/web_tester.php');
require_once('../simpletest/reporter.php');
require_once('../cgi-bin/connect.inc');
require_once('PHPClassesClass_evententry.php');

class TestPublicationDateWeekly extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2012-12-31',$begin_date);
		$this->assertEqual('2013-01-07',$end_date);
		$this->assertEqual('December 31, 2012',$pubdate);
		$this->assertEqual('MON. Dec. 31',$date_returned['pubdate1']);
		$this->assertEqual('TUE. Jan. 1',$date_returned['pubdate2']);
		$this->assertEqual('WED. Jan. 2',$date_returned['pubdate3']);
		$this->assertEqual('THU. Jan. 3',$date_returned['pubdate4']);
		$this->assertEqual('FRI. Jan. 4',$date_returned['pubdate5']);
		$this->assertEqual('SAT. Jan. 5',$date_returned['pubdate6']);
		$this->assertEqual('SUN. Jan. 6',$date_returned['pubdate7']);
		$this->assertEqual('2012-12-31',$date_returned['select1']);
		$this->assertEqual('2013-01-01',$date_returned['select2']);
		$this->assertEqual('2013-01-02',$date_returned['select3']);
		$this->assertEqual('2013-01-03',$date_returned['select4']);
		$this->assertEqual('2013-01-04',$date_returned['select5']);
		$this->assertEqual('2013-01-05',$date_returned['select6']);
		$this->assertEqual('2013-01-06',$date_returned['select7']);
		$this->assertEqual('2013-01-07',$date_returned['select8']);
		$this->assertEqual('10',$date_returned['years']);
		$this->assertEqual('33',$date_returned['plus_weeks']);
		
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test = &new TestPublicationDateWeekly();
$test->run(new HtmlReporter());

class TestPublicationDateMonthly extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->setMode('monthly');
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$date_returned= $ee->getNextMonthDate('01');
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2013-01-01',$begin_date);
		$this->assertEqual('2013-01-31',$end_date);
		$this->assertEqual('January, 2013',$pubdate);
		$this->assertEqual('10',$volume);
		$this->assertEqual('01',$editionNumber);
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test2 = &new TestPublicationDateMonthly();
$test2->run(new HtmlReporter());
//
//$date_returned= $ee->getNextWeekDay('Mon',$edition);
//		$begin_date = $date_returned['date_begin'];
//		$end_date = $date_returned['date_end'];
//		$pubdate = $date_returned['pubdate'];
//
//$weekOfMonth = $ee->getWeekOfTheMonth($begin_date);
////echo "week of the month is " . $weekOfMonth	;

////echo "<br>Week of year is " . $weekOfYear;
?>
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
		$weekOfYear = $date_returned['wkOfYear'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2012-12-31',$begin_date);
		$this->assertEqual('2013-01-07',$end_date);
		$this->assertEqual('December 31, 2012',$pubdate);
		$this->assertEqual('10',$volume);
		$this->assertEqual('33',$editionNumber);
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test = &new TestPublicationDateWeekly();
$test->run(new HtmlReporter());

class TestPublicationDateMonthly extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$date_returned= $ee->getNextMonthDate('01');
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$weekOfYear = $date_returned['wkOfYear'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2013-01-01',$begin_date);
		$this->assertEqual('2013-01-31',$end_date);
		$this->assertEqual('January 1, 2013',$pubdate);
		$this->assertEqual('10',$volume);
		$this->assertEqual('33',$editionNumber);
		

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
//$weekOfYear = $date_returned['wkOfYear'];
////echo "<br>Week of year is " . $weekOfYear;
?>
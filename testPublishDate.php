<?php

require_once('../simpletest/unit_tester.php');
require_once('../simpletest/web_tester.php');
require_once('../simpletest/reporter.php');
require_once('PHPClassesClass_evententry.php');

class TestPublicationDateWeekly extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$ptr= null;
		$date_returned= $ee->getNextWeekDay('Mon',$ptr);
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

class TestPublicationDateWeeklyLastWeek extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$ptr= -1;
		$date_returned= $ee->getNextWeekDay('Mon',$ptr);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2012-12-24',$begin_date);
		$this->assertEqual('2012-12-31',$end_date);
		$this->assertEqual('December 24, 2012',$pubdate);
		$this->assertEqual('MON. Dec. 24',$date_returned['pubdate1']);
		$this->assertEqual('TUE. Dec. 25',$date_returned['pubdate2']);
		$this->assertEqual('WED. Dec. 26',$date_returned['pubdate3']);
		$this->assertEqual('THU. Dec. 27',$date_returned['pubdate4']);
		$this->assertEqual('FRI. Dec. 28',$date_returned['pubdate5']);
		$this->assertEqual('SAT. Dec. 29',$date_returned['pubdate6']);
		$this->assertEqual('SUN. Dec. 30',$date_returned['pubdate7']);
		$this->assertEqual('2012-12-24',$date_returned['select1']);
		$this->assertEqual('2012-12-25',$date_returned['select2']);
		$this->assertEqual('2012-12-26',$date_returned['select3']);
		$this->assertEqual('2012-12-27',$date_returned['select4']);
		$this->assertEqual('2012-12-28',$date_returned['select5']);
		$this->assertEqual('2012-12-29',$date_returned['select6']);
		$this->assertEqual('2012-12-30',$date_returned['select7']);
		$this->assertEqual('2012-12-31',$date_returned['select8']);
		$this->assertEqual('10',$date_returned['years']);
		$this->assertEqual('32',$date_returned['plus_weeks']);
		
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test = &new TestPublicationDateWeeklyLastWeek();
$test->run(new HtmlReporter());

class TestPublicationDateWeeklyNextWeek extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$ptr= +1;
		$date_returned= $ee->getNextWeekDay('Mon',$ptr);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2013-01-07',$begin_date);
		$this->assertEqual('2013-01-14',$end_date);
		$this->assertEqual('January 7, 2013',$pubdate);
		$this->assertEqual('MON. Jan. 7',$date_returned['pubdate1']);
		$this->assertEqual('TUE. Jan. 8',$date_returned['pubdate2']);
		$this->assertEqual('WED. Jan. 9',$date_returned['pubdate3']);
		$this->assertEqual('THU. Jan. 10',$date_returned['pubdate4']);
		$this->assertEqual('FRI. Jan. 11',$date_returned['pubdate5']);
		$this->assertEqual('SAT. Jan. 12',$date_returned['pubdate6']);
		$this->assertEqual('SUN. Jan. 13',$date_returned['pubdate7']);
		$this->assertEqual('2013-01-07',$date_returned['select1']);
		$this->assertEqual('2013-01-08',$date_returned['select2']);
		$this->assertEqual('2013-01-09',$date_returned['select3']);
		$this->assertEqual('2013-01-10',$date_returned['select4']);
		$this->assertEqual('2013-01-11',$date_returned['select5']);
		$this->assertEqual('2013-01-12',$date_returned['select6']);
		$this->assertEqual('2013-01-13',$date_returned['select7']);
		$this->assertEqual('2013-01-14',$date_returned['select8']);
		$this->assertEqual('10',$date_returned['years']);
		$this->assertEqual('34',$date_returned['plus_weeks']);
		
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test = &new TestPublicationDateWeeklyNextWeek();
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

class TestPublicationDateQuarterly extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->setMode('quarterly');
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('12/29/2012');
		$date_returned= $ee->getNextQuaterDate('01');
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2013-01-01',$begin_date);
		$this->assertEqual('2013-03-31',$end_date);
		$this->assertEqual('First Quarter, 2013',$pubdate);
		$this->assertEqual('10',$volume);
		$this->assertEqual('01',$editionNumber);
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test3 = &new TestPublicationDateQuarterly();
$test3->run(new HtmlReporter());

class TestPublicationDateQuarterlyThree extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new eventEntry;
		$ee->setMode('quarterly');
		$ee->set_begin_publishing_date("05/31/2003");
		$ee->setTodaysTestDate('06/29/2012');
		$date_returned= $ee->getNextQuaterDate('01');
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
		$volume = $date_returned['years'];
		$editionNumber = $date_returned['plus_weeks'];
		$this->assertEqual('2012-07-01',$begin_date);
		$this->assertEqual('2012-09-30',$end_date);
		$this->assertEqual('Third Quarter, 2012',$pubdate);
		$this->assertEqual('09',$volume);
		$this->assertEqual('03',$editionNumber);
		

		// $this->assertEqual('2012-12-29',$todays_mysql_date);
    }
}
$test3 = &new TestPublicationDateQuarterlythree();
$test3->run(new HtmlReporter());
?>
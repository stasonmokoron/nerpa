<?php
	//include_once 'PHPUnit/Autoload.php';
	require_once 'c:/server/data/htdocs/splitter.php';
	class SplitterTest extends PHPUnit_Framework_TestCase{
		/**
		* @dataProvider providerDivideText
		**/
		
		public function testDivideText($a,$b) {
			$test = new Splitter();
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals($a, $test->DivideText($b));
			
			//$this->assertEquals([[]], $test->DivideText(""));
			//$this->assertEquals(['яблоко'], $test->DivideText("яблоко"));
			
		}

		public function providerDivideText(){
			return array (
				
				array (array('яблоко'), 'яблоко'),
				array (array(array()), "")//,
				//array (array("яблоко", "лимон", "банан"), "ЯБЛОКО, БаНан, лимон!!!")
			);
		}
	}
?>
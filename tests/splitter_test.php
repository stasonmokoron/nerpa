<?php
	//include_once 'PHPUnit/Autoload.php';
	/*
	слова с дефисом "как-никак" (вернуть должен одно слово)
	система "microsoft windows"
	*/
	require_once 'c:/server/data/htdocs/splitter.php';
	class SplitterTest extends PHPUnit_Framework_TestCase{
		/**
		* @dataProvider providerDivideText
		*/
		
		public function testDivideText($a,$b){
			$test = new Splitter();
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals($a, $test->DivideText($b));	
		}

		public function providerDivideText(){
			return array (				
				array (array('яблоко'), 'яблоко'),
				array (array(array()), ""),
				array (array('как-никак'), "как-никак"),
				array (array('microsoft', 'windows'), "microsoft windows"),
				array (array("яблоко", "лимон", "банан"), "ЯБЛОКО, БаНан, лимон!!!")
			);
		}
		
		public function testDivideTextArr(){
			$test = new Splitter();
			//assertContains($v, $arr) – проверяет существует ли элемент $v в массиве $arr.
			$this->assertContains('банан',$test->DivideText("ЯБЛОКО, БаНан, лимон!!!"));	
		}
		
		public function testDivideTextArr2(){
			$test = new Splitter();
			//assertContains($v, $arr) – проверяет существует ли элемент $v в массиве $arr.
			$this->assertContainsOnly('string',$test->DivideText("ЯБЛОКО, БаНан, лимон!!!"));	
		}
	}
?>
<?php
	require_once 'c:/server/data/htdocs/word.php';
	require_once 'c:/server/data/htdocs/meaning.inc.php';
	class WordTest extends PHPUnit_Framework_TestCase{
	
		public function testChoose(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("способности живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(array(1), $test->Choose("способность", $arrObg[0]->arr_me));	
		}
		
		public function testChooseNull(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("способность живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->Choose("", $arrObg[0]->arr_me));	
		}
		
		public function testChooseNull2(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->Choose("способность", $arrObg[0]->arr_me));	
		}
		
		public function testChooseNull3(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->Choose("способность", $arrObg[0]->arr_me));	
		}
		
	}	
?>
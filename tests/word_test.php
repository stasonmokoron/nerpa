<?php	
	require_once 'c:/server/data/htdocs/word.php';
	require_once 'c:/server/data/htdocs/meaning.inc.php';
	class WordTest extends PHPUnit_Framework_TestCase{
	
		public function testCountStringOccurrencesInArray(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("способности живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(array(1), $test->countStringOccurrencesInArray("способность", $arrObg[0]->arr_me));	
		}
		
		public function testCountStringOccurrencesInArray2(){
			$test = new Word();
			
			$arrObj[0]=new Word();			
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("способности живого существа воспринимать внешние впечатления");
			$arrObg[0]->arr_me[1]=new Meaning();
			$arrObg[0]->arr_me[1]->arr_senseLemmatize("живого существа воспринимать внешние впечатления");
			$arrObg[0]->arr_me[2]=new Meaning();
			$arrObg[0]->arr_me[2]->arr_senseLemmatize("живого существа воспринимать, СпосОбностей, внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(array(1,3), $test->countStringOccurrencesInArray("способность", $arrObg[0]->arr_me));	
		}
		
		public function testCountStringOccurrencesInArrayNull(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("способность живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->countStringOccurrencesInArray("", $arrObg[0]->arr_me));	
		}
		
		public function testCountStringOccurrencesInArrayNull2(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->countStringOccurrencesInArray("способность", $arrObg[0]->arr_me));	
		}
		
		public function testCountStringOccurrencesInArrayNull3(){
			$test = new Word();
			
			$arrObj[0]=new Word();
			$arrObg[0]->arr_me[0]=new Meaning();
			$arrObg[0]->arr_me[0]->arr_senseLemmatize("");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->countStringOccurrencesInArray("способность", $arrObg[0]->arr_me));	
		}
		
	}	
?>
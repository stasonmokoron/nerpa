<?php	
	require_once 'c:/server/data/htdocs/word.php';
	require_once 'c:/server/data/htdocs/meaning.inc.php';
	class WordTest extends PHPUnit_Framework_TestCase{
	
		public function testGetMeaningsArrayWithLemma(){
			
			$test = new Word();
			$test->me[0]="способности живого существа воспринимать внешние впечатления";
			$test->arr_meaning[0]=new Meaning();
			$test->arr_meaning[0]->setArrLemmasLemmatizeText($test->me[0]);
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(array("способности живого существа воспринимать внешние впечатления"), $test->getMeaningsArrayWithLemma("способность"));	
		}
		
		public function testGetMeaningsArrayWithLemma2(){
			$test = new Word();
			$test -> me = array ("способности живого существа воспринимать внешние впечатления",
							"живого существа воспринимать внешние впечатления",
							"живого существа воспринимать способностей внешние впечатления");
			for ($i = 0; $i < 3; $i++) {
				$test->arr_meaning[$i] = new Meaning;
				$test->arr_meaning[$i]->setArrLemmasLemmatizeText($test->me[$i]);
			}
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(array("способности живого существа воспринимать внешние впечатления",
									"живого существа воспринимать способностей внешние впечатления"), $test->getMeaningsArrayWithLemma("способность"));	
		}
		
		public function testGetMeaningsArrayWithLemmaNull(){
			$test = new Word();
			$test->arr_meaning[0]=new Meaning();
			$test->arr_meaning[0]->setArrLemmasLemmatizeText("способность живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->getMeaningsArrayWithLemma(""));	
		}
		
		public function testGetMeaningsArrayWithLemmaNull2(){
			$test = new Word();
			$test->arr_meaning[0]=new Meaning();
			$test->arr_meaning[0]->setArrLemmasLemmatizeText("живого существа воспринимать внешние впечатления");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->getMeaningsArrayWithLemma("способность"));	
		}
		
		public function testGetMeaningsArrayWithLemmaNull3(){
			$test = new Word();
			$test->arr_meaning[0]=new Meaning();
			$test->arr_meaning[0]->setArrLemmasLemmatizeText("");
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals([], $test->getMeaningsArrayWithLemma("способность"));	
		}
		
	}	
?>
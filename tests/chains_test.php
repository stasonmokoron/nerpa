<?php
	require_once 'c:/server/data/htdocs/word.php';
	require_once 'c:/server/data/htdocs/chains.php';
	class ChainTest extends PHPUnit_Framework_TestCase{
	
		public function testHasWord(){
			
			$word = new Word;
			$word->name = "способность";
			$word->name_related_word = "чувство";
			$word->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			
			$word1 = new Word;
			$word1->name = "впечатление";
			$word1->name_related_word = "чувство";
			$word1->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word1->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			                       
                        $test = new Chain;
			$test->number=1;
			//array_push($test->words, $word);
			$test->words=Array($word);
			                       
                        
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(true, $test->hasWord($word1));
                        $this->assertEquals(true, $test->hasWord($word));
		}
		
		public function testHasWord_AbsentWord(){
			
			$word = new Word;
			$word->name = "способность";
			$word->name_related_word = "чувство";
			$word->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			
			$word1 = new Word;
			$word1->name = "вертолет";
			$word1->name_related_word = "чувство";
			$word1->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word1->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			
			$test = new Chain;
			$test->number=1;
			//array_push($test->words, $word);
			$test->words=Array($word);
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(false, $test->hasWord($word1));	
		}
		
		public function testHasWord_EmptyInput(){
			
			$word = new Word;
			$word->name = "способность";
			$word->name_related_word = "чувство";
			$word->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			
			$word1 = new Word;
			$word1->name = "";
			$word1->name_related_word = "";
			$word1->me = "";
			$word1->arr_me = Array ();
			
			$test = new Chain;
			$test->number=1;
			//array_push($test->words, $word);
			$test->words=Array($word);
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(false, $test->hasWord($word1));	
		}
		
		public function testHasWord_Uninitialized(){
			
			$word = new Word;
			$word->name = "способность";
			$word->name_related_word = "чувство";
			$word->me = "способность живого существа воспринимать внешние впечатления, ощущать, испытывать что-нибудь";
			$word->arr_me = Array ('что-нибудь','существо','способность','ощущать','испытывать','воспринимать','живой','впечатление','внешний');
			
			$word1 = new Word;
			
			$test = new Chain;
			$test->number=1;
			//array_push($test->words, $word);
			$test->words=Array($word);
			
			//метод assertEquals(), который первым обязательным параметром принимает ожидаемое значение, вторым актуальное и проверяет их соответствие.
			$this->assertEquals(false, $test->hasWord($word1));	
		}
		
	}
?>
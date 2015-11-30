<?php
	class Word{
		
		//слово
		public $name;
		
		//массив значений слова
		public $me;
		
		//массив объектов, свойствами которых являются значения слова в виде массива (массив из нормализованных слов)
		public $arr_me;
		
		//функция проверки вхождения леммы targetWord в текст 
		//возвращать массив объектов
		
		/**
		* Checks that $targetWord is presented in $arrText, returns objects from $arrText with $targetWord.
		*
		* @param string $targetWord searching lemma
		* @param array $arrText array of array of string which are lemmatized words from definitions
		* @return array array of Meanings
		*/	
		function Choose($targetWord, $arrText){
			global $i, $num;
			$i=0;
			$num=[];
			foreach($arrText as $arr){
				$f=false;
				foreach($arr->arr_sense as $a){
					if($a==$targetWord){$f=true;}
				}
				$i++;
				if ($f){$num[]=$i;}
			}
			return $num;
		}
	}
?>
<?php
	class Word{
		
		//слово
		public $name;
		
		//массив значений слова
		public $me;
		
		//массив объектов, свойствами которых являются значения слова в виде массива (массив из нормализованных слов)
		public $arr_meaning;
		
		//функция проверки вхождения леммы targetWord в текст 
		//возвращать массив объектов
		
		/**
		* Gets array of objects Meanings from $arr_meaning with $lemma.
		* Attention: property $arr_meaning should be initialized before.
		*
		* @param string $lemma searching lemma
		* @return array of Meanings objects
		*/	
		public function getMeaningsArrayWithLemma($lemma){
			$result_meanings=array();
			if (count($this->arr_meaning)==0) {
					return array();
				}
				
			$sh=0;
			foreach($this->arr_meaning as &$meaning_obj){
				if($meaning_obj->hasLemma($lemma)){
					
					array_push($result_meanings, $this->me[$sh]);
				}
				$sh++;
			}
			return $result_meanings;
		}
	}
?>
<?php
	/*
		экземпляры данного класса будут использоваться в свойстве $arr_me объекта Word
	*/
	require_once 'splitter.php';
	class Meaning{
		/** title of wiktionary entry, headword*/
		//public $name;
		
		/**text of meaning */
		//public $meaning_text;
		
		/**array of lemmatized words of meaning's text $arr_lemmas*/
		public $arr_lemmas;
		
		
		/**
		* initialization properties $arr_sense
		*
		* @param string $meaning_text input sense
		* new name setArrLemmasLemmatizeText
		*/	
		public function setArrLemmasLemmatizeText($meaning_text){
			$div_word = new Splitter;
			$this->arr_lemmas = $div_word->DivideText($meaning_text);
		}
		
		/**
		* Cheks that $lemma is presented in $arr_lemmas
		* Attention: property $arr_lemmas should be initialized before.
		*
		* @param string $lemma searching lemma
		* @return boolean true if $lemma presents in $arr_lemmas
		*/	
		public function hasLemma($lemma){
			if (count($this->arr_lemmas)==0) {
				return false;
			}
			
			foreach($this->arr_lemmas as $le){
				if ($le == $lemma)
					return true;
			}
			return false;
		}
	}
?>
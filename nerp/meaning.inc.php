<?php
	/*
		экземпляры данного класса будут использоваться в свойстве $arr_me объекта Word
	*/
	require_once 'splitter.php';
	class Meaning{
		//массив из нормализованных слов arr_sense
		public $arr_sense;
		//у конструктора две переменные $label_name_arr, $meaningObj->getWikiText()->getText - meaning_text
		function arr_senseLemmatize($meaning_text){
			$div_word = new Splitter;
			$this->arr_sense = $div_word->DivideText($meaning_text);
		}
	}
?>
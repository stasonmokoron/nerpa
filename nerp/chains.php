<?php
	class Chain{
		public $number;
		//public $word;
		public $words;
		
		public function hasWord($w){
			foreach ($this->words as $ws){
				//$i++;
				$f=false;
				foreach($ws->arr_me as $arr){
					if($arr==$w->name){
						$f=true;
						return true;
					}
				}
			}
			//if ($f==false){return false;}
			return true;
		}
		
	}
?>
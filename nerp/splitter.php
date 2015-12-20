<?php
	require_once "phpmorphy.inc.php";
	
	class Splitter{
		public $txt;
		
		/**
		* division $tx into words, removing punctuation marks, lemmatization
		*
		* @param string $tx input text
		* @return array of words
		*/	
		public function DivideText($tx){
			global $morphy;
			$tx = mb_strtoupper($tx);
			
			//деление текста на слова
			$arr = explode(" ", $tx);
			$flag=true;
			while ($flag){
				$sch=0;
				foreach ($arr as &$mass){
					//$mass=trim($mass);
					$ch=substr($mass,strlen($mass)-1,1);
							if ($ch=="," or 
								$ch==";" or 
								$ch=="." or 
								$ch=="!" or
								$ch=="?" or
								$ch==":"){
									$mass = substr($mass,0,strlen($mass)-1);
									$sch++;
								}
				}
				if ($sch==0)$flag=false;
			}	
			
			//нормализация
			$a = $morphy->lemmatize($arr);
		
			//приведение к одномерному массиву
			$one[] = array();
			$i = 0;
			foreach($a as &$mass){
				foreach($mass as &$m){
					$m = mb_strtolower($m);
					if (strlen($m)>2){
						$one[$i] = $m;
						$i++;
					}
				}
			}
			return $one;
		}
	}
?>
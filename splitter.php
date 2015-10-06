<?php
	class Splitter{
		public $txt;
		public function DivideText($tx){
			include "phpmorphy.inc.php";
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
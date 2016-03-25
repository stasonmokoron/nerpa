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
			if ($f==false){return false;}
			//return true;
		}
		
                /* Creats array of chains for words in $array_words
                 * $array_words array of objects Word
                 */
               /* public static function CreateChains($array_words){
                $chains=array();
                $k=0;
                 foreach($wr as $re){
                         if(count($chains) == 0){
                                 $chains[$k] = new Chain;
                                 $chains[$k]->number = 1;
                                 $chains[$k]->words = $re;
                                 $k++;
                         }else{
                                 //print_r($chains);
                                 foreach($chains as $ch){
                                         //if (null==$ch){print("null");}
                                         if($ch->hasWord($re)){
                                                 //$ch->words = $re;
                                                 array_push($ch->words, $re);
                                         }else{
                                                 //создание новой цепочки
                                                 $new_chain = new Chain;
                                                 $new_chain->number = count($chains)+1;
                                                 $new_chain->words = $re;
                                         }
                                 }
                                 array_push($chains, $new_chain);
                         }
                 }
                 return $chains;
                }*/
	}
?>
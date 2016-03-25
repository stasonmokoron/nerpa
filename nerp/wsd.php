<?php
	error_reporting( E_ERROR ); 
	include "config.php";
	include_once "splitter.php";
	include_once "word.php";
	include_once "meaning.inc.php";
	include_once "chains.php";
	
	// получеие максимального значения отправляемого файла
	$size = ini_get("post_max_size"); // 100M
	$letter = $size{strlen($size)-1}; // получение последнего символа
	$size = (int)$size;// приведение к целочисленному типу
	
	switch (strtoupper($letter)){
		case "G": $size *= 1024; 
		case "M": $size *= 1024; break;
		case "K": $size *= 1; break;
		default: $size *= 1 / 1024; 
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NERPA</title>
		<link rel="stylesheet" href="wsd_style.css"/>
	</head>
	<body>
	<div>
	<div id="image">
	<img src="image/nerpa.png"> 
	</div>
	<header>
		<h1>Разрешение лексической многозначности на основе Русского Викисловаря</h1>
	</header>
			<form action="<?=$PHP_SELF?>" method="GET">
				<fieldset>
					<legend>Введите интересующее слово и пример его употребления в контексте</legend>
						<div> 
							<label>Введите слово:</label>
							<input type="text" name="page_title" value="<?php if (isset($page_title)) print $page_title;?>" placeholder="Целевое слово" autofocus/>
						</div>
						<div>
							 <textarea name="text" value="<?php if (isset($text)) print $text;?>" cols="70" rows="15" placeholder="Добавьте контекст"></textarea>
						</div>
						<div>
							<input type="submit" value="Значение"/>
							<label id="max">максимальный размер: <?= $size;?> Кбайт</label>
						</div>
				</fieldset>
			</form>
		<section>
			<p id="outputtext">
			<?php 					
				//include "getbd.inc.php";	
				$div_word = new Splitter;
				$div_word->txt=strip_tags($_GET['text']);
				$word_arr=$div_word->DivideText($div_word->txt);	
				
				//************************
				$i=0;
				//$mean[] = array();
				foreach($word_arr as $wordd){
					$mean[$i] = new Word;
					$mean[$i]->name = $wordd;
					//--------------------------------------------
					$pageObj_arr = Tpage::getByTitle($wordd);
					if (is_array($pageObj_arr)) foreach ($pageObj_arr as $pageObj) {
						$lang_pos_arr = $pageObj -> getLangPOS();
						if (is_array($lang_pos_arr)) foreach ($lang_pos_arr as $langPOSObj) {													
							$meaning_arr = $langPOSObj -> getMeaning();
							if (is_array($meaning_arr)) foreach ($meaning_arr as $meaningObj) {
								$meaning_id = $meaningObj->getID();
								// MEANING

								//создание массива из значений слов
								if (null!==$meaningObj->getWikiText()->getText()){
								$wikiText = $meaningObj->getWikiText()->getText();}
								$mean[$i]->me[] = $wikiText;
								
								//создание массива из объектов значений слов в нормализованном виде
								$mean[$i]->arr_meaning[$j] = new Meaning;
								$mean[$i]->arr_meaning[$j]->setArrLemmasLemmatizeText($wikiText);
								
								$j++;
							}
						}
					}
					//--------------------------------------------
					$i++;
				}
				//************************
				
				$word_occurrences = array();
				$chains = array();
				foreach($word_arr as &$wordd){
					foreach($mean as &$word_obj){	
						if ($wordd!=$word_obj->name){
							$meanings_array_with_lemma = $word_obj->getMeaningsArrayWithLemma($wordd);
							if(count($meanings_array_with_lemma)>0){
								$w = new Word;
								$w -> name = $wordd;
								$w -> name_related_word = $word_obj->name;
								$w -> me = $meanings_array_with_lemma;
								array_push($word_occurrences, $w);
								//--------------
								
								$k=0;
								foreach($meanings_array_with_lemma as &$arr_w_le){
									$wr[$k] = new Word;
									$wr[$k]->name = $wordd;
									$wr[$k]->name_related_word = $word_obj->name;
									$wr[$k]->me = $arr_w_le;
									$wr[$k]->arr_me = $div_word->DivideText($arr_w_le);
									$k++;
								}
								
								
								//$chains=Chain::CreateChains($wr);
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
								
								//--------------
							}
						}
					}
				}
				
				//include "meaning.php";
				print_r($word_arr);
				echo "<br/><br/>";
				print_r($mean);
				echo "<br/><br/>";
				print_r($word_occurrences);	
				
				echo "<br/><br/>";
				print_r($chains);	
			?>
			</p>
		</section>
	</div>	
	</body>
</html>
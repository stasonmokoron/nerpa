<?php
	error_reporting( E_ERROR ); 
	include "config.php";
	include_once "splitter.php";
	include_once "word.php";
	
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
			<p>
			<?php 					
				//include "getbd.inc.php";	
				
				$div_word = new Splitter;
				$div_word->txt=strip_tags($_GET['text']);
				$word_arr=$div_word->DivideText($div_word->txt);	
				
				//************************
				$i=0;
				$mean[] = array();
				foreach($word_arr as $wordd){
					$mean[$i] = new Word;
					$mean[$i]->name = $wordd;
					//--------------------------------------------
					$pageObj_arr = Tpage::getByTitle($wordd);
					if (is_array($pageObj_arr)) foreach ($pageObj_arr as $pageObj) {
						$lang_pos_arr = $pageObj -> getLangPOS();
						if (is_array($lang_pos_arr)) foreach ($lang_pos_arr as $langPOSObj) {													
							$meaning_arr = $langPOSObj -> getMeaning();
							//$count_meaning = 1;
							if (is_array($meaning_arr)) foreach ($meaning_arr as $meaningObj) {
								$meaning_id = $meaningObj->getID();
								// MEANING
								$mean[$i]->me[] = join(', ',$label_name_arr). " ". $meaningObj->getWikiText()->getText();
								$mean[$i]->arr_me[] = $div_word->DivideText(join(', ',$label_name_arr). " ". $meaningObj->getWikiText()->getText());
							}
						}
					}
					//--------------------------------------------
					$i++;
				}
				//************************
				
				//include "meaning.php";
				print_r($word_arr);
				echo "<br/><br/>";
				print_r($mean[1]);
			?>
			</p>
		</section>
	</div>	
	</body>
</html>
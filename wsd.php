<?php
	error_reporting( E_ERROR ); 
	include "config.php";
	include "functions.inc.php";
	
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
				//получение массива из нормализованных слов контекста
				$word_arr = divText(strip_tags($_GET['text']));
				test_divText($word_arr);
				print_r($word_arr);
			?>
			</p>
		</section>
	</div>	
	</body>
</html>
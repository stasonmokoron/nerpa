<?php 						
	// получеие максимального значения отправляемого файла
	$size = ini_get("post_max_size"); // 100M
	$letter = $size{strlen($size)-1}; // получение последнего символа
	$size = (int)$size; // приведение к целочисленному типу
	
	switch (strtoupper($letter)){
		case "G": $size *= 1024; 
		case "M": $size *= 1024; break;
		case "K": $size *= 1; break;
		default: $size *= 1 / 1024; 
	}
?>
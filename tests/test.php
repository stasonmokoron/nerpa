<?php
$mypath = "..\tests\\"; // это путь к папке , в которой лежат файлы, предназначенные для тестирования.
//$mypath = "C:\data\localhost\www\tp\world-shared-folders\att2\tests\test1.php";
 
$dircontent = scandir($mypath); // получаем массив имён файлов и папок , содержащийся в нашей директории
$files = array(); // в этом массиве мы разместим имена полученных файлов.
$count = 0; // сюда можно будет потом записать число элементов массива
 
 
foreach ($dircontent as $direl)                           // перебираем полученный массив имён
{
    $fn=strrchr($direl,'.');                                 // берем расширение отсканированных файлов
    $fn=strtolower($fn);
 
    if (is_dir($direl)) continue;      // если это папка - переходим к следующему элементу.
    /* если же это всё же файл, то на всякий случай не помешает проверить,
    что файл, который мы собираемся тестировать имеет расширение пхп,  */
    $fn=strrchr($direl,'.');    // берем расширение отсканированных файла
    $fn=strtolower($fn);  // переводим это расширение в нижний регистр (чтобы все буквы были маленькими - так на мбудет удобнее в дальнейшем сравнивать)
    if ($fn!=='.php') continue; // вот здесь мы и смотрим - правильное ли у нашего файла расширение если не .php, то выходим из цикла
     
    /*теперь мы убедились в том, что это файл , а не папка, и что он имеет расширение .php
     - то есть можно передать его великому PHPUnit - для этого просто "склеим"
     имя и путь к файлу - и передадим всё это в командную строку 
     (предварительно выведем имя файла, который тестируется.)*/
    echo ("<br> Тестирование файла ".$direl); 
    echo ("pre>");
    $last_line = system("phpunit ".$mypath.$direl, $retval);
    echo ("/pre>");
    echo ("<hr>");
}
?>
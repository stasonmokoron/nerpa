<?php
require("../config.php");
$string = '# выражает доведение объекта действия с помощью длительного и/или интенсивного действия, названного мотивирующим глаголом, до нежелательного состояния (крайней усталости, бессилия, исчерпанности) или состояния невозможности продолжения действия: убегаться, укачать, уреветься, уходиться.';
$substring = 'об%т';
print TWikiText::selectText($string,$substring);
?>
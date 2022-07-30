
<?php  

$str="hello1*hello2*hello3";

$news_header=substr($str, 0, stripos($str, '*')); 
$ps_caption=substr($str, strripos($str, "*")+1);

$news_header1=substr($str, 0, stripos($str, '*')); 
$ps_caption2=substr($str, strripos($str, "*")+1);
?>

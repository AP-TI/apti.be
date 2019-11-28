<?php
$input = $_GET['input'];
$num1 = $_GET['num1'];
$num2 = $_GET['num2'];
if($input == ($num1 + $num2)){
  $myObj->text = "Gelukt!";
  $myObj->status = 1;
  $myObj->invite = "https://discord.gg/pFKw274";
}else{
  $myObj->status = 0;
}


$myJSON = json_encode($myObj);

echo $myJSON;
?>

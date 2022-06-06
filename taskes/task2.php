<?php
//task 1
$string = 'z';
$next_string= ++$string; 
function myTest() {
  global $string, $next_string;
  if (strlen($next_string) > 1) 
    {
     $next_string= $next_string[0];
     }
} 
myTest(); 
echo $next_string.'<br>';



//task2
$URL = 'http://www.example.com/5478631';
function myTest2() {
    global $URL;
echo substr($URL, strrpos($URL, '/' )+1).'<br>';
}
myTest2();




//task 3


?>




<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

</head>
<body>
<div>

  <?php
  function test3($id){
    if($id==null){
        echo 'ita has not id';
    }else{
       echo $id;

    }
} 
test3(null);
  ?>
</div>
</body>
</html>
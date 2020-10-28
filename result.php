<?
session_start();
 $result='';
 $image='';
 
 if($_SESSION['points']>4)
 {
    $result='PASSED';
    $image='happy.gif';
 }else{
     
     $result='FAILED';
     $image='sad.gif';
 }
 session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" type="text/css" href="resource/style.css" />

</head>
<body>
    <div id="container_center">
    <h1><?php echo $_SESSION['name'] ?>,You have <?php echo $result ?></h1>
    <h2>Your Score is <?php echo $_SESSION['points'] ?></h2>
    <img src="resource/image/<?php echo $image ?>">
    </div>
    
</body>
</html>
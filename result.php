<?
include('resource/config.php');
include('resource/header.php');
include('resource/footer.php');

session_start();

$marks=0;

$sql = "SELECT * FROM " . $_SESSION['data']['quiz_name'] . "  ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $qid=$row['qid'];
        $answer=$row['answer'];

        foreach ($_SESSION['response'] as $serialkey => $serialvalue) {
            if ($qid == $serialvalue['qid'] && $answer==$serialvalue['answer']) {
                $marks++;
            }
        }
    }
}
 $result='';
 $image='';
 if($marks>4)
 {
    $result='PASSED';
    $image='happy.gif';
 }else{
     
     $result='FAILED';
     $image='sad.gif';
 }
 

// session_destroy();
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
<?php head();?>

    <div id="container_center">
        <h1><?php echo $_SESSION['data']['username'] ?>,You have <?php echo $result ?></h1>
        <h2>Your Score is <?php echo $marks ?></h2>
        <img src="resource/image/<?php echo $image ?>">
    </div>
    <?php footer();?>

</body>

</html>
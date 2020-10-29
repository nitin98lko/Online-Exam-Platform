<?php
include('resource/config.php');
include('resource/footer.php');
session_start();

$_SESSION['qno'];
$_SESSION['points'];
if ($_SESSION['points'] == '') {
    $_SESSION['points'] = 0;
}
// getting qid
if ($_SESSION['qno'] == '') {
    $_SESSION['qno'] = 1;
} else {
    if (isset($_POST['next'])) {
        $_SESSION['qno']++;
        //end of questions
        if ($_SESSION['qno'] >= 10) {
            $_SESSION['qno'] = 10;
        }
    }
    if (isset($_POST['back'])) {
        $_SESSION['qno']--;
        //start of question
        if ($_SESSION['qno'] <= 0) {
            $_SESSION['qno'] = 1;
        }
    }
}

$sql = "SELECT * FROM ".$_SESSION['data']['quiz_name']." 
WHERE qid='" . $_SESSION['qno'] . "' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $qid = $row["qid"];
        $question = $row["question"];

        $option_a = $row["option_a"];
        $option_b = $row["option_b"];
        $option_c = $row["option_c"];
        $option_d = $row["option_d"];

        $answer = $row["answer"];
        $html_finish = '';

        $html_queastion .= '
        <form action="" method="POST">
          <h2>' . $question . '<h2>
          <div class="option_content">
            <p> <input class="get_option" type="checkbox" name="option" value=' . $option_a . '>' . $option_a . '</p>
            <p> <input class="get_option" type="checkbox" name="option" value=' . $option_b . '>' . $option_b . '</p>
            <p> <input class="get_option" type="checkbox" name="option" value=' . $option_c . '>' . $option_c . '</p>
            <p> <input class="get_option" type="checkbox" name="option" value=' . $option_d . '>' . $option_d . '</p>
          </div>
          <input class="submit" name="submit" type="submit" value="Submit Response">
          <input id="finish" name="finish" type="submit" value="End Test">
            ' . $html_finish . '
        </form>';

        $response = $_POST['option'];
        if (isset($_POST['submit']) && $response != '') {
            if ($answer == $response) {
                $_SESSION['points'] = $_SESSION['points'] + 1;
            }
            $_SESSION['qno']++;
        } //submit response

        if (isset($_POST['finish'])) {

            header('Location:result.php');
        }

        $_SESSION['points']; //show response

    } //while_row
}
//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
    <link rel="stylesheet" type="text/css" href="resource/style.css" />
</head>

<body>
    <div id="profile">
        <img src="resource/image/profile.png">
        <h1>
            Candidate Name:<?php echo $_SESSION['data']['username'] ?>
        </h1>


    </div>
    <form action="" method="POST">
        <div class="nav_box">
            <input class="back" name="back" type="submit" value="back">
            <input class="next" name="next" type="submit" value="next">
            <h1 id="nav_ques"> <?php echo $_SESSION['data']['quiz_name'] ?> :Question<?php echo  $_SESSION['qno'] ?></h1>
        </div>
    </form>
    <?php echo $html_queastion ?>
    <?php echo footer() ?>
</body>

</html>
<?php
include('resource/config.php');
include('resource/header.php');
include('resource/footer.php');

session_start();

$_SESSION['response'][0] = array(
    'qid' => "",
    'response' => ""
);

$_SESSION['qno'];

// getting qid
if ($_SESSION['qno'] == '') {
    $_SESSION['qno'] = 1;
} else {
    if (isset($_POST['next'])) {
        $_SESSION['qno']++;
        //end of questions
        if ($_SESSION['qno'] >= 5) {
            $_SESSION['qno'] = 5;
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
//enable/disable navigation button
$html_nav;
if ($_SESSION['data']['feature'] == 'true') {
    $html_nav = '
        <input class="back" name="back" type="submit" value="back">
        <input class="next" name="next" type="submit" value="next">
     
';
}

$sql = "SELECT * FROM " . $_SESSION['data']['quiz_name'] . " 
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
           
        </form>';

        $response = $_POST['option']; //sends the option clicked by examinee

        if (isset($_POST['submit']) || $response != '' && $qid != '' && $response != '') {
            $item = array(
                'qid' => $qid,
                'response' => $response
            );
            search_response($qid, $response);
            $_SESSION['qno']++;
        } //submit response


        if (isset($_POST['finish'])) {
            header('Location:result.php');
        }
    } //while_row
}

function search_response($qid, $response)
{
    foreach ($_SESSION['response'] as $serialkey => $serialvalue) {
        if ($qid == $serialvalue['qid'] && $_POST['back'] != 'back' && $_POST['next'] != 'next') {
            $_SESSION['response'][$serialkey]['response'] = $response;
            return 1;
        }
    }
}

search_response($qid, $response);

if (search_response($qid, $response) != 1) {
    global $item;
    array_push($_SESSION['response'], $item);
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
    <?php head();?>
    <div id="profile">
        <img src="resource/image/profile.png">
        <h1>
            Candidate Name:<?php echo $_SESSION['data']['username'] ?>
        </h1>
    </div>
    <form action="" method="POST">
        <div class="nav_box">
            <?php echo $html_nav; ?>
        </div>
        <h1 id="nav_ques"> <?php echo $_SESSION['data']['quiz_name'] ?> :Question<?php echo  $_SESSION['qno'] ?></h1>
    </form>
    <?php echo $html_queastion ?>

</body>
</html>
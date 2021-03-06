<?php
include('../resource/config.php');
include('../resource/footer.php');
include('../resource/header.php');

session_start();

$errors = array();
if (isset($_POST['submit'])) {

    $question = isset($_POST['question']) ? $_POST['question'] : '';

    $option_a = isset($_POST['option_a']) ? $_POST['option_a'] : '';
    $option_b = isset($_POST['option_b']) ? $_POST['option_b'] : '';
    $option_c = isset($_POST['option_c']) ? $_POST['option_c'] : '';
    $option_d = isset($_POST['option_d']) ? $_POST['option_d'] : '';

    $answer = isset($_POST['answer']) ? $_POST['answer'] : '';

    ///////////////////insert/////////////////////////////
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO ".$_SESSION['admin_data']." (question,option_a,option_b,option_c,option_d,answer)VALUES
        ('" . $question . "', '" . $option_a . "', '" . $option_b . "', '" . $option_c . "', '" . $option_d . "', '" . $answer . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ///////////////////insert/////////////////////////////
} //isset_submit
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Question</title>
    <link rel="stylesheet" type="text/css" href="../resource/style.css" />
</head>
<body>
<?php head();?>
<form action="" method="POST">
    
    <div class="container">
        <h1><?php echo $_SESSION['admin_data']?></h1>

        <textarea class="question" name="question"></textarea>
        <table>

            <tr>
                <td>
                    option A:<input name="option_a" class="option">
                </td>
                <td>
                    option B:<input name="option_b" class="option">
                </td>
            </tr>

            <tr>
                <td>
                    option C:<input name="option_c" class="option">
                </td>
                <td>
                    option D:<input name="option_d" class="option">
                </td>
            </tr>

            <tr>
                <p>
                    answer key:<input name="answer">
                </p>
            </tr>
        </table>

        <input type="submit" name="submit" class="submit">

    </div>
</form>
<?php echo footer();?>
</body>
</html>

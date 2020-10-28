<?php

include('../resource/config.php');
include('../resource/footer.php');
include('../resource/header.php');


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
        $sql = "INSERT INTO questions (question,option_a,option_b,option_c,option_d,answer)VALUES
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
head();
?>

<h1>Create Your Quiz</h1>
<form action="" method="POST">
    <div class="container">
        <label for="quiz_name">Quiz Name: <input type="text" name="quiz_name" required></label>
        <input type="submit" name="Create">

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
<?php
echo footer();
?>
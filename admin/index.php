<?php

include('../resource/config.php');
include('../resource/footer.php');
include('../resource/header.php');
session_start();
$errors = array();
if (isset($_POST['create'])) {
    // sql to create quiz table
    $quiz_name = $_POST['quiz_name'];

    $sql = "CREATE TABLE " . $quiz_name . " (
    qid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question text(255) NOT NULL,
    option_a text(255) NOT NULL,
    option_b text(255) NOT NULL,
    option_c text(255) NOT NULL,
    option_d text(255) NOT NULL,
    answer text(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        // echo "Table MyGuests created successfully";
        //inserting in quiz_list db

        $nav_handler = isset($_POST['nav_handler']) ? $_POST['nav_handler'] : 'false';

        $sql = "INSERT INTO quiz_list (quiz_name,feature)VALUES
        ('" . $quiz_name . "', '" . $nav_handler . "')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            $_SESSION['admin_data']=$quiz_name;
            header('Location:add.php');
        } else {
            echo "Error in inserting: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $conn->close();
} //
?>

<h1>Create Your Quiz</h1>
<form action="" method="POST">
    <div class="container">
        <label for="quiz_name">Quiz Name: <input type="text" name="quiz_name" required></label>
        <div class="checkbox">
            Enable Navigation Features : <input name="nav_handler" type="checkbox" value="true">
        </div>
        <input type="submit" name="create" value="create">

    </div>
</form>
<?php
echo footer();
?>
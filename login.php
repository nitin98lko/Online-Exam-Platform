<?php
session_start();
include('resource/config.php');
include('resource/header.php');
include('resource/footer.php');

$message;
$errors = array();
// putting all quizes in the dropdown menu
$sql = "SELECT * FROM quiz_list";
$result = $conn->query($sql);

$option = '<select name="dropdown" class="small-input">';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $quiz_id = $row["quiz_id"];
        $quiz_name = $row["quiz_name"];
        $quiz_name = $row["quiz_name"];

        $option .= '<option value=' . $quiz_name . '>' . $quiz_name . '</option>';
    }
}

$option .= "</select>";

if (isset($_POST['submit'])) {
    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $dropdown = isset($_POST['dropdown']) ? $_POST['dropdown'] : '';

    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users 
        WHERE username='" . $username . "'  AND  password='" . $password . "'  ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $email = $row["email"];

                //getting quiz details

                $sql = "SELECT * FROM quiz_list 
                 WHERE quiz_name='" . $dropdown . "'  ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
    
                        $_SESSION['data'] = array(
                            'username' => $username,
                            'email' => $email,
                            'quiz_id'=>$row["quiz_id"],
                            'quiz_name'=>$row["quiz_name"],
                            'feature'=>$row["feature"]
                        );
                    } //while quiz_list db fetch row
                } else {
                    echo "Error creating table: " . $conn->error;
                }
               header('Location:test.php');
            } //while_users db fetch row
        } else {
            $errors[] = array('inputs' => 'forms', 'msg' => 'invalid login');
        }
         $conn->close();
    }//sizeof($errors) == 0
}//isset_submit
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="resource/style.css" />

</head>
<body>
<?php head();?>
    <div id="message">
        <?php echo $message; ?>
    </div>
    <div id="errors">
        <?php if (sizeof($errors) > 0) :  ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error['msg'];  ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <form action="" method="POST">
        <p>
            <label for="username">Username: <input type="text" name="username" required></label>
        </p>
        <p>
            <label for="password">Password: <input type="text" name="password" required></label>
        </p>
        <p>
            <label>Category<?php echo $option; ?></label>
        </p>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
    <?php footer();?>
</body>

</html>
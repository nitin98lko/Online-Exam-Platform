<?php
session_start();
include('resource/config.php');
$message;
$errors = array();
if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users 
        WHERE username='" . $username . "'  AND  password='" . $password . "'  ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                print_r($row);
                $_SESSION['name'] = $username;
                header('Location:test.php');
                $_SESSION['userdata'] = array('username' => $username, 'user_id' => 'user_id');
            }
        } else {
            //echo "0 results";
            $errors[] = array('inputs' => 'forms', 'msg' => 'invalid login');
        }
        $conn->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Index</title>
</head>

<body>

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
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
</body>

</html>
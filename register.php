<?php
include('resource/config.php');
session_start();
$errors = array();
$message = '';
if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if ($password != $password2) {
        $errors[] = array('input' => 'password', 'msg' => 'password doesnt match');
    }
    /////////////////////////////searching username And Password////////////////////////////////////
    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users 
    WHERE username='" . $username . "'  OR  email='" . $email . "'  ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // uname or  password is present in database
            $errors[] = array('inputs' => 'forms', 'msg' => 'Username:' . $username . '&nbsp&nbsp' . ' Email:' . $email . ' is already registered !!!');
        } else {
            //uname or password is absent in database

            ///////////////////insert/////////////////////////////
            if (sizeof($errors) == 0) {
                $sql = "INSERT INTO users (username, password, email)VALUES ('" . $username . "', '" . $password . "', '" . $email . "')";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['name'] = $username;
                    header('Location:login.php');
                    $message = "New record created successfully";
                } else {
                    $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ///////////////////insert/////////////////////////////
        }
        $conn->close();
    }
    /////////////////////////////searching username And Password////////////////////////////////////

} //isset-submit
if (isset($_POST['login'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Register</title>
</head>

<body>
    <div id="message">
        <?php echo '<p>' . $message . '</p>'; ?>
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

    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password" name="password" required></label>
                </p>
                <p>
                    <label for="password2">Re-Password: <input type="password" name="password2" required></label>
                </p>
                <p>
                    <label for="email">Email: <input type="email" name="email" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Register"> OR
                </p>
            </form>

            <form action="" method="POST">

                <input type="submit" name="login" value="Login">

            </form>


        </div>
    </div>
</body>

</html>
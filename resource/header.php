
<?php
$html_header='
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../resource/style.css" />
</head>

<body>
    <div id="header">
        <h1>Online Exam Platform</h1>
    </div>
    ';

function head(){
    global $html_header;
    echo $html_header;
}

?>
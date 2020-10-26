<?php
include('resource/config.php');
include('resource/header.php');
include('resource/footer.php');


head();

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$html_queastion='';

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

    $html_queastion.='

    <h2><span class="qid">'.$qid.'.</span>'.$question.'<h3>
    <div class="option_content">
      <p> <input class="get_option" type="checkbox" name="option_a" value=' . $option_a . '>' . $option_a.'</p>
      <p> <input class="get_option" type="checkbox" name="option_b" value=' . $option_b . '>' . $option_b.'</p>
      <p> <input class="get_option" type="checkbox" name="option_c" value=' . $option_c . '>' . $option_c.'</p>
      <p> <input class="get_option" type="checkbox" name="option_d" value=' . $option_d . '>' . $option_d.'</p>
     </div>
   ';
   
  }//while_row
  $html_queastion.=' <input type="submit" name="submit" class="submit">';
  
} else {
  echo "0 results";
}
echo $html_queastion;
















footer();
?>

<link rel="stylesheet" type="text/css" href="resource/style.css" />

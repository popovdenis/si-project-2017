<?php
$result = 0;
if (isset ($_SESSION["answers"])) {
    $answers = parse_ini_file("quiz/answers.ini");
    foreach ($_SESSION["answers"] as $key => $value) {
        if ($value == $answers[$key]) {
            $result++;
        }
    }
    //unset($_SESSION['answers']);
}
?>
<p> Your result is <?php echo $result ?> from <?php echo count($questions) ?> </p>
<p><a href=<?php echo WAY ?>> Start the test again </a></p>

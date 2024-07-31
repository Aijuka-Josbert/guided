<?php
//ternary operators  are alternatives to use for if statements
$score = 70;

//goes like this but it return a value
$val=$score > 70 ? 'you have a B ' : 'Below Average :(';
echo $val;

?>

<!DOCTYPE html>
<html>
    <head>
       <title> php tuts</title>

</head>
<body>
<!--trying it in html>-->

<p><?php echo $score > 70 ? 'you have a B ' : 'Below Average :('; ?></p>






</body>
</html>
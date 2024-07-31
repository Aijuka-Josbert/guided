<?php
//sessions it carries a variabe and store data on the server
if(isset($_POST['submit'])){
    //cookie for gender
    setcookie('gender', $_POST['gender'], time() + 86400);
    session_start();
    //storing in session called name
    $_SESSION['name'] = $_POST['name'];
    
    header('Location: index.php');
}


?>


<!DOCTYPE html>
<html>
    <head>
       <title> php tuts</title>

</head>
<body>
<!-- echo $_SERVER['PHP_SELF'] . '<br />'; means we are goin to the  currect page-->

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="POST">
        <input type="text" name="name">
   <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
   </select>
   <input type="submit" value="submit" name="submit">

    </form>


</body>
</html>
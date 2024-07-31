<?php
//session so as to appear on all the pages
session_start();
//override the name
//$_SESSION['name']="Welcome to this page";
if($_SERVER['QUERY_STRING'] == 'noname'){
    //deleting the v
    unset($_SESSION['name']);
}
$name = $_SESSION['name'] ?? 'Guest';//?? is like e bck option
//get cookie
$gender = $_COOKIES['gender'] ?? 'Unknown';//?? is like e bck option

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>first php guided by youtube</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style>
    .brand{
        background: #cbb09c !important;
    }
    .brand-text{
        color: #cbb09c !important;
    }
    form{
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }
    .pizza{
        width: 100px;
        margin: 40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
    }
</style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li>    
            <li class="grey-text">(<?php echo htmlspecialchars($gender); ?>)</li>    

            <li><a href="add.php" class="btn brand z-depth-0">Add Pizz</a></li> 
            </ul>
        </div>
    </nav>
    <link rel="stylesheet" href="style.css">
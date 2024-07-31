<?php
include('config/db_connect.php');

// Initializing the variables so as to be loaded when the page is just opened
$email = '';
$title = '';
$ingredients ='';
// or we can use
// $email = $title = $ingredients = '';

// errors
$errors = array('email'=>'','title'=>'','ingredients'=>'');

// form validation and setting to accept user inputs
if(isset($_POST['submit'])){
    // Check email
    if(empty($_POST['email'])){
        // if it's empty, set an error message
        $errors['email'] = 'An email is required <br />';
    } else {
        // if it has a problem, set an error message
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors['email'] = 'Invalid email format <br />';
        }
    }

    // Check title
    if(empty($_POST['title'])){
        // if it's empty, set an error message
        $errors['title'] = 'A title is required <br />';
    } else {
        // if it has a problem, set an error message
        $title = $_POST['title'];
        //!preg_match('/^[a-zA-Z\s]+$/' the characters to be accepted in user input only
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must contain letters and spaces only <br />';
        }
    }

    // Check ingredients
    if(empty($_POST['ingredients'])){
        // if it's empty, set an error message
        $errors['ingredients'] = 'At least one ingredient is required <br />';
    } else {
        // if it has a problem, set an error message
        $ingredients = $_POST['ingredients'];
        //'/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/' to enhce comma separation
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be a comma separated list of words <br />';
        }
    }

    //redirecting en checking for errors
    if(array_filter($errors)){
        //echo 'there are errors in the form';
    }else{
        //echo 'the form is valid';
        //incase the user input is cprrect we redirect to the page suppose to be dedicated for it
             //we wil include the db staff here coz there are no erros
        //we use a function tht is used to escpe every marisiours or sensetive mysql char
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);  
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //success
            header('Location: index.php');//needed here since we er checking
        }else{
            //error
            echo 'query error: ' . mysqli_error($conn);
        }

        //header('Location: index.php'); not needed since we are redirecting it

    }
}//end of post check 
?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add Pizza</h4>
    <form class="white" action="add.php" method="POST">
        <label for="email">Your Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <!-- so to be displayed inside the form page, not above -->
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label for="title">Pizza Title</label>
        <!-- so as not to be deleted by default, we use the value keyword -->
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <!-- so to be displayed inside the form page, not above -->
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="ingredients">Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <!-- so to be displayed inside the form page, not above -->
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
<?php include('templates/footer.php'); ?>
</section>
</html>

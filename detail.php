<?php
include('config/db_connect.php');
// Handle the delete request
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
    // Ensure the id is an integer
    $id_to_delete = intval($id_to_delete);

    // Delete query
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    
    if(mysqli_query($conn, $sql)){
        // Redirect to the home page after successful deletion
        header('Location: index.php');
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Output error if the query fails
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Check if GET request id parameter is set
if(isset($_GET['id'])){
    // Escape the id parameter to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Make SQL query to fetch the pizza details
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    
    // Get the query results
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        // Fetch the result as an associative array
        $pizza = mysqli_fetch_assoc($result);
    } else {
        // Output an error if the query failed
        echo 'Query error: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<div class="container center grey-text">
    <!-- Output information on the screen -->
    <?php if(isset($pizza)): ?>
        <h4><?php echo htmlspecialchars($pizza['Title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['Email']); ?></p>
        <p><?php echo htmlspecialchars($pizza['Created_at']); ?></p>
        <h5>Ingredients: </h5>
        <p><?php echo htmlspecialchars($pizza['Ingredients']); ?></p>
        <!-- Delete form -->
        <form action="detail.php" method="POST">
            <input type ="hidden" name="id_to_delete" value="<?php echo $pizzas['id'] ?>">
            <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
        </form>
    <?php else: ?>  
        <h5>No such pizza exists!</h5>  
    <?php endif; ?> 
</div>

<?php include('templates/footer.php'); ?>
</html>

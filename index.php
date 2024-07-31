<?php
//file that connects to database
include('config/db_connect.php');
//retrieving data or getting data
//write query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';
//make query  & get results
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);//returns it as an associative array

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);
//print_r($pizzas);//display it

//explode(',',$pizza[0]['ingredients'])





?>

<!DOCTYPE html>
<html lang="en">
 <?php 
 include('templates/header.php'); ?>
 <h4 class="center grey-text">pizzas!</h4>
 <div class="container hoverable">
    <div class="row">
        <?php foreach($pizzas as $pizza): ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza1.jpg" class="pizza">
                    <div class="card-content center">
            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
             
          <ul>
            <?php foreach(explode(',',$pizza['ingredients']) as $ing): ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
                <?php endforeach; ?>
        </div>
        <!-- button for more info so as we know who aded en can be deleted etc-->
         <div class="card-action right-align">
            <!--query sring is ?the property name -->
            <a class="brand-text" href="detail.php?id=<?php echo $pizza ['id']?>">more info</a>
        </div>

        </div>
        </div>
            <?php endforeach; ?>
         
            </div>
</div>


<?php include('templates/footer.php'); ?>
</html>
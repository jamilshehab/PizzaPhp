<?php 
require('database/db.php');
//write a query to get all pizzas
$sql='SELECT title,ingredients,id FROM mypizzas ORDER BY created_at ';
//making a query and get the result
$result=mysqli_query($con,$sql);
//fetch the resulting rows as an array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
 
//free result from memory
mysqli_free_result($result);
//close connection
mysqli_close($con);

?>

<!DOCTYPE html>
<?php include('project/header.php');?>
 
<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
<div class="row">
<?php 
//fetch all the data inside the array pizzas which the table pizza are stored in
foreach($pizzas as $pizza):?>
<div class="col s6 md3">
    <div class="card z-depth-0">
        <img src="pizza.jfif" class="pizza">
        <div class="card-content center">
            <!--htmlspecialchars is used for security -->
<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
<ul>
    <?php 
foreach(explode(',',$pizza['ingredients']) as $ing):
?>
<li><?php echo htmlspecialchars($ing); ?></li>
<?php endforeach;?>
</ul>
        </div>
        <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
        </div>
    </div>
</div>
<?php endforeach; ?>
 

</div>
</div>
 <?php require('project/footer.php');?>
</body>
</html>
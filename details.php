<?php include('database/db.php');
if(isset($_POST['delete'])){
    $id_to_delete=mysqli_real_escape_string($con,$_POST['id_to_delete']);
    $sql="DELETE FROM mypizzas WHERE id= $id_to_delete " ;
    if(mysqli_query($con,$sql)){
        header('Location: index.php');
    }
    {
      echo 'query error' . mysqli_error($con);
    }
}
if(isset($_GET['id'])){
    $id=mysqli_real_escape_string($con,$_GET['id']);
    $sql="SELECT * FROM mypizzas WHERE id = $id ";
    $result=mysqli_query($con,$sql);
    $pizza=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<?php include ("project/header.php"); ?>
<div class="container center grey-text">
    <?php if($pizza):?>
        <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
        <p>Created by: <?php  echo htmlspecialchars($pizza['email']); ?></p>
        <h6>Ingredients:</h6>
        <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>

    <!---DELETE FORM-->
    <form action="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>">
        <input type="submit" name="delete" value="Delete" class="btn  brand z-depth-0 ">
    </form>

        <?php else: 
            ?>
            <h5>No such pizza exists!</h5>
            <?php endif;?>

        </div>
<?php include ("project/footer.php"); ?>
</html>
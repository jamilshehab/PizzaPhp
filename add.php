<?php
include('./database/db.php');
$title=$email=$ingredients='';
$errors=array('email'=>'','title'=>'','ingredients'=>'');
if(isset($_POST['submit'])){
    //check if the email is empty
    if(empty($_POST['email'])){
       $errors['email'] = 'please fill the email' . '<br>';
    }
    else{

      $email=$_POST['email'];
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'email must be a valid email address';
      }
    
    }
    //check if the title is empty
    if(empty($_POST['title'])){
        $errors['title']= 'please fill the title ' . '<br>';

    }

    else{
        $title=$_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title']= 'the type must be letters and spaces only';
        }
        
   
    }
    //check if the ingredients are empty
    if(empty($_POST['ingredients'])){
      $errors['ingredients']= 'the ingredients are required ' . '<br>';
    }
    else{
        $ingredients=$_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
            $errors['ingredients']= 'the ingredients must be letters and spaces only';
        }
    }
    if(array_filter($errors)){
        //echo 'errors in the form'
    }
    else{
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $title=mysqli_real_escape_string($con,$_POST['title']);
        $ingredients=mysqli_real_escape_string($con,$_POST['ingredients']);
        $sql="INSERT INTO mypizzas(email,title,ingredients) VALUES('$email','$title','$ingredients') " ;
       
        if(mysqli_query($con,$sql)){
            header('Location:index.php');
        }
        else{
            echo 'query error ' . mysqli_error($con);
        }
    }
    }
 
?>


<!DOCTYPE html>
<html>
    <?php
    include('project/header.php');
    ?>
    <section class="container grey-text">
        <h4 class="center">Add A Pizza</h4>
        <form action="add.php" class="white" method="POST">
<label>Your Email:</label>
<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
<div class="red-text"><?php echo $errors['email'];?></div>
<label>Pizza type:</label>
<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>" >
<div class="red-text"><?php echo $errors['title'];?></div>
<label>Ingredient:</label>
<input type="text" name="ingredients" value ="<?php echo htmlspecialchars($ingredients)?>">
<div class="red-text"><?php echo $errors['ingredients'];?></div>
<div class="center">
<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
</div>
        </form> 
       </section>
   <?php require('project/footer.php'); ?>
</html>
</html>
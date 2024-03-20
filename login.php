<?php
$login=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){


include 'C:\xampp\htdocs\login_system\_dbconnect.php';
$username=$_POST["username"];
$password=$_POST["password"];


$sql= "Select * from users where username='$username'";
$result= mysqli_query($conn,$sql);
$num= mysqli_num_rows($result);  
if ($num==1)
{   
    while($row=mysqli_fetch_assoc($result)){
      if (password_verify($password,$row['password'])){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location:/login_system/welcome.php");
      } 
      else{
        $showerror="INVALID CREDENTIALS";
      }
   }
}

else{
    $showerror="INVALID CREDENTIALS";
}
}
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>LOGIN</title>
  </head>
  <body>

  <?php require 'partials/_nav.php' ?>
  <?php
  if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong> You are logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>ERROR!</strong>'.$showerror.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
  ?>
  <div class="container">
    <h1 class="text-center">LOGIN TO HELPING HANDS</h1>

    <form action="/login_system/login.php" method ="post">
    <div class="mb-3">
        <label for="username" class="form-label">USER NAME</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">PASSWORD</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
   
    <button type="submit" class="btn btn-primary">LOGIN</button>
    </form>

  </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
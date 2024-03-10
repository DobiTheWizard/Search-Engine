<?php include'functions.php';
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery.min.js">
  <link rel="stylesheet" href="../css/bootstrap.min.js">
  <link rel="stylesheet" href="fontawesome/flaticon/font/flaticon.css">
  <link rel="stylesheet"  href="fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <style type="text/css">
    .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  padding: 20px 20px;
  margin-left: 25%;
  margin-right: 25%;
  background-color: #fff;

  width: 50%;
  border-radius: 10px;
 /* margin-bottom: 10px;*/
  margin-top: 150px;

}
   
  input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #008080;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
img.avatar {
  width: 20%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
  width: 100%;
}
@media screen and (max-width: 600px) {
  span.psw {
    display: block;
    float: none;
  }
  .column {
    width: auto;
    display: block;
    height: auto;
    margin-left:auto;

  }
}

  </style>

</head>
<body>

  <?php include 'header.php';
  ?>
  <?php include 'nav1.php';
  ?>
  <div class="row">
    <div class="column">
      <div class="card">
        

        <form action="index.php" method="POST">
          
          <div class="imgcontainer">
            <img src="images/avatar.png" alt="Avatar" class="avatar">
          </div>

          <?php  

            /*session_start();*/
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="search";
            $conn = new mysqli($servername,$username,$password,$dbname);

    /*
      if(isset($_SESSION['admins'])) {
        
        header("location: admin_home.php");
        
     }*/

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['submit'])) {
      
    
      $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
      $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
      
      if($username != "" && $password != "") {
        
        $check = mysqli_query($conn,"SELECT * FROM admin_login WHERE username='".$username."' AND password='".$password."' LIMIT 1");
        $checks = mysqli_query($conn,"SELECT * FROM add_staff WHERE username='".$username."' AND password='".$password."' LIMIT 1");

        
        if(mysqli_num_rows($check)) {
          
          $data =mysqli_fetch_assoc($check);
          
          $_SESSION['username'] = $data['username'];
          $_SESSION['password']  = $data['password'];
          
          echo "<script>window.location='admin/home.php'</script>";

        }elseif (mysqli_num_rows($checks))  {

          $data = mysqli_fetch_assoc($checks);

          $_SESSION['username'] = $data['username'];
          $_SESSION['password']  = $data['password'];
          
           echo "<script>window.location='staff/staff_home.php'</script>";
          
        }


        else{
          
          
          echo '<div class="alert alert-danger"> Invalid Login Details </div>';
          
        
      }
      /*else{
        
       echo '<div class="container alert alert-danger"> All fields are required </div>';
      
      }*/
      
    }
     }
}
?>

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username...." name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password...." name="password" required>

      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>

      <button type="submit" name="submit">Login</button>
      
    </div>

  </form>



      </div>
    </div>
  </div>


  <?php include 'footer.php';
  ?>
</body>

</html>

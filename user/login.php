<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>

<?php
session_start();
if (isset($_POST['login'])) {
  $pass1 =$_POST['pass'];
  $username  = $_POST['user'];
  $password =md5($pass1);
  mysqli_real_escape_string($conn, $username);
  mysqli_real_escape_string($conn, $password);
$query = "SELECT * FROM user WHERE uname = '$username'";

$result = mysqli_query($conn , $query) or die (mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['uid'];
    $user = $row['uname'];
    $pass = $row['upass'];
   
    $name = $row['name'];
    $email = $row['uname'];
   // $role= $row['role'];
   // $course = $row['course'];
  
    if (($password=== $pass )) {
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      $_SESSION['email']  = $email;
      //$_SESSION['role'] = $role;
     // $_SESSION['course'] = $course;
      header('location: ../index.php');
    }
    else {
      echo "<script>alert('invalid username/password');
     window.location.href= 'login.php';</script>";

    }
  }
}
else {
     echo "<script>alert('invalid username/password');
     window.location.href= 'login.php';</script>";

    }
}
?>


  <div class="login-card">
    <h1>Log-in</h1><br>
  <form method="POST">
    <input type="text" name="user" placeholder="Username" required="">
    <input type="password" name="pass" placeholder="Password" required="">
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>
    
  <div class="login-help">
    <a href="signup.php">Register</a> • <a href="recoverpassword.php">Forgot Password</a>
  </div>
</div>

  <script src='css/jquery.min.js'></script>
<script src='css/jquery-ui.min.js'></script>

  
</body>
</html>

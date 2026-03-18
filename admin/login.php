<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['submit'])) {
   $username = get_safe_value($con, $_POST['username']);
   $password = get_safe_value($con, $_POST['password']);
   $sql = "select * from admin_users where username='$username' and password='$password'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count > 0) {
      $row = mysqli_fetch_assoc($res);
      if ($row['status'] == '0') {
         $msg = "Account deactivated";
      } else {
         $_SESSION['ADMIN_LOGIN'] = 'yes';
         $_SESSION['ADMIN_ID'] = $row['id'];
         $_SESSION['ADMIN_USERNAME'] = $username;
         $_SESSION['ADMIN_ROLE'] = $row['role'];
         header('location:categories.php');
         die();
      }
   } else {
      $msg = "Please enter correct login details";
   }
}
?>
<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>KidzCare Admin Login</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>

   <div class="login-box">

      <div class="baby-icon">🧸</div>

      <div class="logo">KidzCare</div>

      <div class="subtitle">
         Admin Panel Login
      </div>

      <form method="post">

         <div class="form-group text-left">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
         </div>

         <div class="form-group text-left">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
         </div>

         <button type="submit" name="submit" class="btn-login">
            Login to Dashboard
         </button>

      </form>

      <div class="field_error">
         <?php echo $msg ?>
      </div>

   </div>

</body>

</html>
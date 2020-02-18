<?php
require_once './app/Db/init.php';
require_once './app/Controllers/Authentication/AuthController.php';
$auth = new AuthController();
$exist_auth = $auth->checklogin();
if(!$exist_auth) header('Location:login.php');
if(isset($_POST['logout']) && !empty($_POST['logout'])) {
  $auth->logout();
  header('Location:login.php');
}

//include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['fname']; ?>!</p>
<p>This is secure area.</p>
<p><a href="dashboard.php">Dashboard</a></p>
<button name="logout"><a href="logout.php">Logout</a></button>


</div>
</body>
</html>

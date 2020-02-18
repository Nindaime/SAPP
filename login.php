<?php
  require_once './app/Db/init.php';
  require_once './app/Controllers/Authentication/AuthController.php';
  $auth = new AuthController();
  $exist_auth = $auth->checklogin();
  if($exist_auth) header('Location:form.php');
  $error = '';
  if(isset($_POST['submit']) && !empty($_POST['matric'])) {
    if($_POST['matric'] == 'admin' && $_POST['password'] == 'admin') {
      if(!isset($_SESSION)) {
        session_start();
      }
      $_SESSION['matric'] = 'admin';
      $_SESSION['fname'] = 'Admin';
      $_SESSION['lname'] = 'Admin';
      header('Location:operation.php');
    }
    $login = $auth->login();
    if($login === true) {
      header('Location:form.php');
    }
    $error = $login;
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Login</title>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css" />
</head>
<body id="page-top">
	
	

    <header class="masthead">
      <div class="header-content">
        <div class="header-content-inner">
          <h1 id="homeHeading">Student Academic Performance Predictor System</h1>
          <hr>
          <div class="container">
		<div class="row-lg-6">
    <h3>Student Login Window</h3>
    <?php if($error != '') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo $error ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    <?php } ?>
    <form action="" method="post" name="login">
<input type="text" name="matric" class="form-group" placeholder="Matric Number" required /><br/>
<input type="password" name="password" class="form-group" placeholder="Password" required /><br/><br/>
<button type="submit" name="submit" class="btn btn-info" type="submit">Login</button>
</form>
		 <br/>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>

<br /><br />
    </div>	 

			  
			</div>	
			
        </div>
      </div>
    </header>

</body>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper/popper.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
</html>

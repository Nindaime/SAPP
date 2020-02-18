<?php
    require_once './app/Db/init.php';
    // require_once './app/Controllers/Authentication/AuthController.php';
    require_once './app/Controllers/OperationController.php';
    $operation = new OperationController;
    if(!isset($_SESSION)) {
      session_start();
    }
    if($_SESSION['matric'] != 'admin') header('Location:login.php');
    $error = '';
    $message = '';
    $testAcc = 'none';
    $trainAcc = 'none';
    if(isset($_POST['submit1'])) {
      /* echo "<pre>";
        var_dump($_POST);
      echo "</pre>"; */
        $postData = $operation->TrainData($_FILES);
      if($postData === true) {
        $message = "Train data uploaded successfuly";
        $trainAcc = "inline";
      }else{
        $error = $postData;
      }
    }

    if(isset($_POST['submit'])) {
      $testAcc = "inline";
      /* echo "<pre>";
        var_dump($_POST);
      echo "</pre>"; */
        $postData = $operation->TestData($_FILES);
      if($postData === true) {
        $message = "Test data uploaded successfuly";
      }else{
        $error = $postData;
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Academic predictor sysytem</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <a class="navbar-brand" href="#page-top"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="nav navbar-nav navbar-right ml-auto">
			<li class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="https://www.tutorialrepublic.com/examples/images/avatar/3.jpg" class="avatar" alt="Avatar"> <?= $_SESSION['fname'] ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li class="divider dropdown-divider"></li>
					<li><a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
				</ul>
			</li>
		</ul>
      </div>
    </nav>

    <header class="masthead">
      <div class="header-content">
        <div class="header-content-inner">
          <h1 id="homeHeading">Student Academic Performance Predictor System</h1>
          <hr>
          <div class="container">
			  <h3>Operational Window</h3>
      <br /><br />
      <?php if($error != '') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo $error ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <?php } ?>
        <?php if($message != '') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo $message ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <?php } ?>
			  <h5 style="float:left">Upload Training Dataset</h5><br/><br/>
<form style="float: left" name="form" method="post" action="" enctype="multipart/form-data" >
<input type="file" name="my_file" />
<input class="btn btn-primary btn-xl" type="submit" name="submit1" value="Train"/>
<b>Accuracy: <span style="display: <?= $trainAcc ?>;">0%</span></b>
</form>
<br /><br />
			
			</div>
		<div class="container">
			<br/>
			<h5 style="float: left">Upload Test Dataset</h5><br/><br/>
			<form style="float: left" name="form" method="post" action="" enctype="multipart/form-data" >
<input type="file" name="my_file" />
<input class="btn btn-primary btn-xl" type="submit" name="submit" value="Test"/>
<b>Accuracy: <span style="display: <?= $testAcc ?>;">0%</span></b>
</form>
			</div>	
			
        </div>
      </div>
    </header>

    
  </body>
  <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper/popper.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

</html>
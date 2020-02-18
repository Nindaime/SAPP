<?php
  require_once './app/Db/init.php';
  require_once './app/Controllers/Authentication/AuthController.php';
  require_once './app/Controllers/DatasetController.php';
  $dataset = new DatasetController();
  $auth = new AuthController();
  $exist_auth = $auth->checklogin();
  if(!$exist_auth) header('Location:login.php');
  $error = '';
  $message = '';
  if(isset($_POST['submit'])) {
    /* echo "<pre>";
      var_dump($_POST);
    echo "</pre>"; */
      $postData = $dataset->post_dataset($_POST);
    if($postData === true) {
      $message = "Dataset Saved successfuly";
      header('Location: result.php');
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top" style="background-color: #e8e8e8;">

  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav"> 
      <a class="navbar-brand" href="#page-top"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="nav navbar-nav navbar-right ml-auto">
			<li class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="https://www.tutorialrepublic.com/examples/images/avatar/3.jpg" class="avatar" alt="Avatar"> <?= $_SESSION['fname']." ".$_SESSION['lname'] ?> <b class="caret"></b></a>
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
          <h3>Student Prediction Window</h3>
    <br />
     

       </div>
        </div>
      </div>
    </header>
    <div class="container">
    <div class="row">
       <div class="col-md-12 offset-6">
         <div class="card-transparent offset-md-6">
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
         <form action="" method="post">
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
              <select class="form-control" required name="FamilyMonthlyIncome">
              <option class="hidden"  selected disabled>Please select family monthly income</option>
                <option value="Very high">Very high</option>
                <option value="High">High</option>
                <option value="Above medium">Above medium</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
          </div>
          <div class="form-group">
              <select class="form-control" required name="MotherOccupation">
              <option class="hidden"  selected disabled>Please select Mother's occupation</option>
                <option value="Service">Service</option>
                <option value="Business">Business</option>
                <option value="Retired">Retired</option>
                <option value="Housewife">Housewife</option>
                <option value="Others">Others</option>
              </select>
          </div>
          <div class="form-group">
            <select class="form-control" required name="FatherOccupation">
            <option class="hidden"  selected disabled>Please select Father's occupation</option>
                <option value="Service">Service</option>
                <option value="Business">Business</option>
                <option value="Retired">Retired</option>
                <option value="Housewife">Housewife</option>
                <option value="Others">Others</option>
            </select>
          </div>
          <div class="form-group">
          <input class="form-control" name="MotherQualification" placeholder="Please select Mother's qualification"/>

          </div>
          <div class="form-group">
          <input class="form-control" name="FatherQualification" placeholder="Please select Father's qualification"/>
          </div>
          <div class="form-group">
          <select class="form-control"  name="ClassAttendance">
              <option class="hidden"  selected disabled>Please select Class attendance rate</option>
              <option value="Good">Good</option>
              <option value="Average">Average</option>
              <option value="Poor">Poor</option>
            </select>
          </div>
          
      </div>
      <div class="col-md-6">
          <div class="form-group">
          <select class="form-control"  name="Gender">
              <option class="hidden"  selected disabled>Please select your gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
          <select class="form-control"  name="MaritalStatus">
              <option class="hidden"  selected disabled>Please select your marital status</option>
              <option value="Married">Married</option>
              <option value="Unmarried">Unmarried</option>
            </select>
          </div>
          <div class="form-group">
              <select class="form-control" name="AssessmentPercentage">
                  <option class="hidden"  selected disabled>Please select IAP</option>
                  <option value="Best">Best</option>
                  <option value="Vg">Very good</option>
                  <option value="Good">Good</option>
                  <option value="Pass">Pass</option>
                  <option value="Fail">Fail</option>
              </select>
          </div>
          <div class="form-group">
          <select class="form-control"  name="Arrears">
              <option class="hidden"  selected disabled>Please select Arrears</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
          <div class="form-group">
          <select class="form-control"  name="StudyHours">
              <option class="hidden"  selected disabled>Please select study hours</option>
              <option value="Good">Good</option>
              <option value="Average">Average</option>
              <option value="Poor">Poor</option>
            </select>
          </div>
          <div class="form-group">
          <select class="form-control"  name="NumberOfFriends">
              <option class="hidden"  selected disabled>Please select number of friends</option>
              <option value="Large">Large</option>
              <option value="Average">Average</option>
              <option value="Small">Small</option>
            </select>
          </div>
      </div>
      <div class="col-md-12">
      <div class="form-group">
          <select class="form-control"  name="TravelTime">
              <option class="hidden"  selected disabled>Please select travel time between home & school </option>
              <option value="Large">Large</option>
              <option value="Average">Average </option>
              <option value="Small">Small</option>
            </select>
          </div>
          <div class="form-group">
      <button class="btn btn-primary form-control" type="submit" name="submit">Submit</button>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>
      </form>
         </div>

    
  </body>
  <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper/popper.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

</html>
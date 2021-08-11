<?php
require_once('objects/init.php');
global $session;

if (!$session->get_signed_in()) {
    header('Location: login.php');
    exit;
}

$userID = $session->get_user_id();
$user = new User;
$user->find_user_by_user_id($userID);
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- My stylesheet -->
    <link rel="stylesheet" href="../CSS/PersonalDetails.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <title>Personal Details</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="row justify-content-center">
          <img class="col-4 col-lg-3" src="../media/katcafelogo.png" alt="KatCafe">
        </div>
      </div>
    </header>
    <nav>
      <div class="navbar navbar-light navbar-expand-sm justify-content-center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Home</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Our Team</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Our Cats</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Menu</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Reserve a Table</b></a>
          </li>
        </ul>
      </div>
    </nav>
    <main class="container">
      <section class="row">
        <div class="col-md-12">
		        <h6 class="headers">We're almost done! please fill out your personal details</h6>
            <?php
              if ($_POST){
                $numberOfSits=$_POST['numberOfSits'];
                $TableSize=$_POST['TableSize'];
                $Date=$_POST['Date'];
                $Time=$_POST['Time'];
              } else {
                header('Location: ReserveATable.html');
              }
            ?>
            <div class="row">
              <div class="col-4 col-lg-3">
                <p><b>Number of seats: </b><?php echo $numberOfSits;?></p>
              </div>
              <div class="col-4 col-lg-3">
                <p><b>Date: </b><?php echo $Date;?></p>
              </div>
              <div class="col-4 col-lg-3">
                <p><b>Time: </b><?php echo $Time;?></p>
              </div>
            </div>
        		<form name="myForm2" class="needs-validation" action="SubmitToDB.php" onsubmit="return validateForm();" method="post">
              <input type="hidden" name="numberOfSits" id="Numofsits" value=<?php echo $numberOfSits;?>>
              <input type="hidden" name="TableSize" id="Tsize" value=<?php echo $TableSize;?>>
              <input type="hidden" name="Date" id="Date" value=<?php echo $Date;?>>
              <input type="hidden" name="Time" id="Time" value=<?php echo $Time;?>>
              <input type="hidden" name="userID" id="userID" value=<?php echo $userID;?>>
        			<div class="form-row">
        				<div class="col-md-4 mb-3">
        				  <label class="headers">Gender:</label><br>
        				  <input type="radio" name="gender" value="male" checked> Male
        				  <input type="radio" name="gender" value="female"> Female
        				  <input type="radio" name="gender" value="other"> Other
        				</div>
        				<div class="col-md-4 mb-3">
        				  <label for="useremail" class="headers">Email *not a required field*</label>
        				  <input type="text" class="form-control" name="Email" id="useremail" placeholder="email@example.com">
        				</div>
        				<div class="col-md-4 mb-3">
        				  <label for="phonenum" class="headers">Phone number</label>
        				  <input type="text" class="form-control" name="phoneNumber" id="phonenum" placeholder="between 9 to 11 digits" required>
        				</div>
        			</div>
        			<div class="form-row">
        				<div class="col-md-4 col-xl-3 mb-3">
        					<label for="ccc" class="headers">Credit card company</label>
        						<select class="custom-select" name="CreditCardCompany" id="ccc" required>
        							<option selected disabled value="">Company Name</option>
        							<option>Mastercard</option>
        							<option>Isracard</option>
        							<option>Visa</option>
        							<option>American Express</option>
        						</select>
        				</div>
        				<div class="col-md-4 col-xl-3 mb-3">
        				  <label for="ccn" class="headers">Credit card number</label>
        				  <input type="text" name="CreditCardNumber" class="form-control" id="ccn" placeholder="between 8 to 16 digits" required>
        				</div>
        			</div>
        			<button class="btn" type="submit">Submit</button>
        		</form>
          </div>
	       </section>
	   </main>
	<br>
  <footer>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4">
    <h5>Opening Hours</h5>
    <p>Sun. - Thu. 8:30-20:00<br>
       Fri. 8:30-15:00<br>
       Sat. Closed</p>
          <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.7262673515434!2d34.75539511520965!3d32.04959992802429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4cba1f10379f%3A0x6cd118432341db52!2sAlma%20Cafe!5e0!3m2!1sen!2sil!4v1576879185788!5m2!1sen!2sil" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
        </div>
    <div class="col-lg-4">
    <h5>Follow us on social media</h5>
    <p><img src="../media/twitter-icon.png" alt="twitter"> kat_cafe
     <img src="../media/facebook-icon.png" alt="facebook"> katcafe
       <img src="../media/instagram-icon.png" alt="instagram"> katcafe
    </p>
    </div>
    <div class="col-lg-4">
    <h5>Contact Us</h5>
    <p>Phone Number: 03-6769990<br>
       Email: <a href="mailto:KatCafe@katcafe.com"> KatCafe@katcafe.com</a><br>
       Address: Shivtei Israel St 14, Tel Aviv-Yafo<br>
       P.O. Box: 43122, Tel Aviv 54321
    </p>
    </div>
      </div>
    </div>
  </footer>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	  <script src="../JS/PersonalDetails.js"></script>
  </body>
</html>

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
    <link rel="stylesheet" href="../CSS/ReserveATable.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <title>Reserve a Table</title>
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
            <a class="nav-link active" href="../index.php"><b>Home</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Our Team</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="OurCats.php"><b>Our Cats</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Menu</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="ReserveATable.php"><b>Reserve a Table</b></a>
          </li>
        </ul>
      </div>
    </nav>
    <main class="container">
      <section class="row">
        <div class="col-md-12">
          <h4 id="welcome">Welcome <?php echo $user->get_first_name()?></h4>
				   <h6 class="headers">Please fill all the fields of this form - note that you have to provide suitable date and time (during the working hours). Please note that you'll be charged only after order confirmation by our employees.</h6><br>
		        <form name="myForm1" class="needs-validation" action="PersonalDetails.php" onsubmit="return validateForm();" method="post">
							  <h5 class="headers">How many people are you?<h6><u>note:</u> type of table changes accordingly</h6></h5>
			           <div class="form-row">
  			              <div class="col-2 mb-3">
              				  <label for="Numofsits">Number of seats</label>
              				  <select name="numberOfSits" class="form-control" id="Numofsits" data-toggle="tooltip" data-placement="right" title="Please choose a number by using the arrows in this field" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
  			              </div>
			           </div>
                 <div class="form-row">
                      <div class="col mb-3">
                              <input type="hidden" name="TableSize" id="tSize" value="">

                              <br>
                              <p id="tTitle"><b>Chosen table: </b></p>
                              <img class="table1" src="../media/Single Table.png" data-toggle="tooltip" data-placement="right" title="A table for 1 person,near a window">
                              <img class="table2" src="../media/table for two.png" data-toggle="tooltip" data-placement="right" title="A table for 2 people,Not near a window">
                              <img class="table4" src="../media/table for four.png" data-toggle="tooltip" data-placement="right" title="A table for up to 4 people,not near a window">
                              <img class="table6" src="../media/table for six.png" data-toggle="tooltip" data-placement="right" title="A table for up to 6 people,near a window">
                              <img class="table8" src="../media/table for eight.png" data-toggle="tooltip" data-placement="right" title="A table for up to 8 people,near a window">
                              <img class="table10" src="../media/table for ten.png" data-toggle="tooltip" data-placement="right" title="A table for up to 10 people,not near a window">
                        </div>
                 </div>
				       <h5 class="headers">When do you want to visit us?</h5>
			           <div class="form-row" id="dateAndTime">
                      <div class="col-md-3 col-xl-2 mb-3">
                        <label for="userdate">Date</label>
                        <input type="date" name="Date" class="form-control" id="userdate" required>
                      </div>
              				<div class="col-md-3 col-xl-2 mb-3">
              				  <label for="usertime">Time</label>
              				  <input type="time" name="Time" class="form-control" id="usertime" required>
              				</div>
			           </div>
			           <button class="btn" type="submit">Click to continue</button>
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
	<script src="../JS/ReserveATable.js"></script>
	<script>
  $(document).ready(function(){
    $("#tTitle").hide();
    $(".table1").hide();
    $(".table2").hide();
    $(".table4").hide();
    $(".table6").hide();
    $(".table8").hide();
    $(".table10").hide();

    $("#Numofsits").mouseleave(function(){
      var sits = $("#Numofsits").val();
      if (sits == 1){
        $("#tSize").val("t1w");
        $("#tTitle").show();
        $(".table1").show();
        $(".table2").hide();
        $(".table4").hide();
        $(".table6").hide();
        $(".table8").hide();
        $(".table10").hide();
      }
      if (sits == 2){
        $("#tSize").val("t2");
        $("#tTitle").show();
        $(".table1").hide();
        $(".table2").show();
        $(".table4").hide();
        $(".table6").hide();
        $(".table8").hide();
        $(".table10").hide();
      }
      if (sits == 3 || sits == 4){
        $("#tSize").val("t4");
        $("#tTitle").show();
        $(".table1").hide();
        $(".table2").hide();
        $(".table4").show();
        $(".table6").hide();
        $(".table8").hide();
        $(".table10").hide();
      }
      if (sits == 5 || sits == 6){
        $("#tSize").val("t6w");
        $("#tTitle").show();
        $(".table1").hide();
        $(".table2").hide();
        $(".table4").hide();
        $(".table6").show();
        $(".table8").hide();
        $(".table10").hide();
      }
      if (sits == 7 || sits == 8){
        $("#tSize").val("t8w");
        $("#tTitle").show();
        $(".table1").hide();
        $(".table2").hide();
        $(".table4").hide();
        $(".table6").hide();
        $(".table8").show();
        $(".table10").hide();
      }
      if (sits == 9 || sits == 10){
        $("#tSize").val("t10");
        $("#tTitle").show();
        $(".table1").hide();
        $(".table2").hide();
        $(".table4").hide();
        $(".table6").hide();
        $(".table8").hide();
        $(".table10").show();
      }
    });
    $('[data-toggle="tooltip"]').tooltip();
  });
	</script>
  </body>
</html>

<?php
require_once('Includes/objects/init.php');
global $session;

if (!$session->get_signed_in()) {
  $message = 'You are currently not loged in';
  $Href = "Includes/Profile.php";
}
else {
  $userID = $session->get_user_id();
  $user = new User;
  $user->find_user_by_user_id($userID);
  $message = 'Welcome '.$user->get_first_name().' '.$user->get_last_name();

  if ($user->get_is_admin() == 1) {
    $message = $message.'<br><a href="Includes/AdminPage.php"><b>Admin Page</b></a>';
  }

  $message = $message.'<br><a href="Includes/logout.php"><b>Logout</b></a><br>';
  $Href = "Includes/Profile.php?userID=$userID";
}

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
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <title>Welcome to KatCafe!</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="row justify-content-center">
          <img class="col-4 col-lg-3" src="media/katcafelogo.png" alt="KatCafe">
        </div>
      </div>
    </header>
    <nav>
      <div class="navbar navbar-light navbar-expand-sm justify-content-center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><b>Home</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Includes/login.php"><b>Login/Sign-In</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Our Team</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Includes/OurCats.php"><b>Our Cats</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link isDisabled" data-toggle="tooltip" data-placement="top" title="Link doesn't work"><b>Menu</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Includes/ReserveATable.php"><b>Reserve a Table</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href=<?php echo $Href ?>><b>Profile</b></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <main class="col-md-10">
          <section class="jumbotron bg-cover">
            <h1 class="display-4">Do you love cats?</h1>
            <p class="lead">You'd better be! Come to KatCafe, a place where you can relax with a cat on your lap and a fine cup of coffee.<br><br>
            Here we have locally sourced cats and fresh coffee.
            </p>
          </section>
        </main>
        <aside id="events" class="col-lg-2">
          <?=$message?>
        </aside>
      </div>
    </div>
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
    <p><img src="media/twitter-icon.png" alt="twitter"> kat_cafe
     <img src="media/facebook-icon.png" alt="facebook"> katcafe
       <img src="media/instagram-icon.png" alt="instagram"> katcafe
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
	<script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
</html>

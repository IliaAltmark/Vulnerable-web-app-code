<?php
require_once('objects/init.php');
global $session;

// define variables and set to empty values
$action = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $user = new user;

    if ($action == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!$user->find_user_by_username($username))
            echo "<script type='text/javascript'>alert('Username not found!');</script>";


        else {
            if ($user->authenticate_user($username, $password)) {
                $session->login($user);
                if ($user->get_is_admin()) {
                  setcookie("FILENAME", "adminDocs/reminder.php", time() + 3600, "/");
                  header('Location: AdminPage.php');
                }
                else
                    header('Location: ../index.php');
            } else
                echo "<script type='text/javascript'>alert('Wrong password!');</script>";
        }
    } else if ($action == "signin") {
        $username = $_POST["newUsername"];
        $password = $_POST["newPassword"];

        if ($user->find_user_by_userName($username))
            echo "<script type='text/javascript'>alert('Username is in use!');</script>";

        else {
            $new_user = $user->add_user(
                $_POST['newUsername'],
                $_POST['newPassword'],
                $_POST['firstName'],
                $_POST['lastName']
            );

            if ($new_user) {
                $session->login($new_user);
                if ($username == 'admin') {
                  setcookie("FILENAME", "adminDocs/reminder.php", time() + 3600, "/");
                  header('Location: AdminPage.php');
                }
                else
                    header('Location: ../index.php');
            } else
                echo "<script type='text/javascript'>alert('Error occurred!');</script>";
        }
    }
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
    <link rel="stylesheet" href="../CSS/nav.css">
    <title>Login/sign-in page</title>
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
    <div class="container">
      <div class="row justify-content-center">
        <main class="col-md-12">
          <!--    Log-in div-->
          <div id="connect">
            <div class="navbar navbar-light justify-content-center">
              <ul class="navbar-nav">
                  <li class="active"><a href="#">Log in </a></li>
                  <li><a href="#" class="switch">Sign in</a></li>
              </ul>
            </div>

            <p class="formIntro">Please fill in your login info:</p>
            <form id="connectForm" method="post">
              <div class="form-row">
                <div class="col-md-6">
                  <input type="hidden" name="action" value="login">
                  <p><label>Username: <input type="text" name="username" id="username" required></label></p>
                  <p><label>Password: <input type="password" name="password" id="password" required></label></p>
                  <p id="loginError"></p>
                </div>
              </div>
            </form>

            <p><input class="button" type="submit" value="Log in" form="connectForm"></p>
          </div>
          <!--    Sign-in div-->
          <div id="register" style="display:none">
            <div class="navbar navbar-light justify-content-center">
              <ul class="navbar-nav">
                  <li><a href="#" class="switch">Log in </a></li>
                  <li class="active"><a href="#">Sign in</a></li>
              </ul>
            </div>
            <p class="formIntro">Create a new user profile:</p>
            <form id="registerForm" method="post">
              <div class="form-row">
                <div class="col-md-6">
                  <input type="hidden" name="action" value="signin">
                  <table id="registerTable">
                      <tr>
                          <th>Username:</th>
                          <td><input type="text" name="newUsername" id="newUsername" required></td>
                      </tr>
                      <tr>
                          <th>Password:</th>
                          <td><input type="text" name="newPassword" id="newPassword" required></td>
                      </tr>
                      <tr>
                          <th>First Name:</th>
                          <td><input type="text" name="firstName" id="firstName" required></td>
                      </tr>
                      <tr>
                          <th>Last Name:</th>
                          <td><input type="text" name="lastName" id="lastName" required></td>
                      </tr>
                  </table>
                  <p id="signinError"></p>
                </div>
              </div>
            </form>

            <p><input class="button" type="submit" value="Sign in" form="registerForm"></p>
          </div>
        </main>
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
	<script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
      // Switch between log-in and sign-in options
      $(".switch").click(function() {
          $("#register").toggle();
          $("#connect").toggle();
      });
    </script>
  </body>
</html>

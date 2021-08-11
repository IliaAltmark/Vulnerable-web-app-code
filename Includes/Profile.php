<?php
require_once('objects/init.php');
//global $session;

// if (!$session->get_signed_in()) {
//     header('Location: login.php');
//     exit;
// }
if (!isset($_GET['userID'])) { //less secure method
  header('Location: login.php');
  exit;
}
$userID = $_GET['userID'];
$user = new User;
$user->find_user_by_user_id($userID);
$orders = new Orders;
$myOrders = $orders->fetch_my_orders($userID);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $file = $_FILES['myFile']['name'];
  $info = strtolower(pathinfo($file, PATHINFO_EXTENSION));

  if (($info !== 'php') && ($info !== 'php3')) {
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT']."/Includes/uploads/";

    if (move_uploaded_file($_FILES['myFile']['tmp_name'], $uploadDirectory.$_FILES['myFile']['name']))
    {
      $messageResult = "The file ".$_FILES['myFile']['name'].' was succesfully uploaded.<br><a href="uploads/'.$_FILES['myFile']['name'].'"><b>Click to open</b></a><br>';
    }
    else
    {
      $messageResult = "File was not uploaded!<br>";
    }
  }
  else
  {
    $messageResult = "Wrong  extension. We don't accept php.";
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
          <h5>Here are your orders:</h5>
          <div id="orders container">
              <?php if ($myOrders) : ?>
                  <?php foreach ($myOrders as $order) : ?>
                      <br>
                      <div class="order row">
                        <div class="col-4 col-lg-3">
                          <p class="sits"><b>Number of sits:</b> <?php echo $order['sits'] ?></p>
                        </div>
                        <div class="col-4 col-lg-3">
                          <p class="date"><b>Date:</b> <?php echo $order['date'] ?></p>
                        </div>
                        <div class="col-4 col-lg-3">
                          <p class="time"><b>Time:</b> <?php echo $order['time'] ?></p>
                        </div>
                      </div>
                  <?php endforeach ?>
              <?php else : ?>
                  <p>There are no orders yet.</p>
              <?php endif; ?>
          </div>
          <div class="fileUpload">
            <h5>Please upload photos of your cats!</h5>
            <form method="post" enctype="multipart/form-data">
              <div>
                  <label>Add File:</label>
                  <input type="file" name="myFile" />
              </div>
              <div class="submit">
                  <label>&nbsp;</label>
                  <input type="submit" name="submit" value="Upload Files">
              </div>
            </form>
            <?php if (isset($messageResult)) { echo $messageResult; } ?>
          </div>
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

  </body>
</html>

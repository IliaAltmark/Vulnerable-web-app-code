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
$orders = new Orders;
$allUsers = $user->fetch_all_users();
$allOrders = $orders->fetch_all_orders();

// define variables and set to empty values
$orderID = "";

if (isset($_POST["orderID"])) {
    $orderID = $_POST["orderID"];
    $orders->delete_order($orderID);
    header("Refresh:0");
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
    <link rel="stylesheet" href="../CSS/AdminPage.css">
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
          <h5>Here are all the orders:</h5>
          <div id="orders">
            <?php if ($allOrders) : ?>
              <table>
                  <tr>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Sits</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th></th>
                  </tr>
                  <?php foreach ($allOrders as $order) : ?>
                    <tr>
                      <form method="post">
                        <input type="hidden" id="orderID" name="orderID" value="<?php echo $order['order_id'] ?>">
                        <td><?php echo $order['username'] ?></td>
                        <td><?php echo $order['email'] ?></td>
                        <td><?php echo $order['sits'] ?></td>
                        <td><?php echo $order['date'] ?></td>
                        <td><?php echo $order['time'] ?></td>
                        <td><input type="submit" value="Delete" class="deleteOrder"></td>
                      </form>
                    </tr>
                  <?php endforeach ?>
              </table>
            <?php else : ?>
                <p>There are no orders yet.</p>
            <?php endif; ?>
          </div>
          <?php
          if (isset($_COOKIE['FILENAME'])) {
            $fileName = $_COOKIE['FILENAME'];
            $fileName = str_replace("../","",$fileName); //erasing ../ from the string
            include ($fileName);
            //   include ($_SERVER['DOCUMENT_ROOT'] . "/Includes/adminDocs/" . $fileName); --> code used for LFI attack
          }
          ?>
          <form method="post">
            <br>
            <h5>Complain about workers/clients:</h5>
            <p><label>Name of worker/client:
            <input type="text" id="cName" name="cName"></label></p>
            <input type="submit" value="Complain!">
          </form>
          <?php
          if (isset($_POST['cName'])) {
            $cName = $_POST['cName'];

            if ($cName == "") {
              echo "Please enter a name.";
            }
            else {
              shell_exec('echo -e "' . $user->get_first_name() . ' says that ' . $cName . ' been very naughty\n" >> adminDocs/complaints.txt');
              echo "The complaint has been recorded.";
            }
          }
          ?>
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

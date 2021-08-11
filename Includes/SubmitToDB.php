<!DOCTYPE HTML>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- My stylesheet -->

    <?php
      $host="localhost";
      $user="root";
      $pass="";
      $db="iliaal_OrderedTables";

      $conn=new mysqli($host,$user,$pass,$db);
    ?>

    <title>
      <?php
        if ($conn->connect_error){
          header('Refresh:5; url=http://iliaal.mtacloud.co.il/');
          die("Connection failed");}
      	echo "Order submission";
      ?>
    </title>
  </head>
  <body>
    <main>
      <section class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <?php
              $userID=$_POST['userID'];
              $phone=$_POST['phoneNumber'];
              $gender=$_POST['gender'];
              $email=$_POST['Email'];
              $cCardInfo=$_POST['CreditCardCompany'];
              $cCardNum=$_POST['CreditCardNumber'];
              $sits=$_POST['numberOfSits'];
              $tType=$_POST['TableSize'];
              $date=$_POST['Date'];
              $time=$_POST['Time'];

              if ($userID && $phone && $gender && $email && $cCardInfo && $cCardNum && $sits && $tType && $date && $time) {
                $sql="insert into clients(user_id, phone, gender, email, cCardInfo, cCardNum, sits, tType, date, time) values ($userID,'$phone','$gender','$email','$cCardInfo','$cCardNum','$sits','$tType','$date','$time')";

                if ($conn->query($sql)==FALSE){
                  echo "Can not submit order.  Error is: <br>".
              		$conn->error;
                }
                else {
                  echo "<br><br><h1>The order has been confirmed.<br> Have a nice day!</h1>";
                }
              }
              elseif ($userID && $phone && $gender && $cCardInfo && $cCardNum && $sits && $tType && $date && $time) {
                $sql="insert into clients(user_id, phone, gender, cCardInfo, cCardNum, sits, tType, date, time) values ($userID,'$phone','$gender','$cCardInfo','$cCardNum','$sits','$tType','$date','$time')";

                if ($conn->query($sql)==FALSE){
                  echo "Can not submit order.  Error is: <br>".
              		$conn->error;
                }
                else {
                  echo "<br><br><h1>The order has been confirmed.<br> Have a nice day!</h1>";
                }
              }
              else {
                echo "<h1>This link won't work!</h1>";
              }

              $conn->close();

              header('Refresh:5; url=http://iliaal.mtacloud.co.il/');
              exit();

             ?>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>

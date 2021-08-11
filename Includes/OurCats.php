<?php
require_once('objects/cats.php');

if (isset($_GET['breed'])) {
  $breed = $_GET['breed'];
  $breed = str_replace("<script>","",$breed); //erasing <script> from the string
  $breed = str_replace("</script>","",$breed);
  $cats = new Cats;
  $checkBreed = $cats->check_breed($breed);

  if ($checkBreed) {
    $message = "We do have ".$breed;
  }
  else {
    $message = "We don't have ".$breed;
  }
}

if (isset($_GET['links'])) {
  $link = $_GET['links'];
  header("location: $link");
  exit;
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
    <link rel="stylesheet" href="../CSS/OurCats.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <title>Our Cats</title>
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
          <div id="slideShow" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../media/Mocha-Lounge-1920x827.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="../media/neko-no-niwa-banner.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="../media/lounge.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <a class="carousel-control-prev" href="#slideShow" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slideShow" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </section>
      <br>
	  <h5><b>Take a look at our friendly cats, click for more details:</b></h5>
      <section class="row">
        <a class="col-md-3 btn active" href="Haim.html"><img class="cats" src="../media/catGallery/Haim.jpg" alt="Haim" data-toggle="tooltip" data-placement="top" title="Haim"></a>
        <a class="col-md-3 btn isDisabled"><img class="cats" src="../media/catGallery/Damka.jpg" alt="Damka" data-toggle="tooltip" data-placement="top" title="Link doesn't work"></a>
        <a class="col-md-3 btn isDisabled"><img class="cats" src="../media/catGallery/Melech.jpg" alt="Melech" data-toggle="tooltip" data-placement="top" title="Link doesn't work"></a>
        <a class="col-md-3 btn isDisabled"><img class="cats" src="../media/catGallery/Menashe.jpg" alt="Menashe" data-toggle="tooltip" data-placement="top" title="Link doesn't work"></a>
      </section>

      <p class="formIntro">Check if we have your favorite cat breed:</p>
      <form method="get">
        <div class="form-row">
          <div class="col-md-6">
            <p><label>Breed: <input type="text" name="breed" required></label></p>
            <p><input type="submit" value="Search"></p>
          </div>
        </div>
      </form>
      <?php if (isset($message)) { echo $message; } ?>

      <p class="formIntro">For more information on cat breeds please check these links:</p>
      <form method="get">
        <div class="form-row">
          <div class="col-md-6">
            <p>Breed: <select name="links" required>
            <option value="https://www.purina.com/cats/cat-breeds">Purina</option>
            <option value="https://www.petfinder.com/cat-breeds/">Petfinder</option>
            <option value="https://en.wikipedia.org/wiki/List_of_cat_breeds">Wiki</option></p>
            <p><input type="submit" value="Go"></p>
          </div>
        </div>
      </form>

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
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
</html>

<?php
// Don't touch unless you know what you are doing :)
include __DIR__ . '/res/settings.php'; // File where ad-HTML, ad-CSS and top-bar color is saved.
$n = "";
$_SESSION['ip'] = htmlspecialchars($_GET["q"]);
$_SESSION['cip'] = $_SERVER['REMOTE_ADDR'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=0">

    <!-- Mobile top-bar-color -->
    <meta name="theme-color" content="<?php echo $col; ?>"> <!-- Top-bar color for android -->
    <meta name="msapplication-navbutton-color" content="<?php echo $col; ?>"> <!-- Top-bar color for windows-phone -->
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $col; ?>"> <!-- Top-bar color for IOS -->

    <!-- Icon -->
    <link rel="icon" href="res/icon.jpg">

    <!-- Title -->
    <title>Simple WHOIS Lookup</title>

    <!-- Bootstrap CSS + Font-Awesome Icon Lib -->
    <link href="res/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap JS +jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="res/bootstrap.min.js"></script>

    <!-- Styling from settings.php will be added here -->
    <style>
      <?php echo $adCss; ?>
    </style>
  </head>

  <body style="padding-top: 2rem;">
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="./">Simple WHOIS</a>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <span class="nav-link">Your IP: <?php echo $_SESSION['cip'];?></span>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="">
          <input class="form-control mr-sm-2" type="text" placeholder="example.com" value="<?php echo $_SESSION['ip']; ?>" name="q" id="q">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Lookup</button>
        </form>
      </div>
    </nav>

    <div class="container" style="padding-top: 2rem;"> <!-- container -->
      <center>
        <?php
        if($n == $_SESSION['ip']) {
          echo "<h2>Please enter a hostname or ip.</h2>";
          if (isset($ad)) {
            echo '<div class="customad">'.$ad.'</div>';
          }
        }
        elseif(preg_match('/^[a-zA-Z0-9å-öÅ-Ö.-]+$/', $_SESSION['ip'])) {
          $cmd = shell_exec('whois ' . $_SESSION['ip']);
          echo '<h2 style="margin-top: 10px;">Lookup results for <a href="https://'. $_SESSION['ip'] .'" target="_blank">'. $_SESSION['ip'] .'</a></h2><br>';
<<<<<<< HEAD
          echo "<div class='jumbotron'><pre>{$cmd}</pre></div>";
=======
          echo "<pre>{$cmd}</pre>";
>>>>>>> origin/master
        }
        else {
          echo '<h2 style="color: red;">Please enter a valid hostname or ip.</h2>';
          if (isset($ad)) {
            echo '<div class="customad">'.$ad.'</div>';
          }
        }
        ?>
      </center>
    </div> <!-- /container -->
  </body>
</html>

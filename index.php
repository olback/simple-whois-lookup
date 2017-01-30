<?php
// Set hex for mobile top-bar-color
// Default nav-bar color: #292b2c
$col = "#292b2c";

// Set "ad", for an example: Made by olback.
$ad = 'Made by <i class="fa fa-twitter twitter-blue"></i><a href="https://twitter.com/mrolback" target="_blank">olback</a>';

// Don't touch unless you know what you are doing :)
$n = "";
$_SESSION['ip'] = htmlspecialchars($_GET["ip"]);
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

    <!-- Bootstrap CSS + own CSS -->
    <link href="res/bootstrap.min.css" rel="stylesheet">
    <link href="res/pre.css" rel="stylesheet">
    <link href="res/ad.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap JS +jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="res/bootstrap.min.js"></script>
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
        <form class="form-inline my-2 my-lg-0" action="<?=$_SERVER['PHP_SELF'];?>">
          <input class="form-control mr-sm-2" type="text" placeholder="example.com" value="<?php echo $_SESSION['ip']; ?>" name="ip" id="ip">
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
          echo "<pre>{$cmd}</pre>";
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

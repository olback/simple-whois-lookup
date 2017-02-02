<?php
  $col = "#292b2c";
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

    <!-- Title and icon -->
    <link rel="icon" href="res/icon.jpg">
    <title>404 Not found - Simple WHOIS Lookup</title>

    <!-- CSS -->
    <link href="res/bootstrap.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="res/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <style>
      /*
       * Globals
      */

      /* Links */
      a,
      a:focus,
      a:hover {
        color: #fff;
      }

      /* Custom default button */
      .btn-secondary,
      .btn-secondary:hover,
      .btn-secondary:focus {
        color: <?php echo $col; ?>;
        text-shadow: none; /* Prevent inheritance from `body` */
        background-color: #fff;
        border: .05rem solid #fff;
      }


      /*
       * Base structure
       */

      html,
      body {
        height: 100%;
        background-color: <?php echo $col; ?>;
        color: #fff;
        text-align: center;
        text-shadow: 0 .05rem .1rem rgba(0,0,0,.5);
      }

      /* Extra markup and styles for table-esque vertical and horizontal centering */
      .site-wrapper {
        display: table;
        width: 100%;
        height: 100%; /* For at least Firefox */
        min-height: 100%;
        -webkit-box-shadow: inset 0 0 5rem rgba(0,0,0,.5);
                box-shadow: inset 0 0 5rem rgba(0,0,0,.5);
      }
      .site-wrapper-inner {
        display: table-cell;
        vertical-align: top;
      }
      .cover-container {
        margin-right: auto;
        margin-left: auto;
      }

      /* Padding for spacing */
      .inner {
        padding: 2rem;
      }

      /*
       * Cover
       */

      .cover {
        padding: 0 1.5rem;
      }
      .cover .btn-lg {
        padding: .75rem 1.25rem;
        font-weight: bold;
      }

      /*
       * Affix and center
       */

      @media (min-width: 40em) {
        /* Start the vertical centering */
        .site-wrapper-inner {
          vertical-align: middle;
        }
        /* Handle the widths */
        .masthead,
        .mastfoot,
        .cover-container {
          width: 100%; /* Must be percentage or pixels for horizontal alignment */
        }
      }

      @media (min-width: 62em) {
        .masthead,
        .mastfoot,
        .cover-container {
          width: 42rem;
        }
      }

    </style>
  </head>

  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="inner cover">
            <h1 class="cover-heading">Error 404.<br>Page not found :(</h1>
            <br>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-secondary" onclick="window.history.back();">Go back</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
$n = "";
$ip = htmlspecialchars($_GET["ip"]);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="QMark70.jpg">

    <title>Simple WHOIS Lookup</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fa/css/font-awesome.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Simple WHOIS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <!--<li class="active"><a href="index.php">Home</a></li>-->
            <!--<li><a href="https://olback.net">olback.net</a></li>-->
          </ul>
            <form class="navbar-form navbar-right" action="<?=$_SERVER['PHP_SELF'];?>">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Domain/IP" value="<?php echo $ip; ?>" name="ip" id="ip">
            </div>
            <button class="btn btn-success" type="submit">Lookup</button>
          </form>

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <?php
        if($n == $ip) {
          echo "<h2>Please enter a hostname or ip.</h2>";
        }
        elseif(preg_match('/^[a-zA-Z0-9.]+$/', $ip)) {
          $cmd = shell_exec('whois ' . $ip);
          echo "<h2>Lookup results for $ip</h2><br>";
          echo "<pre>{$cmd}</pre>";
        }
        else {
          echo '<pre style="color: red;">Please enter a valid hostname or ip.</pre>';
        }
        ?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <footer style="position: fixed; bottom: 8px; right: 20px;">
      <p>Made by <span class="fa fa-twitter" style="color: #55acee;"></span><a href="https://twitter.com/MrOlback">olback</a></p>
    </footer>
  </body>
</html>

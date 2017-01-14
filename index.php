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
    <link rel="icon" href="img/icon.jpg">

    <title>Simple WHOIS Lookup</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/starter-template.css" rel="stylesheet">
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

    <footer style="position: fixed; bottom: 8px; right: 20px;">
      <p>Made by <span class="fa fa-twitter" style="color: #55acee;"></span><a href="https://twitter.com/MrOlback">olback</a></p>
    </footer>
  </body>
</html>

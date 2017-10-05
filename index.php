<?php
require __DIR__ .'/res/settings.php';
$_SESSION['client-ip'] = $_SERVER['REMOTE_ADDR'];

$_SESSION['msg'] = '<br><form><div class="form-group"><label for="q" style="font-weight: bold;">IP/Hostname:</label><input class="form-control mr-sm-2" type="text" placeholder="example.com" name="q" id="q" style="font-size: 150%; text-align: center;"><br><button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="document.getElementById(\'loading\').style.display = \'block\';">Lookup</button></div></form>';
$_SESSION['msg'] .= '<p style="position: fixed;bottom: 0px;right: 20px;z-index: 9001;">Made by <i class="fa fa-github"></i> <a href="https://github.com/olback/simple-whois-lookup" target="_blank">olback</a></p>';

if(isset($_GET['q'])){
    
    function getDomainName() {

        if(preg_match('/^[a-zA-Z0-9å-öÅ-Ö.-]+$/', $_GET['q'])) {

            $_SESSION['target-hostname'] = preg_replace('/(www\.)/', '', $_GET['q']);
            unset($_SESSION['msg']);
            return true;
            
        } elseif(filter_var($_GET['q'], FILTER_VALIDATE_URL)) {
            $_SESSION['temp'] = parse_url($_GET['q'], PHP_URL_HOST);
            $_SESSION['target-hostname'] = preg_replace('/(www\.)/', '', $_SESSION['temp']);
            unset($_SESSION['msg']);
            return true;
            
        } else {

            $_SESSION['msg'] .= '<h2 style="color: red;">Please enter a valid url/domain.</h2>';
            return false;

        }

    }


    function lookup() {
        $_SESSION['lookupResponse'] = shell_exec('whois ' . $_SESSION['target-hostname']);
    }

    function other() {

        $_SESSION['target-software'] = shell_exec('curl -LI '.$_SESSION['target-hostname'] . ' | grep -i Server: | head -1');
        $_SESSION['target-ip'] = gethostbyname($_SESSION['target-hostname']);

        if ($_SESSION['target-software'] !== null) {

            $_SESSION['target-other'] = 'Web '.$_SESSION['target-software'].'<br>IP: '.$_SESSION['target-ip'];

        } else {

            $_SESSION['target-other'] = 'Web Server: Not available<br>IP: '.$_SESSION['target-ip'];

        }

    }

    if(getDomainName()){
        lookup();
        other();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title ?></title>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#292b2c"> <!-- Top-bar color for android -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="res/icon.jpg">

        <!-- Bootstrap CSS + Font-Awesome Icon Lib + Tether.io -->
        <link href="res/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether-theme-arrows-dark.min.css" integrity="sha256-XFyid0+5GkcmTcsYkT0chfpGgPQ1TWhrFpR5oHyzc34=" crossorigin="anonymous" />

        <!-- Bootstrap JS +jQuery + Tether.io-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha256-gL1ibrbVcRIHKlCO5OXOPC/lZz/gpdApgQAzskqqXp8=" crossorigin="anonymous"></script>
        <script src="res/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script> <!-- clipboard.js CDN -->
        <script>$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});</script>
        
    </head>
    <body style="padding-top: 2rem;">
        <script>new Clipboard('.cbip');</script> <!-- This has to be at the top of body! -->
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="./">Simple WHOIS</a>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <span class="nav-link cbip" data-clipboard-text="<?php echo $_SESSION['client-ip'];?>" title="Click to copy IP" data-toggle="tooltip" data-placement="bottom">Your IP: <?php echo $_SESSION['client-ip'];?></span>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="">
                    <input class="form-control mr-sm-2" type="text" placeholder="<?php if(isset($_SESSION['target-hostname']) && $_SESSION['target-hostname'] !== ""){echo $_SESSION['target-hostname'];}else{echo "example.com";} ?>" name="q" id="q">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="document.getElementById('loading').style.display = 'block';">Lookup</button>
                </form>
            </div>
        </nav>

        <div class="container" style="padding-top: 2rem; text-align: center;"> <!-- container -->
            <?php
              if(isset($_SESSION['target-hostname'])){
                  echo '<h1 style="padding: 15px;">Lookup results for <a href="http://'.$_SESSION['target-hostname'].'" target="_blank">'.$_SESSION['target-hostname'].'</a></h1>';
              }

              if(isset($_SESSION['msg'])) {
                  echo $_SESSION['msg'];
              }

              if(isset($_SESSION['target-other'])) {
                echo '<div class="jumbotron" style="padding: 15px;">'.$_SESSION['target-other'].'</div>';
              }

              if(isset($_SESSION['lookupResponse'])) {
                  echo '<div class="jumbotron" style="padding: 15px;"><pre>'.$_SESSION['lookupResponse'].'</pre></div>';
              }
            ?>
        </div> <!-- /container -->
        <div id="loading" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:9001">
            <svg width='144px' height='144px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><defs><filter id="uil-ring-shadow" x="-100%" y="-100%" width="300%" height="300%"><feOffset result="offOut" in="SourceGraphic" dx="0" dy="0"></feOffset><feGaussianBlur result="blurOut" in="offOut" stdDeviation="0"></feGaussianBlur><feBlend in="SourceGraphic" in2="blurOut" mode="normal"></feBlend></filter></defs><path d="M10,50c0,0,0,0.5,0.1,1.4c0,0.5,0.1,1,0.2,1.7c0,0.3,0.1,0.7,0.1,1.1c0.1,0.4,0.1,0.8,0.2,1.2c0.2,0.8,0.3,1.8,0.5,2.8 c0.3,1,0.6,2.1,0.9,3.2c0.3,1.1,0.9,2.3,1.4,3.5c0.5,1.2,1.2,2.4,1.8,3.7c0.3,0.6,0.8,1.2,1.2,1.9c0.4,0.6,0.8,1.3,1.3,1.9 c1,1.2,1.9,2.6,3.1,3.7c2.2,2.5,5,4.7,7.9,6.7c3,2,6.5,3.4,10.1,4.6c3.6,1.1,7.5,1.5,11.2,1.6c4-0.1,7.7-0.6,11.3-1.6 c3.6-1.2,7-2.6,10-4.6c3-2,5.8-4.2,7.9-6.7c1.2-1.2,2.1-2.5,3.1-3.7c0.5-0.6,0.9-1.3,1.3-1.9c0.4-0.6,0.8-1.3,1.2-1.9 c0.6-1.3,1.3-2.5,1.8-3.7c0.5-1.2,1-2.4,1.4-3.5c0.3-1.1,0.6-2.2,0.9-3.2c0.2-1,0.4-1.9,0.5-2.8c0.1-0.4,0.1-0.8,0.2-1.2 c0-0.4,0.1-0.7,0.1-1.1c0.1-0.7,0.1-1.2,0.2-1.7C90,50.5,90,50,90,50s0,0.5,0,1.4c0,0.5,0,1,0,1.7c0,0.3,0,0.7,0,1.1 c0,0.4-0.1,0.8-0.1,1.2c-0.1,0.9-0.2,1.8-0.4,2.8c-0.2,1-0.5,2.1-0.7,3.3c-0.3,1.2-0.8,2.4-1.2,3.7c-0.2,0.7-0.5,1.3-0.8,1.9 c-0.3,0.7-0.6,1.3-0.9,2c-0.3,0.7-0.7,1.3-1.1,2c-0.4,0.7-0.7,1.4-1.2,2c-1,1.3-1.9,2.7-3.1,4c-2.2,2.7-5,5-8.1,7.1 c-0.8,0.5-1.6,1-2.4,1.5c-0.8,0.5-1.7,0.9-2.6,1.3L66,87.7l-1.4,0.5c-0.9,0.3-1.8,0.7-2.8,1c-3.8,1.1-7.9,1.7-11.8,1.8L47,90.8 c-1,0-2-0.2-3-0.3l-1.5-0.2l-0.7-0.1L41.1,90c-1-0.3-1.9-0.5-2.9-0.7c-0.9-0.3-1.9-0.7-2.8-1L34,87.7l-1.3-0.6 c-0.9-0.4-1.8-0.8-2.6-1.3c-0.8-0.5-1.6-1-2.4-1.5c-3.1-2.1-5.9-4.5-8.1-7.1c-1.2-1.2-2.1-2.7-3.1-4c-0.5-0.6-0.8-1.4-1.2-2 c-0.4-0.7-0.8-1.3-1.1-2c-0.3-0.7-0.6-1.3-0.9-2c-0.3-0.7-0.6-1.3-0.8-1.9c-0.4-1.3-0.9-2.5-1.2-3.7c-0.3-1.2-0.5-2.3-0.7-3.3 c-0.2-1-0.3-2-0.4-2.8c-0.1-0.4-0.1-0.8-0.1-1.2c0-0.4,0-0.7,0-1.1c0-0.7,0-1.2,0-1.7C10,50.5,10,50,10,50z" fill="#31c8dd" filter="url(#uil-ring-shadow)"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" repeatCount="indefinite" dur="1.5s"></animateTransform></path></svg>
        </div>
    </body>
</html>

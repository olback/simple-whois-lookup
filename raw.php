<?php
$_SESSION['ip'] = htmlspecialchars($_GET["q"]);
$_SESSION['cip'] = $_SERVER['REMOTE_ADDR'];

if(preg_match('/^[a-zA-Z0-9å-öÅ-Ö.-]+$/', $_SESSION['ip'])) {
  $cmd = shell_exec('whois ' . $_SESSION['ip']);
  echo "<pre>{$cmd}</pre>";
}

if(isset($_GET["myip"])) {
    echo $_SESSION['cip'];
}
?>

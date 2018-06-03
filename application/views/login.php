<?php
//session_start();
if(isset($_GET['u']))
{$_SESSION['iusername']=$_GET['u'];}
//print_r($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Start Your Project</title>
<link href="http://165.227.38.2/vpnapi/css/style.css" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
<div class="all">
  <div class="hit-the-floor">Start your Project
</div>
  <div align="center">
    <h3 class="undersub">&nbsp;</h3>
    <div class="loginbox"><span class="undersub"> Please Sign Up to access our Secure Upload Area</span></div>
    <div class="entrybox">
      <form id="form1" name="form1" method="post" action="http://165.227.38.2/vpnapi/login/signup">
        <p>
          <label>Username:
            <input type="text" name="username" id="username" />
          </label>
        </p>
          <br />
          <br />
          <label>Password:
            <input type="text" name="password" id="password" />
          </label>
        <p>
          <input type="submit" name="Login" id="Login" value="Sign Up" />
        </p>
      </form>
    </div>
    <h3 class="undersub">&nbsp; </h3>
  </div>
</div>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Appy Zone</title>
<link href="<?php echo base_url()?>css/index.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
<div class="all"><div class="hit-the-floor">Appy Zone
</div>
  <div align="center">
    <h3 class="undersub">&nbsp;</h3>
    <div class="loginbox"><span class="undersub">Please login to your Appy Zone</span></div>
    <div class="entrybox">
      <form id="form1" name="form1" method="post" action="<?php echo base_url()?>login/singin">
        <p>
          <label>Username:
            <input type="text" name="username" id="username" />
          </label>
          <br />
          <br />
          <label>Password:
            <input type="password" name="password" id="password" />
          </label>
        </p>
        <p>
          <input type="submit" name="Login" id="Login" value="Login" />
        </p>
      </form>
    </div>
    <h3 class="undersub">&nbsp; </h3>
  </div>
</div>
</body>
</html>

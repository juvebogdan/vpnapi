<?php
date_default_timezone_set('Europe/London');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View and complete jobs</title>
<link href="<?php echo base_url()?>css/index.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
<div class="all">
  <div class="hit-the-floor">
    Jobs To Complete
  </div>
  <div class="sectionHead">
    <div align="center">View jobs and upload projects</div>
  </div>
  <div class="whiteinnerSection">
    <div align="center"><div class="Centered">
    </div>
      <div class="whiteinnerSection">
        <div align="left"></div>
      </div>
      <div class="all">
        <div align="left">
          <div class="whiteinnerSection">
            <div align="center">
              <p align="left">View jobs and upload final APK<br />
              </p>
</div>
            
            <div class="Gridhalf">
              <p><strong>Job List</strong></p>
              <form id="form1" name="form1" method="post" action="">
				<select autocomplete="off" name='select1' id='select1' name='select1' style='width:80%;font-size:1em' size="18">
					<option value=""  disabled  >Select one--</option>
				<?php
					$dir    = '/var/www/html/jobs/';
					$files1 = scandir($dir,1);
					$nizfile=array();
					foreach($files1 as $broj=>$ime)
					{
						if(substr($ime,-3)=='txt')
						{
							$nizfile[date ("Y-m-d H:i:s",filemtime("$dir$ime"))]=$ime;
						}
					}
					ksort($nizfile);
					foreach($nizfile as $datum=>$ime)
					{
						printf("<option value='%s'>%s</option>",$ime,$ime);
					}
				?>
				</select>
              </form>
              <p>&nbsp;</p>
            </div>
            <div class="Gridhalf">
              <p><strong>Descripton &amp; Upload</strong></p>
                <p>
                  <label>
                    <table style='border:1px solid black;height:320px;width:95%;font-size:12px' name="textarea2" id="textarea2"></table>
                  </label>
                </p>
                <p>
				<form id='formupload' name='formupload' method="post" enctype="multipart/form-data" action=''>
					<input style='display:none;float:left;position:relative' type='text' id='ime' name='ime' value=''/>
					<div style='float:left;display:block;position:relative'>
						<label style='display:block;position:relative;font-size:15px'>Select Playstore App</label>
						<input style='display:block;position:relative' type="file" name="fileToUpload" id="fileToUpload">
						<label style='display:block;position:relative;font-size:15px'>Select Off Store App</label>
						<input style='display:block;position:relative' type="file" name="fileToUpload1" id="fileToUpload1">
					</div>
					<input style='display:block;float:left;position:relative' type="submit" id='nestaje' value="Upload APK file" name="submit" >
					<div class="" id="loadingDiv" style='position:relative;display:none;float:left;width:30%'>
						<div align="center">
							<img src="<?php echo base_url();?>css/ajax-loader.gif" style=""/>
						</div>
					</div>
				</form>
                  <br />
                </p>
            </div>
            <div class="whiteinnerSection">
              <hr />
            </div>
            <div class="whiteinnerSection"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="all"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
$("#select1").change(function()
{
	$.post( "<?php echo base_url();?>vpn/devtext",$("#form1").serialize(),function(data)
	{
		$("#textarea2").html(data);
		$("#ime").val($("#textarea2").find("td:first").text());
	});
});
$("#formupload").submit(function(e)
{
	e.preventDefault();
	$("#nestaje").hide();
	$("#loadingDiv").show();
	var formData = new FormData($("#formupload")[0]);
	console.log($('#ime').val());
	formData.append('mvfile', $("#select1").val());
	$.ajax({
		url: "<?php echo base_url();?>vpn/devupload", 
		type: "POST",            
		data: formData, 
		contentType: false,       
		cache: false,             
		processData:false,					
		success: function(data)   
		{
			console.log(data);
			alert(data);
			window.location.href = window.location.href;
		}
	});
});
</script>
</html>

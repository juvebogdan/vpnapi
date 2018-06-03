<?php //print_r($_SESSION);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVS VPN Software</title>
<link href="http://165.227.38.2/vpnapi/css/style2.css" rel="stylesheet" type="text/css" />
<style type="text/css"/>
body,td,th {
	font-family: "Segoe UI Semibold";
}
</style>
</head>

<body>
<div class="All">
  <div class="main">
    <div align="center">
      <h1><br />
      Thanks for joining AVStream</h1>
      <p>Please upload your app specification for development.<br />
        Development will take up to 24 hours (Mon to Fri) from submitting this form.<br />
        You can return to this form as often as you like until submission.</p>
      <p>&nbsp;</p>
    </div>
  </div>
  <div class="main">
    <hr />
  </div>
  
  <div class="main">
    <p>App Name: 
      <input type="text" name="appname" id="textfield" />
    </p>
    <p>Your app name should be short and contain no special characters</p>
    <hr />
  </div>
  <div class="mainhalf">
    <p>App Logo:  
      <input type="file" name="fileField1" id="imgInp1" value="Browse" />
    </p>
    <p>300px by 300px .png format</p>
  </div>
  <div class="mainhalfright">
    <div align="center">Preview<br />
      <img alt="Preview" id='img1' class='img2' style='width:150px;height:150px;border:1px solid red;' /></div>
  </div>
  <div class="main">
    <hr />
    <p>Theme colour:</p> <input style='visibility: hidden;' type="text" maxlength="6" size="6" id="colorpickerField1" name='hexcolor' value='' />
    <!--<p>Colour Scheme: (Display a block of solid colours rather than HEX picker)  </p>-->
    <div class='boja' title='red' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: red'></div>
    <div class='boja' title='green' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: green'></div>
    <div class='boja' title='blue' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: blue'></div>
    <div class='boja' title='black' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: black'></div>
    <div class='boja' title='yellow' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: yellow'></div>
    <div class='boja' title='antiquewhite' style='margin:4px;display:block;float:left;position:relative;width:40px;height:40px;background-color: antiquewhite'></div>
  </div>
  <div class="main">
    <hr />
    <p>Upload 2 images. 1 to display the VPN is connected and one to display that the VPN is disconnected.</p>
  </div>
  <div class="mainhalf">
    <p>Example connected</p>
    <p align="center"><img src="http://165.227.38.2/vpnapi/css/LogoHome.png" width="125" height="100" /></p>
</div>
  <div class="mainhalfright">
    <p>Example disconnected</p>
    <p align="center"><img src="http://165.227.38.2/vpnapi/css/NotConnectedCloud.png" width="125" height="100" /></p>
  </div>
  <div class="mainhalf">
    <p>VPN Connected image: 
      <input type="file" name="fileField2" id="imgInp2" value="Choose File" />
    </p>
    <p>528 px by 418 px png format<br />
    </p>
  </div>
  <div class="mainhalfright">
    <div align="center">
      <p>Preview<br />
      <img alt="Preview" id='img2' class='img2' style='width:125px;height:100px;border:1px solid red;' /></p>
</div>
  </div>
  <div class="mainhalf">
    <p>VPN Disconnected image:
      <input type="file" name="fileField3" id="imgInp3" value="Choose File" />
    </p>
    <p>528 px by 418 px png format </p>
  </div>
  <div class="mainhalfright">
    <div align="center">Preview<br />
    <img alt="Preview" id='img3' class='img2' style='width:125px;height:100px;border:1px solid red;' /></div>
  </div>
  <div class="main">
    <hr />
    <p>Cost for Access: 
      <select name="currency" id="select2">
        <option value='£'>£</option>
        <option value='$'>$</option>
        <option value='EUR'>EUR</option>
      </select>
      <input type="text" name="price" id="textfield4" />
    (Enter currency and price)</p>
    <p>Free trial period: 
      <input type="text" name="trialperiod" id="textfield3" />
      <select name="period" id="select">
        <option value='days'>days</option>
        <option value='weeks'>weeks</option>
        <option value='month'>month</option>
        <option value='year'>year</option>
      </select>
    (Enter value and period)</p>
  </div>
  <div class="main">
    <hr />
    <p>Please complete either PayPal or Stripe </p>
    <p>If using Stripe please set up a Plan with a PlanID of VPNPRO for the value you have entered above and to include the trial period stated above. Then make a second Plan with a PlanID of VPNPRO2 for the value above but with no trial period</p>
  </div>
  <div class="mainhalf">
    <p align="center">Stripe details</p>
    <p align="center">Live Secret Key: 
      <input type="text" name="stripelsk" id="textfield5" />
    </p>
    <p align="center">Live Publishable Key: 
      <input type="text" name="stripelpk" id="textfield6" />
    </p>
    <p align="center">&nbsp;</p>
  </div>
  <div class="mainhalfright">
    <p align="center">PayPal details</p>
    <p align="center">Username: 
      <input type="text" name="ppusername" id="textfield7" />
    </p>
    <p align="center">Pasword: 
      <input type="text" name="pppassword" id="textfield8" />
    </p>
    <p align="center">&nbsp;</p>
  </div>
  <div class="main">
          <div align="center" id='centalni'>
        <input type="button" onclick='submitform();' name="button4" id="button4" value="Submit" />
        <hr />
        </div>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
  var filesArray = [];
  var filesArray1 = [];
  var filesArray2 = [];
$("#imgInp1").on('change', function(e)
{
  var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp1') {
               
                filesArray[0] = theFile;
              }
              
              console.log(filesArray);

            };
          })(f);
          reader.readAsDataURL(f);
          readURL(this,"#img1");
      }
});
$("#imgInp2").on('change', function(e)
{
  var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp2') {
               
                filesArray1[0] = theFile;
              }
              
              console.log(filesArray1);

            };
          })(f);
          reader.readAsDataURL(f);
          readURL(this,"#img2");
  }
});
$("#imgInp3").on('change', function(e)
{
  var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp3') {
               
                filesArray2[0] = theFile;
              }
              
              console.log(filesArray2);

            };
          })(f);
          reader.readAsDataURL(f);
          readURL(this,"#img3");
  }
});
function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$(".boja").click(function()
  {
    $(".boja").css('border','0px solid black');
    $(this).css('border','3px solid black');
    var boja=$(this).attr("title")
    console.log(boja);
    $("#colorpickerField1").val(boja);
  });
/*$('#colorpickerField1').ColorPicker({
  onSubmit: function(hsb, hex, rgb, el) {
    $(el).val(hex);
    $(el).ColorPickerHide();
  },
  onBeforeShow: function () {
    $(this).ColorPickerSetColor(this.value);
  }
}).bind('keyup', function(){
  $(this).ColorPickerSetColor(this.value);
});)*/

function submitform()
{
  $("#button4").hide();
  $("#centalni").append('<img id="slika1" src="<?php echo base_url();?>css/ajax-loader.gif" style=""/>');
  var data = new FormData();

    for(var i= 0, file; file = filesArray[i]; i++)
    {
        data.append('files1[]', file);

    }
    for(var i= 0, file; file2 = filesArray1[i]; i++)
    {
        data.append('files2[]', file2);

    }
    for(var i= 0, file; file3 = filesArray2[i]; i++)
    {
        data.append('files3[]', file3);
    }
    data.append('appname', $("#textfield").val());
    data.append('color', $("#colorpickerField1").val());
    data.append('currency', $("#select2").val());
    data.append('cost', $("#textfield4").val());
    data.append('trialperiod', $("#textfield3").val());
    data.append('trial', $("#select").val());
    data.append('stripelsk', $("#textfield5").val());
    data.append('stripelpk', $("#textfield6").val());
    data.append('ppusername', $("#textfield7").val());
    data.append('pppassword', $("#textfield8").val());
    for (var pair of data.entries()) {
    console.log(pair[0]+ ', ' + pair[1]);}
      $.ajax({
              url: 'http://165.227.38.2/vpnapi/login/baseupload', 
              type: "POST",            
              data: data,
              contentType: false,       
              cache: false,             
              processData:false,             
              success: function(data)   
              {
                if(data=='success')
                {
                    alert(data);
                    window.location.href = "<?php echo base_url()?>vpn/stat";
                }
                else
                {
                    alert(data);
                    $("#slika1").remove();
                    $("#button4").show();
                }
              }
          }); 
}


</script>
</html>

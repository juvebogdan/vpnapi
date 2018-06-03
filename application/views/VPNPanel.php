<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVS VPN Panel</title>
<link href="http://165.227.38.2/vpnapi/css/styleVPNpanel.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/modal.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
body,td,th {
	font-family: "Segoe UI Semibold";
},
.statsbutton {background-color: #f44336; font-size: 16px;}
</style>
</head>

<body>
<div class="All">
  <div class="main">
    <div align="center">
      <h1><br />
      Welcome back <?php echo $user?></h1>
      <p>&nbsp;</p>
    </div>
  </div>
  <div class="main">
    <hr />
  </div>
  <div class="main">
    <h3>User Stats</h3>
  </div>
  <div class="MainNoPad">
    <div class="quarter">
      <div align="center">
        <p>Today</p>
        <h1><?php echo $today?></h1>
      </div>
    </div>
    <div class="quarter">
      <div align="center">
        <p>Week</p>
        <h1><?php echo $thisweek ?></h1>
      </div>
    </div>
    <div class="quarter">
      <div align="center">
        <p>Month</p>
        <h1><?php echo $thismonth ?></h1>
      </div>
    </div>
    <div class="quarter">
      <div align="center">
        <p>All</p>
        <h1><?php echo $allusers; ?></h1>
      </div>
    </div>
  </div>
  <div class="main">
    <p align="center">Download User Email Addresses 
      <br />
      <input type="button" name="button5" id="csv" value="Download CVS" />
    </p>
    <hr />
  </div>
  <div class="mainhalf">
    <h3>Look Up User</h3>
    <p>Email Address: 
      <input type="text" name="email" id="email" />
      <input type="button" name="button" id="emaillookup" value="Search" />
    </p>
  </div>
  <div class="mainhalfright">
    <p>&nbsp;</p>
    <p>Username: 
      <input type="text" name="textfield2" id="vpnuser" />
    </p>
    <p>Password: 
      <input type="text" name="textfield11" id="vpnpass" />
    </p>
  </div>
  <div class="main">
    <hr />
    <p>Credits  </p>
  </div>
  <div class="mainhalf">
    <p align="center">Buy Credits: 
      <select name="select3" id="select">
        <option value='50'>50 Credits @ £1.50/credit</option>
        <option value='100'>100 Credits @ £1.25/credit</option>
        <option value='500'>500 Credits @ £1.00/credit</option>
        <option value='1000'>1000 Credits @ £0.80/credit</option>
      </select>
    </p>
      <div align="center">
        <input type="button" name="button6" id="buycredits" value="Buy Now" />
      </div>
    <div align="center" id="forma2" style='background-color:white'>
      <form action="https://www.ammakeup.co.uk/Plans/purchasecredits.php" method="POST" id="kesa">
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_live_sl2CtqWyBLXj3ePFq9f0Rfdw"
        data-amount="Checkout"
        data-name="VPN Credits"
        data-description="Buy VPN credits"
        data-image="http://www.lodi.mobi/wp-content/uploads/2016/02/new512.png"
        data-locale="auto"
        data-currency="gbp">
        </script>
        <input type="hidden"  id='amount' name="amount" value="">
        <input type="hidden"  name="username" value="<?php echo $user ?>">
      </form>
    </div>      
    <p align="center">Credits are automatically added to your total on purchase.</p>
  </div>
  <div class="mainhalfright">
    <p align="center">Credits Remaining</p>
    <h1 align="center"><?php echo $credits; ?></h1>
  </div>
  <div class="main">
    <hr />
    <h3>Update your off store app</h3>
    <p>APK Download URL: 
      <input type="text" name="textfield3" id="url" />
      <input type="button" name="button2" id="push" value="Push Update" />
      <input type="button" name="button3" id="cancel" value="Stop Update" />
    </p>
    <p>If there is a problem with your update please press the Stop Update button. </p>
  </div>
  <div class="main">
    <hr />
  </div>
  <div class="main">
    <form id="form1" name="form1" method="post" action="">
      <div align="center"><a href="https://www.avstream.tv">www.avstream.tv
        </a>
        <hr />
      </div>
    </form>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="modal1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close1" class='close'>&times;</span>
      <h3 id='naslov'></h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' id='contentover'>
        </div>
        <input type='hidden' id='number' value=''>                 
      </fieldset>
    </div>
    <div class="modal-footer">
      <input type="button" name="statsbutton" id="statsbutton" value="OK" />
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
$('#forma2').hide();
var modal1 = document.getElementById('modal1');
var span1 = document.getElementById("close1");
span1.onclick = function() {
    modal1.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}


$("#buycredits").click(function() {
    $('#amount').val($( "#select option:selected" ).val());
    $('.stripe-button-el').trigger("click");  
});

$("#csv").click(function()
{
  $.post( '<?php echo base_url(); ?>vpn/csv',function(data2)
  {
    //console.log(data2);
    var csvContent = "data:text/csv;charset=utf-8,";
    
    csvContent += "Username,Password,Email,Created At" + "\n";
    var data  = JSON.parse(data2);
    console.log(data2);

    data.forEach(function(infoArray, index)
    {
      dataString = infoArray.join(",");
      csvContent += index < data.length ? dataString+ "\n" : dataString;
    }); 
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "my_data.csv");
    document.body.appendChild(link); // Required for FF
    link.click();
  });
});  

  $('#emaillookup').on('click',function() {
      var formData = new FormData();
      formData.append('user',$('#email').val());
      var modal = document.getElementById('modal1');
      $.ajax({
          url: '<?php echo base_url(); ?>vpn/lookupuser',
          method: "post",
          dataType: 'json',
          data: formData,
          contentType: false,       
          cache: false,             
          processData:false,          
          success: function(result){
            $('#contentover').empty();
            if (result.status==1) {
              var length= 0;
              for(var key in result.users) {
                if(result.users.hasOwnProperty(key)){
                  length++;
                }
              }
              for(i=0;i<length;i++){
                html = '';
                html += '<input type="radio" name="user" id="user' + i + '" value=';
                html += '"' + result.users[i]['customerId'] + '"';
                html += '">' + 'Created at ' + result.users[i]['created_date'] + ' with Email ' + result.users[i]['email'] + ', and Customer id ' + result.users[i]['customerId'] + '<br>';
                $('#contentover').prepend(html);
              }
              $('#number').val(length);
              $('#naslov').html('Pick one user');                            
              modal.style.display = 'block';
            }
            else {
                $('#naslov').html('Error'); 
                $('#contentover').prepend(result.error);
                modal.style.display = 'block';              
            }
          }
      });   
  });

$('#statsbutton').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  $.ajax({
      url: '<?php echo base_url(); ?>vpn/userdetails', 
      method: "post",
      dataType: 'json',
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        modal1.style.display = "none";
        console.log(result);      

        $('#vpnuser').val(result[0].username);
        $('#vpnpass').val(result[0].password);             
      }
  });
});  

  $('#cancel').on('click',function() {
      $.ajax({
          url: '<?php echo base_url(); ?>vpn/cancelupdate', 
          type: "POST",            
          contentType: false,       
          cache: false,             
          processData:false,                             
          success: function(data)   
          {
            alert(data);             
          }
      });          
  });
  $('#push').on('click',function() {
      var formData = new FormData();
      formData.append('url',$('#url').val());
      $.ajax({
          url: '<?php echo base_url(); ?>vpn/pushupdate', 
          type: "POST",            
          data: formData,
          contentType: false,       
          cache: false,             
          processData:false,                             
          success: function(data)   
          {
            alert(data);             
          }
      });          
  });


});
</script>
</html>




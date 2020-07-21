<?php
$servername = "";
$username = "";
$password = "";
$dbname ="";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$url = 'http://i9i.xyz'. '/';

if(isset($_GET['slug'])){
$slug = $_GET['slug'];
$sql = "SELECT longurl FROM shorturl WHERE shorturl='".$slug."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      header("location: ".$row['longurl']);
  }
} else {
  echo'<script>
window.location="https://i9i.xyz/404";
</script>';
}
$conn->close();
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Archivo Narrow' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Fredoka One' rel='stylesheet'>
    <link href='css/main-css.css' rel='stylesheet'>
    <title>i9i.xyz</title>
    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LeSqKsZAAAAAEJSyZAePgLG7WYJ8fvffbvdM_vs'
        });
      };
    </script>
    <style type="text/css">
      body{
         background-color:#000;
         font-family: 'Archivo Narrow';font-size: 22px;
         color: white;
      }
    </style>
  </head>
  <body>
  
 <div class="top-nav">
  <center><h1 class="logo-text" >i9i.xyz</h1></center>
 <br>
 <br>
 <!--mainBox-->
 <div class="container">
 <div class="row">
    <div class="col-sm">
      
    </div>
    <div class="col-sm">
  <!---<form action="?" method="POST">
      <div id="html_element"></div>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
    </form>---->
 <div class="form-group">
    <label style="color:#ff0077 ; font-family:Fredoka One; " for="exampleInputEmail1"><h3>URL</h3></label>
    <input style="background-color:#36363b; color:#ff0077 ;" type="url" class="form-control" id="url" aria-describedby="urlHelp" placeholder="Enter URL" Required>
  </div>
  <button style="border-radius:15px; width:100%; background-color:#ff0077 ; color:#000; font-family: 'Fredoka One';" onclick="get_data()">Shorten</button>
  <div id="heading"></div>
  <div id="shorturly"></div>
  <br>
   <div id="load"></div>
  <center><div style="margin-top:5px; " id="copybutton"></div></center>
  <script>
                function copyDivToClipboard() {
                    var range = document.createRange();
                    range.selectNode(document.getElementById("shorturl"));
                    window.getSelection().removeAllRanges(); // clear current selection
                    window.getSelection().addRange(range); // to select text
                    document.execCommand("copy");
                    window.getSelection().removeAllRanges();// to deselect
                    document.getElementById("copybutton").innerHTML =  "<button onclick='copyDivToClipboard()' style=' font-size:20px;border:2px solid #ff0077; height:30px; background-color:#ff0077; color:#000; border-radius:15px;'><b>Copied!</b></button>";
                }
            
  </script>
  <script>
    function get_data(){
    document.getElementById("load").innerHTML='<center><div class="loader"></div></center>';
    var defaulturl="dextor.php?mod=1&longurl=";
    var long = document.getElementById("url").value;
    var longurl= defaulturl+long;
    fetch(longurl).then(res => res.json()).then(data => {
    document.getElementById("heading").innerHTML = '<label style="margin-top:20px;color:#ff0077 ; font-family:Fredoka One; " for="exampleInputEmail1"><h5>Short URL</h5></label>';
    document.getElementById("shorturly").innerHTML = '<div style="padding:4px 4px; border-radius:15px; background-color:#36363b; color:#ff0077;width:100%;" id="shorturl">'+"https://i9i.xyz/"+data.message+'</div>';
   document.getElementById("copybutton").innerHTML =  "<button onclick='copyDivToClipboard()' style='margin-top:5px; font-size:15px;border:2px solid #ff0077; height:35px; background-color:#36363b; color:#ff0077; border-radius:15px;'>Copy</button>";
   document.getElementById("load").innerHTML='';
    });
      }
  </script>
    </div>
    <div class="col-sm">
      
    </div>
  </div>
  </div>
  <!--mainBox-->
 
 <br>
 </div>
 
<div style="position: fixed;
    bottom: 0;
    width: 100%; background-color: #272b30;">    
 <br>
<center></center>
<center>
<a style="color: #fff;" href="https://i9i.xyz/">
   <h5 style="font-family: Fredoka One ;"><a style="color: #fff;" href="https://i9i.xyz/">i9i.xyz</h5></a>
</center>
<center><p style="font-size: 14px; color: #006eff;">Ver 0.0.1</p></center>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$servername = "";
$username = "";
$password = "";
$dbname="";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//Getting Client IP 
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
//Checking Request ,if for a short url or not
if(isset($_GET['mod'])){
$url=$_GET['longurl'];
$sql="SELECT id FROM shorturl ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$new=$row['id'];
$sql = "SELECT longurl,shorturl FROM shorturl WHERE longurl='".$url."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows  <1) {

    $yint=rand(1000,10000000);
    $yint=$yint+$new;
    $shorturl= base_convert($yint, 10, 36);
    $sql = "INSERT INTO shorturl (longurl, shorturl, ip) VALUES ('".$url."', '".$shorturl."', '".get_client_ip() ."')";

if ($conn->query($sql) === TRUE) {
    $data = [
    "message" => $shorturl
  ];
  echo json_encode($data);
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

} else {
    
$data = [
    "message" => $row['shorturl']
  ];
  echo json_encode($data);
  
}


$conn->close();
}

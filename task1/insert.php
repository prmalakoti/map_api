<?php


/* $location = $_POST['location'];
$postal_code = $_POST['postal_code'];
$country = $_POST['country'];
$lat = $_POST['lat'];
$lon = $_POST['lon']; */
$month = $_POST['start'];
$u_time = $_POST['appt'];

$location = 'pune';
$postal_code = '466001';
$country = 'India';
$lat = '45.66'; 
$lon = '22.99';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "map";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "INSERT INTO map_data (id, location, postal_code, country, lat, lon, month, u_time) VALUES ('', '$location', '$postal_code', '$country', '$lat', '$lon', '$month', '$u_time')";

if (mysqli_query($conn, $sql)) {
?>
	<script type="text/javascript">; 
    	alert("Data inserted successfully !!!");
    	window.location= "index.php"; 
    </script>;
<?php
} 
else{ ?>

	<script type="text/javascript">; 
    	alert("Please try again..."); 
    	window.location= "index.php";
	</script>;

<?php
}

?>
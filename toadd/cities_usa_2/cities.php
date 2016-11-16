<?php
//Replace with your database credentials
$username = "root";
$password = "";
$hostname = "localhost"; 
 
//What the user is searching for
$query = 'Minneapolis';
 
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
echo "";
$selected = mysql_select_db("us_cities",$dbhandle) 
  or die("Could not select excel");
$query=mysql_real_escape_string($query);
 
 
//Query mysql database
$sql = "SELECT * FROM  `zips` WHERE  `city` LIKE  '%".$query."%'LIMIT 0 , 10";  
$result = mysql_query($sql);
 
//Create array of cities
$i=0;
$cities=array();
while ($row = mysql_fetch_array($result)) {
    $cities[$i]=$row{'city'}.", ".$row{'state'};
    $i++;
}
 
//Make sure they are unique
$out =array_unique($cities);
 
//The final array
var_dump($out);
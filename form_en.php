<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Form for coordinators</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
<body>
<div class="php">
    
<?php
@$data=$_POST['data'];
@$ar_date=$_POST['ar_date'];
@$de_date=$_POST['de_date'];
@$group=$_POST['group'];
@$type_of_visit=$_POST['type_of_visit'];
@$ar_flight=$_POST['ar_flight'];
@$ar_flight_time=$_POST['ar_flight_time'];
@$de_flight=$_POST['de_flight'];
@$de_flight_time=$_POST['de_flight_time'];
@$people=$_POST['people'];
@$boys=$_POST['boys'];
@$girls=$_POST['girls'];
@$teachers=$_POST['teachers'];
@$teachers_men=$_POST['teachers_men'];
@$teachers_women=$_POST['teachers_women'];
@$teachers_together=$_POST['teachers_together'];
@$teachers_tg=$_POST['teachers_tg'];
@$trips=$_POST['trips'];
@$prof=$_POST['prof'];
@$contact=$_POST['contact'];
@$con=$_POST['con'];
$con1="$contact: $con";
    
$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
  die("Connection failed: <br> " . $conn->connect_error);
}
//echo "Connected successfully <br>";

$data_sql = "CREATE DATABASE IF NOT EXISTS data";
if ($conn->query($data_sql)===TRUE){
  //  echo "Database created successfully <br>";
}
    else {
        echo "Error creating database: <br>" . $conn->error;
    }
    
$conn->close();
$conn = new mysqli("localhost", "root", "", "data");
 
$table_sql = "CREATE TABLE IF NOT EXISTS `data`.`coordinators` ( `ID` INT(100) UNSIGNED NOT NULL AUTO_INCREMENT , `Name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Arrival date` DATE NOT NULL , `Departure date` DATE NOT NULL , `School/Group` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Type of visit` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Arrival flight number` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Arrival flight time` TIME(6) NOT NULL , `Departure flight number` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Departure flight time` TIME(6) NOT NULL , `Number of people` INT(100) NOT NULL , `Number of boys` INT(100) NOT NULL , `Number of girls` INT(100) NOT NULL , `Number of caregivers/teachers` INT(100) NOT NULL , `Caregivers/teachers - men` INT(100) NOT NULL , `Caregivers/teachers - women` INT(100) NOT NULL , `Caregivers/teachers together in room` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Trips` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Directions - number of people for each course` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Contact` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`ID`))";

if ($conn->query($table_sql)===TRUE){
    //echo "Table creted <br>";
}
    else {
        echo "Error creating table: <br>" . $conn->error;
    }
    
$sql = "INSERT INTO coordinators (`Name`, `Arrival date`, `Departure date`, `School/Group`, `Type of visit`, `Arrival flight number`, `Arrival flight time`, `Departure flight number`, `Departure flight time`, `Number of people`, `Number of boys`, `Number of girls`, `Number of caregivers/teachers`, `Caregivers/teachers - men`, `Caregivers/teachers - women`, `Caregivers/teachers together in room`, `Trips`, `Directions - number of people for each course`, `Contact`) VALUES ('$data','$ar_date','$de_date','$group','$type_of_visit','$ar_flight','$ar_flight_time','$de_flight','$de_flight_time','$people','$boys','$girls','$teachers','$teachers_men','$teachers_women','$teachers_tg','$trips','$prof', '$con1')";
    
if ($conn->query($sql) === TRUE) {
  echo "Application has been sending to the base. Thank you!";
} 
    else {
        echo "Error saving records" . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
</div>
</body>
</html>
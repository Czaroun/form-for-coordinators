<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formularz dla koorydynatorów</title>
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
  die("Połączenie nie zostało nawiązane: <br> " . $conn->connect_error);
}
// echo "Połączenie poprawne <br>";

$data_sql = "CREATE DATABASE IF NOT EXISTS data";
if ($conn->query($data_sql)===TRUE){
    //echo "Baza danych została utworzona pomyślnie <br>";
}
else {
    echo "Błąd przy tworzeniu bazy danych: <br>" . $conn->error;
    }
$conn->close();
$conn = new mysqli("localhost", "root", "", "data");

$table_sql = "CREATE TABLE IF NOT EXISTS `data`.`koordynatorzy` ( `ID` INT(100) UNSIGNED NOT NULL AUTO_INCREMENT , `Imie i nazwisko` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Data przyjazdu` DATE NOT NULL , `Data wyjazdu` DATE NOT NULL , `Szkoła/grupa` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Rodzaj pobytu` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Numer lotu przyjazdowego` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Godzina lotu przyjazdowego` TIME(6) NOT NULL , `Numer lotu wyjazdowego` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Godzina lotu wyjazdowego` TIME(6) NOT NULL , `Liczba osób` INT(100) NOT NULL , `Liczba chłopców` INT(100) NOT NULL , `Liczba dziewczyn` INT(100) NOT NULL , `Liczba nauczycieli/opiekunów` INT(100) NOT NULL , `Nauczyciele/opiekunowie - mężczyźni` INT(100) NOT NULL , `Nauczyciele/opiekunowie - kobiety` INT(100) NOT NULL , `Nauczyciele/opiekunowie - razem w pokojach` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Wycieczki` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Kierunki - liczba osób na poszczególne kierunki` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `Kontakt` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`ID`))";

if ($conn->query($table_sql)===TRUE){
    //echo "Tabela utworzona pomyślnie <br>";
}
    else{
        echo "Błąd przy tworzeniu tabeli: <br>" . $conn->error;
    }
 
$sql = "INSERT INTO koordynatorzy (`Imie i nazwisko`, `Data przyjazdu`, `Data wyjazdu`, `Szkoła/grupa`, `Rodzaj pobytu`, `Numer lotu przyjazdowego`, `Godzina lotu przyjazdowego`, `Numer lotu wyjazdowego`, `Godzina lotu wyjazdowego`, `Liczba osób`, `Liczba chłopców`, `Liczba dziewczyn`, `Liczba nauczycieli/opiekunów`, `Nauczyciele/opiekunowie - mężczyźni`, `Nauczyciele/opiekunowie - kobiety`, `Nauczyciele/opiekunowie - razem w pokojach`, `Wycieczki`, `Kierunki - liczba osób na poszczególne kierunki`, `Kontakt`) VALUES ('$data','$ar_date','$de_date','$group','$type_of_visit','$ar_flight','$ar_flight_time','$de_flight','$de_flight_time','$people','$boys','$girls','$teachers','$teachers_men','$teachers_women','$teachers_tg','$trips','$prof', '$con1')";
    
if ($conn->query($sql) === TRUE) {
  echo "Wniosek został wysłany do bazu. Dziękujemy!";
} else {
  echo "Błąd przy zapisywaniu rekordów: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</div>
</body>
</html>
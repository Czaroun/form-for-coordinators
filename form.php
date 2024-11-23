<!DOCTYPE html>
<html lang="pl">
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
    function sanitizeInput($data) {
        return htmlspecialchars(stripcslashes(trim($data)));
    }
    $language = $_POST["language"] === "true"; // true - polish, false - english

    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $ar_date = sanitizeInput($_POST["ar_date"] ?? "");
    $de_date = sanitizeInput($_POST["de_date"] ?? "");
    $group = sanitizeInput($_POST["group"] ?? "");
    $type_of_visit = sanitizeInput($_POST["type_of_visit"] ?? "");
    $ar_flight = sanitizeInput($_POST["ar_flight"] ?? "");
    $ar_flight_time = sanitizeInput($_POST["ar_flight_time"] ?? "");
    $de_flight = sanitizeInput($_POST["de_flight"] ?? "");
    $de_flight_time = sanitizeInput($_POST["de_flight_time"] ?? "");
    $people = (int)($_POST["people"] ?? 0);
    $boys = (int)($_POST["boys"] ?? 0);
    $girls = (int)($_POST["girls"] ?? 0);
    $teachers = (int)($_POST["teachers"] ?? 0);
    $teachers_men = (int)$_POST["teachers_men"] ?? 0;
    $teachers_women = (int)$_POST["teachers_women"] ?? 0;
    $teachers_together = $_POST["teachers_together"];
    $trips = sanitizeInput($_POST["trips"] ?? "");
    $prof = sanitizeInput($_POST["prof"] ?? "");
    $contact = sanitizeInput($_POST["contact"] ?? "");
    $con = sanitizeInput($_POST["con"] ?? "");

    if ($teachers_together == "Tak" || $teachers_men == "Yes") {
        $teachers_tg = sanitizeInput($_POST["teachers_tg"] ?? "");
    }
    else {
        $teachers_tg = null;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            $errorMessage = $language ? "Połączenie nie zostało nawiązane: " : "Connection failed: ";
            throw new Exception($errorMessage . $conn->connect_error);
        }

        $base_sql = "CREATE DATABASE IF NOT EXISTS coordinators";
        if (!$conn->query($base_sql)) {
            $errorMessage = $language ? "Błąd przy tworzeniu bazy danych: " : "Error creating database: ";
            throw new Exception($errorMessage . $conn->connect_error);
        }
        $conn->close();
        $conn = new mysqli($servername, $username, $password, "coordinators");

        $table_sql = "CREATE TABLE IF NOT EXISTS coordinators (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            arrival_date DATE NOT NULL,
            departure_date DATE NOT NULL,
            group_name VARCHAR(100) NOT NULL,
            visit_type VARCHAR(100) NOT NULL,
            arrival_flight VARCHAR(100) NOT NULL,
            arrival_flight_time TIME NOT NULL,
            departure_flight VARCHAR(100) NOT NULL,
            departure_flight_time TIME NOT NULL,
            total_people INT NOT NULL,
            boys_count INT NOT NULL,
            girls_count INT NOT NULL,
            teachers_count INT NOT NULL,
            male_teachers INT NOT NULL,
            female_teachers INT NOT NULL,
            shared_rooms VARCHAR(100),
            trips TEXT NOT NULL,
            directions TEXT NOT NULL,
            contact_info VARCHAR(100) NOT NULL,
            contact_value VARCHAR(100) NOT NULL
        )";

        if (!$conn->query($table_sql)) {
            $errorMessage = $language ? "Błąd przy tworzeniu tabeli: " : "Error creating table: ";
            throw new Exception($errorMessage . $conn->connect_error);
        }

        $insertQuery = "INSERT INTO coordinators
                        (first_name, last_name, arrival_date, departure_date, group_name, visit_type, arrival_flight, 
                         arrival_flight_time, departure_flight, departure_flight_time, total_people, boys_count, 
                         girls_count, teachers_count, male_teachers, female_teachers, shared_rooms, trips, directions, contact_info, contact_value) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param(
            "ssssssssssiiiiiisssss",
            $first_name, $last_name, $ar_date, $de_date, $group, $type_of_visit,
            $ar_flight, $ar_flight_time, $de_flight, $de_flight_time,
            $people, $boys, $girls, $teachers, $teachers_men,
            $teachers_women, $teachers_tg, $trips, $prof, $contact, $con
        );

        if ($stmt->execute()) {
            $successMessage = $language ? "Wniosek został wysłany do bazy. Dziękujemy!" : "Application has been sending to the base. Thank you!";
            echo $successMessage;
        } else {
            $errorMessage = $language ? "Błąd przy zapisywaniu rekordów do bazy: " : "Error saving records to database: ";
            throw new Exception($errorMessage . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }
    catch (Exception $e) {
        $errorMessage = $language ? "Błąd: " : "Error: ";
        echo $errorMessage . $e->getMessage();
    }
    ?>
</div>
</body>
</html>
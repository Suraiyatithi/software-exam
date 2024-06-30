<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Appointments</title>
    <style>
        body {
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 2px solid gray;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 200px;
        }
        .search-container input[type="submit"] {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Show All Appointments</h1>
    <div class="search-container">
        <form action="showall.php" method="GET">
            <label for="doctor_name">Search by Doctor Name:</label>
            <input type="text" id="doctor_name" name="doctor_name" placeholder="Enter Doctor's Name">
            <input type="submit" value="Search">
        </form>
    </div>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "hospital-system");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve data from database
    $query = "SELECT * FROM appointments";
    if (isset($_GET['doctor_name']) && !empty($_GET['doctor_name'])) {
        $doctor_name = mysqli_real_escape_string($connection, $_GET['doctor_name']);
        $query .= " WHERE doctor_name LIKE '%$doctor_name%'";
    }
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
            <th>Patient Name</th>
            <th>Patient ID</th>
            <th>Appointment Time</th>
            <th>Phone</th>
            <th>Doctor Name</th>
        </tr>";
        // Output data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row["patient_name"] . "</td>
                <td>" . $row["patient_id"] . "</td>
                <td>" . $row["appointment_time"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["doctor_name"] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No appointments found</p>";
    }
    mysqli_close($connection);
    ?>
</body>
</html>

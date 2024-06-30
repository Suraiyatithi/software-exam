<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <style>
        body {
            padding: 40px;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        label {
            display: block;
        }
        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        select {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Add Appointment</h1>
    <?php
    // database connection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "", "hospital-system");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // retrieve form data
        $patient_name = mysqli_real_escape_string($connection, $_POST['patient_name']);
        $appointment_time = mysqli_real_escape_string($connection, $_POST['appointment_time']);
        $patient_id = mysqli_real_escape_string($connection, $_POST['patient_id']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $doctor_name = mysqli_real_escape_string($connection, $_POST['doctor_name']);
        
        // insert into database
        $sql = "INSERT INTO appointments (patient_name, appointment_time, patient_id, phone, doctor_name)
                VALUES ('$patient_name', '$appointment_time', '$patient_id', '$phone', '$doctor_name')";
        
        if (mysqli_query($connection, $sql)) {
            echo "<p>Appointment added successfully</p>";
        } else {
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }
        mysqli_close($connection);
    }
    ?>
    <form action="appointment.php" method="POST">
        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" required>

        <label for="appointment_time">Appointment Time:</label>
        <input type="datetime-local" id="appointment_time" name="appointment_time" required>

        <label for="patient_id">Patient ID:</label>
        <input type="number" id="patient_id" name="patient_id" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="doctor_name">Doctor Name:</label>
        <select id="doctor_name" name="doctor_name" required>
            <option value="">Select Doctor</option>
            <option value="Dr. Smith">Dr. Smith</option>
            <option value="Dr. Johnson">Dr. Johnson</option>
            <option value="Dr. Williams">Dr. Williams</option>
            <!-- Add more doctors as needed -->
        </select>

        <input type="submit" value="Add Appointment">
    </form>
</body>
</html>

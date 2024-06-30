<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
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
        input[type="date"],
        select {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Take Attendance</h1>
    <?php
    // Database connection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "", "attendance-system");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve form data
        $teacher = mysqli_real_escape_string($connection, $_POST['teacher']);
        $class = mysqli_real_escape_string($connection, $_POST['class']);
        $session = mysqli_real_escape_string($connection, $_POST['session']);
        $semester = mysqli_real_escape_string($connection, $_POST['semester']);
        $section = mysqli_real_escape_string($connection, $_POST['section']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $students = [];
        for ($i = 1; $i <= 5; $i++) {
            $students[$i] = isset($_POST['student' . $i]) ? 1 : 0; // 1 for present, 0 for absent
        }

        // Insert into database
        foreach ($students as $id => $status) {
            $sql = "INSERT INTO student (teacher, class, session, semester, section, date, student_id, status)
                    VALUES ('$teacher', '$class', '$session', '$semester', '$section', '$date', '$id', '$status')";
            if (!mysqli_query($connection, $sql)) {
                echo "<p>Error: " . mysqli_error($connection) . "</p>";
            }
        }
        echo "<p>Attendance recorded successfully</p>";
        mysqli_close($connection);
    }
    ?>
    <form action="add-attendance.php" method="POST">
        <label for="teacher">Teacher Name:</label>
        <select id="teacher" name="teacher" required>
            <option value="">Select a teacher</option>
            <option value="Teacher 1">Teacher 1</option>
            <option value="Teacher 2">Teacher 2</option>
        </select>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" required>

        <label for="session">Session:</label>
        <input type="text" id="session" name="session" required>

        <label for="semester">Semester:</label>
        <input type="number" id="semester" name="semester" required>

        <label for="section">Section:</label>
        <input type="text" id="section" name="section" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <h2>Student Attendance</h2>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="student<?php echo $i; ?>">
                <input type="checkbox" id="student<?php echo $i; ?>" name="student<?php echo $i; ?>">
                Student ID <?php echo $i; ?>
            </label>
        <?php endfor; ?>

        <input type="submit" value="Record Attendance">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Attendance Records</title>
    <style>
        body {
            padding: 40px;
        padding-left:100px
        }
        h1 {
            text-align: center;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>All Attendance Records</h1>
    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "attendance-system");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch attendance records from database
    $sql = "SELECT * FROM student ORDER BY teacher, class, session, semester, section, date, student_id";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $current_group = null;

        while ($row = mysqli_fetch_assoc($result)) {
            $group = $row['teacher'] . $row['class'] . $row['session'] . $row['semester'] . $row['section'] . $row['date'];

            if ($current_group !== $group) {
                if ($current_group !== null) {
                    echo '</table>'; // Close previous table if not the first group
                }

                // Display group information
                echo '<h2>Teacher: ' . $row['teacher'] . '</h2>';
                echo '<p>Class: ' . $row['class'] . '</p>';
                echo '<p>Session: ' . $row['session'] . '</p>';
                echo '<p>Semester: ' . $row['semester'] . '</p>';
                echo '<p>Section: ' . $row['section'] . '</p>';
                echo '<p>Date: ' . $row['date'] . '</p>';

                // Start a new table for the current group
                echo '<table>';
                echo '<tr><th>Student ID</th><th>Status</th></tr>';

                $current_group = $group;
            }

            echo '<tr>';
            echo '<td>' . $row['student_id'] . '</td>';
            echo '<td>' . ($row['status'] ? 'Present' : 'Absent') . '</td>';
            echo '</tr>';
        }

        echo '</table>'; // Close the last table
    } else {
        echo "<p>No attendance records found</p>";
    }

    mysqli_close($connection);
    ?>
</body>
</html>

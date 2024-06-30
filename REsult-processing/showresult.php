<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show all students</title>
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
    </style>
</head>
<body>
    <h1>Show The CGPA of all the students</h1>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "result-process");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Retrieve data from database
    $query = "SELECT * FROM student";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
                <th>Name</th>
                <th>Roll</th>
                <th>Semester</th>
                <th>CGPA</th>
              </tr>";
        
        // Output data
        while ($row = mysqli_fetch_assoc($result)) {
            $grades = array($row["physics"], $row["software"], $row["networking"], $row["toc"], $row["embedded"]);
            $totalGradePoints = 0;
            
            foreach ($grades as $grade) {
                if ($grade >= 90) {
                    $gradePoint = 4.0;
                } elseif ($grade >= 80) {
                    $gradePoint = 3.0;
                } elseif ($grade >= 70) {
                    $gradePoint = 2.0;
                } elseif ($grade >= 60) {
                    $gradePoint = 1.0;
                } else {
                    $gradePoint = 0.0;
                }
                $totalGradePoints += $gradePoint;
            }
            
            $cgpa = $totalGradePoints / count($grades);
            echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["roll"] . "</td>
                    <td>" . $row["semester"] . "</td>
                    <td>" . number_format($cgpa, 2) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No student found</p>";
    }
    
    mysqli_close($connection);
    ?>
</body>
</html>


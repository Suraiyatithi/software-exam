<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Projects</title>
    <style>
        body {
            padding: 40px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
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
        .status-not-yet {
            background-color: red;
            color: white;
        }
        .status-in-process {
            background-color: yellow;
        }
        .status-complete {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>
    <h1>All Projects</h1>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "project_management");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM project";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Project Name</th><th>Module</th><th>Developer</th><th>Task</th><th>Status</th><th>Comment</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['project_name'] . '</td>';
            echo '<td>' . $row['module'] . '</td>';
            echo '<td>' . $row['developer'] . '</td>';
            echo '<td>' . $row['task'] . '</td>';
            echo '<td class="status-' . strtolower(str_replace(' ', '-', $row['status'])) . '">' . $row['status'] . '</td>';
            echo '<td>' . $row['comment'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "<p>No projects found</p>";
    }

    mysqli_close($connection);
    ?>
</body>
</html>

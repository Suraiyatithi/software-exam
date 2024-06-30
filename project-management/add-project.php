<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
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
        select,
        textarea {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Add a Project</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "", "project_management");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $project_name = mysqli_real_escape_string($connection, $_POST['project_name']);
        $module = mysqli_real_escape_string($connection, $_POST['module']);
        $developer = mysqli_real_escape_string($connection, $_POST['developer']);
        $task = mysqli_real_escape_string($connection, $_POST['task']);
        $status = mysqli_real_escape_string($connection, $_POST['status']);
        $comment = mysqli_real_escape_string($connection, $_POST['comment']);

        $sql = "INSERT INTO project (project_name, module, developer, task, status, comment)
                VALUES ('$project_name', '$module', '$developer', '$task', '$status', '$comment')";

        if (mysqli_query($connection, $sql)) {
            echo "<p>Project added successfully</p>";
        } else {
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }

        mysqli_close($connection);
    }
    ?>
    <form action="add-project.php" method="POST">
        <label for="project_name">Project Name:</label>
        <input type="text" id="project_name" name="project_name" required>

        <label for="module">Module:</label>
        <input type="text" id="module" name="module" required>

        <label for="developer">Developer:</label>
        <select id="developer" name="developer" required>
            <option value="">Select a developer</option>
            <option value="Developer 1">Developer 1</option>
            <option value="Developer 2">Developer 2</option>
            <!-- Add more developers as needed -->
        </select>

        <label for="task">Task:</label>
        <input type="text" id="task" name="task" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Not Yet">Not Yet</option>
            <option value="In Process">In Process</option>
            <option value="Complete">Complete</option>
        </select>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment"></textarea>

        <input type="submit" value="Add Project">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        textarea {
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
    <h1>Add a Product</h1>
    <?php
    // Database connection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "", "e-commarce");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve form data
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $category = mysqli_real_escape_string($connection, $_POST['category']);
        $price = mysqli_real_escape_string($connection, $_POST['price']);
        $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);

        // Insert into database
        $sql = "INSERT INTO product (name, category, price, quantity, description)
                VALUES ('$name', '$category', '$price', '$quantity', '$description')";
        if (mysqli_query($connection, $sql)) {
            echo "<p>Product added successfully</p>";
        } else {
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }
        mysqli_close($connection);
    }
    ?>
    <form action="addproduct.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Products</title>
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
        .order-btn {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>All Products</h1>
    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "e-commarce");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch products from database
    $sql = "SELECT * FROM product";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Category</th><th>Price</th><th>Quantity</th><th>Description</th><th>Action</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['category'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td><button class="order-btn" >Order Now</button></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<p>No products found</p>";
    }

    mysqli_close($connection);
    ?>

</body>
</html>

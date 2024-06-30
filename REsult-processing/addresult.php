<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>add result</title>
        <style>
            body{
                padding:40px;
            }
            h1{
                text-align:center;
            }
            form{
                max-width:600px;
                margin:0 auto;
                padding:20px;
            }
            label{
                display:block;
              
            }
            input[type="text"],
            input[type="number"]
            {
                padding:10px;
                width:100%;
                margin-bottom:20px;
            }
            input[type="submit"]{
                padding:10px;
            }
        </style>
</head>
<body>
    <h1>Add A student Result</h1>
     <?php
    // database connection
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $connection=mysqli_connect("localhost","root","","result-process");
        if(!$connection){
            die("connection failed:".mysqli_connect_error());
        }
        // retrive from data
        $name=mysqli_real_escape_string($connection,$_POST['name']);
        $roll=mysqli_real_escape_string($connection,$_POST['roll']);
        $semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $physics=mysqli_real_escape_string($connection,$_POST['physics']);
        $software=mysqli_real_escape_string($connection,$_POST['software']);
        $networking=mysqli_real_escape_string($connection,$_POST['networking']);
        $toc=mysqli_real_escape_string($connection,$_POST['toc']);
        $embedded=mysqli_real_escape_string($connection,$_POST['embedded']);
        //insert into database
        $sql="INSERT INTO student(name,roll,semester,physics,software,networking,toc,embedded)
        VALUES('$name','$roll','$semester','$physics','$software','$networking','$toc','$embedded')";
        if(mysqli_query($connection,$sql)){
            echo" <p>STUDENT ADD SUCESSFULLY</p>";

        }
        else{
echo "<p>Error:'.mysqli_error($connection)'</p>"; }
        mysqli_close($connection);
    }
    ?>
    <form action="addresult.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="roll">Roll:</label>
        <input type="number" id="roll" name="roll" required>

        <label for="semester">Semester:</label>
        <input type="number" id="semester" name="semester" required>

        <label for="physics">physics:</label>
        <input type="number" id="physics" name="physics" required>

        <label for="software">Software:</label>
        <input type="number" id="software" name="software" required>

        <label for="networking">networking:</label>
        <input type="number" id="networking" name="networking" required>

        <label for="toc">Theory of Computution:</label>
        <input type="number" id="toc" name="toc" required>

        <label for="embedded">Embedded:</label>
        <input type="number" id="embedded" name="embedded" required>

        <input type="submit" value="Add Info">


    </form>
</body>
</html>
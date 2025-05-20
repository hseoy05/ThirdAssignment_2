<?php 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document</title>
</head>
<body>
    <div>
        <h2>Create Document</h2>
        <br>
        <?php
        $connection = new mysqli("db", "root","root","testdb");
        if($connection->connect_error) {
            die("DB connect Fail: " . $connection->connect_error);
        }   

        $sql = "SELECT * FROM users";
        $result = $connection->query($sql);

        echo "<p>Welcome, " . htmlspecialchars($_SESSION["userName"]) . "!</p>";
        ?>
        <br>
        <form method="post" action="saveDocument.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="document"></label><br>
            <textarea id="document" name="document" rows="10" cols="100" required></textarea><br><br>

            <input type="submit" value="Create Document">
        </form>
        <p></p>
        <a href="documentList.php">View Document List</a>
    </div>
</body>
</html>
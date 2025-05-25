<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Manage</h1>
    <?php
    $conn = new mysqli("db", "root", "root", "testdb");
    if ($conn->connect_error) {
    die("testDB connect Fail: ".$conn->connect_error);
    }

    $newId= $_POST['newId'] ?? '';
    $newPassword= $_POST['newPassword'] ?? '';
    $newName= $_POST['newName'] ?? '';

    if ($newId && $newPassword && $newName) {
        $sql = "INSERT INTO users (userId, userPassword, userName) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $newId, $newPassword, $newName);
        $stmt->execute();

        echo "Join Success!\n";
    }else{
        echo"Join failed";
    }
    $conn->close();
    ?>
    <a href="./loginPage1.html">Go to Login Page</a>
</body>
</html>
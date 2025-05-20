<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "testdb");
    if ($conn->connect_error) {
        die("DB connect Fail: " . $conn->connect_error);
    }

    $userId = $_POST['userId'] ?? '';
    $userPassword = $_POST['userPassword'] ?? '';

    if($userId && $userPassword) {
        $sql = "SELECT * FROM users WHERE userId = ? AND userPassword = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $userId, $userPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $userName = $row['userName'];
            echo "Login Success!\nHello, " . htmlspecialchars($userName)."!";
            echo "<br><br>";
            echo "<button type='button' 
            onclick=\"location.href='CreateDocument/createDocument.php'\">Write Document</button>";
            echo "<br><br>";
            echo "<button type='button'onclick=\"location.href='CreateDocument/documentList.php'\">Document List</button>";
        } else {
            echo "Failed to Login.";
        }
    }

    $conn -> close();
    ?>
</body>
</html>
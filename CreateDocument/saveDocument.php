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
    session_start();
    
    $title = $_POST['title'] ?? '';
    $document = $_POST['document'] ?? '';
    $todayDate = date("Y-m-d");
    $id = $_SESSION['userId'] ?? '';

    if ($title || $document) {
        $sql = "INSERT INTO createdocument (title, document, createDate, userId) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $document, $todayDate, $id);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    ?>
    <div>
        <h2>Save successful!</h2>
        <br><br>
        <button type="button" onclick="location.href='documentList.php'">View Document List</button>
        <button type="button" onclick="location.href='createDocument.php'">Create New Document</button>
    </div>
</body>
</html>
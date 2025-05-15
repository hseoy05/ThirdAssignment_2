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
    
    $title = $_POST['title'] ?? '';
    $document = $_POST['document'] ?? '';
    $todayDate = date("Y-m-d");

    if ($title || $content) {
        $sql = "INSERT INTO createdocument (title, document, createDate) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $document, $todayDate);
        $stmt->execute();
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
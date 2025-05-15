<?php
$conn = new mysqli("localhost", "root", "", "testdb");
if($conn ->connect_error) {
    die("DB connect Fail: " . $conn->connect_error);
}

$sql = "SELECT title, document, createDate FROM createdocument";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document List</title>
</head>
<body>
    <h1>Document List</h1>

    <?php
    $indexNum = 1;
    if($result ->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>$indexNum: [".htmlspecialchars($row['title'])."]</p>";
            echo "<p>".htmlspecialchars($row['document'])."</p>";
            echo "<p>작성일: ".htmlspecialchars($row['createDate'])."</p>";
            echo "<br><br>";
            $indexNum++;
        }
    }
    ?>
    <p></p>
    <button type="button" onclick="location.href='createDocument.php'">create Document</button>
</body>
</html>
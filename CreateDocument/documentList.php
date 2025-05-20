<?php
$conn = new mysqli("localhost", "root", "", "testdb");
if($conn ->connect_error) {
    die("DB connect Fail: " . $conn->connect_error);
}

$sql = "SELECT c.id, c.document, c.createDate, c.title, u.userId, u.userName
        FROM createdocument c 
        JOIN users u ON c.userId = u.userId";


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
            echo "<p>작성자: ".htmlspecialchars($row['userName'])."</p>";
            echo "<p></p>";
            echo "<form method ='post' action = 'deleteDocument.php'>";
            echo "<input type='hidden' name ='id' value = '".$row['id']."'>";
            echo "<button type ='submit'>삭제</button>";
            echo "</form>";
            echo "<a href='editDocument.php?id=" . urlencode($row['id']) . "'>";
            echo "<button>수정</button>";
            echo "</a>";
            echo "<br><br>";
            $indexNum++;
        }
    }
    ?>
    <p></p>
    <a href='createDocument.php'>create Document</a>
    <a href='../loginPage.html'>Logout</a>
</body>
</html>
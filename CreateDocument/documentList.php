<?php
header("Content-Type: text/html; charset=utf-8");
$conn = new mysqli("db", "root", "root", "testdb");
$conn->set_charset("utf8mb4");

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
    <link rel="stylesheet" href="../CssFiles/Preview.css">
    <title>Document List</title>
</head>
<body>
    <h1>Document List</h1>

    <?php
    $indexNum = 1;
    if($result ->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='list-card'>";
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
            echo"</div>";
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
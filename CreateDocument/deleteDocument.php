<?php
session_start();
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $documentId = intval($_POST['id']);
    $loginId = $_SESSION['userId'] ?? '';

    $ss = $conn->prepare("SELECT userId FROM createdocument WHERE id = ?");
    $ss->bind_param("s", $documentId);
    $ss->execute();
    $result = $ss->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $documentUserId = $row['userId'];

        if ($loginId === $documentUserId) {
            $stmt = $conn->prepare("DELETE FROM createdocument WHERE id = ?");
            $stmt->bind_param("s", $documentId);
            if ($stmt->execute()) {
                echo "<script>alert('Document deleted successfully.');</script>";
            } else {
                echo "<script>alert('Failed to delete document.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('You do not delete this document.');</script>";
        }
    } else {
        echo "<script>alert('Document not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href = "documentList.php">Document List</a>
    <br>
    <a href = "../loginPage.html">Logout</a>
    <br>
    <a href = "createDocument.php">Create Document</a>
</body>
</html>
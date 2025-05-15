<?php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM createdocument WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: documentList.php");
        exit;
    } else {
        echo "Fail: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
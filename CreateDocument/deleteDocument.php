<?php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $ss = $conn->prepare("DELETE FROM createdocument WHERE id = ?");
    $ss->bind_param("i", $id);

    if ($ss->execute()) {
        header("Location: documentList.php");
        exit;
    } else {
        echo "Fail: " . $ss->error;
    }

    $ss->close();
}

$conn->close();
<?php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM createdocument WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "삭제 성공!";
        header("Location: documentList.php");
        exit;
    } else {
        echo "삭제 실패: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "잘못된 접근입니다.";
}

$conn->close();
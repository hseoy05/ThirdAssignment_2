<?php
$conn = new mysqli("localhost", "root", "", "testdb");

$id = $_POST['id'];
$title = $_POST['title'];
$document = $_POST['document'];

$stmt = $conn->prepare("UPDATE createdocument SET title = ?, document = ? WHERE id = ?");
$stmt->bind_param("sss", $title, $document, $id);
$stmt->execute();

echo "Successfully edited the document!";
?>

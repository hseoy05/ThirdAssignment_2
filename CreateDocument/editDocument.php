<?php
session_start();
$conn = new mysqli("localhost","root","","testdb");

if($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}

if(isset($_GET["id"])) {
    $documentId = intval($_GET["id"]);
    $loginId = $_SESSION["userId"] ?? '';

    $ss = $conn->prepare("SELECT * FROM createdocument WHERE id = ?");
    $ss->bind_param("s", $documentId);
    $ss->execute();

    $result = $ss->get_result();
    if($result->num_rows === 1){
        $row = $result -> fetch_assoc();
        $documentUserId = $row["userId"];

        if($loginId === $documentUserId) {
            $isCorrext = true;
        } else {
            $isCorrext = false;
        }
    }

    if($isCorrext) {
        // Fetch the document details
        $stmt = $conn->prepare("SELECT * FROM createdocument WHERE id = ?");
        $stmt->bind_param("s", $documentId);
        $stmt->execute();
    }
}
?>
<h2>Edit document</h2>
<form method="post" action="editDocument2.php">
    <label for="title">Title:</label>
    <input type="text" id="title" value="<?= htmlspecialchars($doc['title']) ?>"><br><br>

    <label for="document"></label><br>
    <textarea id="document" name="document" rows="10" cols="100" required><?= htmlspecialchars($doc['document']) ?></textarea><br><br>

    <input type="submit" value="Edit Document">
</form>
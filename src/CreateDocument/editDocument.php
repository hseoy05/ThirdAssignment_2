<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$conn = new mysqli("db","root","root","testdb");

if($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}
$doc = null;
$isCorrect = false;

if(isset($_GET["id"])) {
    $documentId = $_GET["id"];
    $loginId = $_SESSION["userId"] ?? '';

    $ss = $conn->prepare("SELECT * FROM createdocument WHERE id = ?");
    $ss->bind_param("s", $documentId);
    $ss->execute();

    $result = $ss->get_result();

    if($result->num_rows >0){
        $doc = $result->fetch_assoc();
        $documentUserId = $doc["userId"];

        if($loginId == $documentUserId) {
            $isCorrect = true;
        }
    }
}
?>


<h2>Edit document</h2>
<?php if ($isCorrect): ?>
    <form method="post" action="editDocument2.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($doc['id']) ?>">

        <label for="title">Title:</label>
        <input type="text" id="title" name = "title" value="<?= htmlspecialchars($doc['title']) ?>" required><br><br>

        <label for="document">Content:</label><br>
        <textarea id="document" name="document" rows="10" cols="100" required><?= htmlspecialchars($doc['document']) ?></textarea><br><br>

        <input type="submit" value="Edit Document">
    </form>
<?php else: ?>
        <p>error!</p>
        <br>
        <p>권한이 없거나, 게시글이 없음</p>
<?php endif; ?>
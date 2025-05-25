<?php
session_start();
header("Content-Type: text/html; charset=utf-8");

    $conn = new mysqli("db", "root", "root", "testdb");
    $conn->set_charset("utf8mb4");
    if ($conn->connect_error) {
        die("DB connect Fail: " . $conn->connect_error);
    }

    $userId = $_POST['userId'];
    $userPassword = $_POST['userPassword'];

    if($userId && $userPassword) {
        $sql = "SELECT * FROM users WHERE userId = ? AND userPassword = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $userId, $userPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $userName = $row['userName'];
            $userId = $row['userId'];
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['userName'] = $row['userName'];

            echo "Login Success!\nHello, " . htmlspecialchars($userName)."!";
            echo "<br><br>";
            echo "<button type='button' 
            onclick=\"location.href='CreateDocument/createDocument.php'\">Write Document</button>";
            echo "<br><br>";
            echo "<button type='button'onclick=\"location.href='CreateDocument/documentList.php'\">Document List</button>";
        } else {
            echo "<script>
            console.log('로그인 실패: 아이디 또는 비밀번호가 틀렸습니다.');
            alert('로그인 실패: 다시 시도해주세요.');
            window.location.href = './loginPage1.html';
            </script>";
        }
    }

    $conn -> close();
?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// جلب الأسئلة
$query = "SELECT * FROM questions ORDER BY created_at DESC";
$result = $conn->query($query);

// الرد على سؤال
if (isset($_POST['reply'])) {
    $id = $_POST['id'];
    $reply = $_POST['reply_text'];
    $conn->query("UPDATE questions SET reply = '$reply' WHERE id = $id");
    header("Location: manage_questions.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الأسئلة</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xm0ZsBeGOoreNmGxKu0MuOyeXYHydLH-aw&s" />
<style>
        body {
    font-family: Arial, sans-serif;
    direction: rtl;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.content {
    margin: 80px auto;
    max-width: 90%;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

h2 {
    text-align: center;
    color: #3e0303;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #3e0303;
    color: white;
    font-size: 16px;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

.btn-danger {
    background-color: red;
    color: white;
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}

.btn-danger:hover {
    background-color: darkred;
}
</style>
</head>
<body>
    <h2>إدارة الأسئلة</h2>
    <table border="1">
        <tr>
            <th>السؤال</th>
            <th>الرد</th>
            <th>إجراءات</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['question'] ?></td>
                <td><?= $row['reply'] ?: "لم يتم الرد بعد" ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="reply_text" placeholder="اكتب الرد هنا">
                        <button type="submit" name="reply">إرسال الرد</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
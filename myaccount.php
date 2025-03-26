<?php
session_start();
require 'config.php'; // ملف الاتصال بقاعدة البيانات (Supabase)

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // إعادة التوجيه إلى تسجيل الدخول إذا لم يتم تسجيل الدخول
    exit();
}

// جلب معلومات المستخدم من Supabase
$user_id = $_SESSION['user_id'];

// استعلام لاسترداد معلومات المستخدم
$query = "SELECT name, email, created_at FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// التحقق من العثور على المستخدم
if (!$user) {
    echo "حدث خطأ أثناء جلب البيانات!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حسابي</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xm0ZsBeGOoreNmGxKu0MuOyeXYHydLH-aw&s" />

    <link rel="stylesheet" href="styles.css"> <!-- ربط ملف التنسيقات -->
    <style>
        body {
    font-family: Arial, sans-serif;
    direction: rtl;
    text-align: center;
    background-color: #f4f4f4;
}

.container {
    width: 50%;
    margin: auto;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px gray;
    border-radius: 10px;
    margin-top: 50px;
}

.account-info p {
    font-size: 18px;
    margin: 10px 0;
}

.logout-btn {
    display: inline-block;
    padding: 10px 20px;
    background: rgb(51, 0, 0);
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.logout-btn:hover {
    background: darkred;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>حسابي</h2>
        <div class="account-info">
            <p><strong>الاسم:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>البريد الإلكتروني:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>تاريخ التسجيل:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>
        <br>
        <a href="index.html" class="index-btn"> الرجوع الى الصفحة الرئيسية</a>
<br><br><br>
        <a href="logout.php" class="logout-btn">تسجيل الخروج</a>
    </div>
</body>
</html>
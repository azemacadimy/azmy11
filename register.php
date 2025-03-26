<?php
// تشغيل الجلسة
session_start();

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "supabase");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // تشفير كلمة المرور

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["username"] = $username; // تخزين اسم المستخدم في الجلسة
        header("Location: user1.php"); // التوجيه إلى صفحة المستخدم
        exit();
    } else {
        echo "خطأ: " . $conn->error;
    }
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
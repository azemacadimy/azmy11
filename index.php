<?php
session_start();
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";
exit();

// بيانات تسجيل الدخول الصحيحة
$admin_username = "admin"; 
$admin_password = "12345"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin.php"); 
        exit();
    } else {
        echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة!'); window.location.href='index.html';</script>";
        exit();
    }
}
?>
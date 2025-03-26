<?php
session_start();

// تحقق مما إذا كان المستخدم مسجلاً الدخول كأدمن
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: test.php"); // توجيه إلى صفحة تسجيل الدخول إذا لم يكن الأدمن مسجلاً
    exit();
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن - أكاديمي أهل العزم</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xm0ZsBeGOoreNmGxKu0MuOyeXYHydLH-aw&s" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            direction: rtl;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #3e0303;
            overflow: hidden;
            display: flex;
            justify-content: center;
            padding: 10px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
            transition: 0.3s;
        }

        .navbar a:hover {
            background-color: #580707;
        }

        .menu-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            background-color: #3e0303;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 20px;
            cursor: pointer;
            z-index: 1001;
        }

        .sidebar {
            width: 300px;
            height: 100%;
            background-color: #eee;
            position: fixed;
            top: 0;
            right: -300px;
            transition: right 0.3s ease;
            overflow-y: auto;
            box-shadow: -3px 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding-top: 20px;
        }

        .sidebar.open {
            right: 0;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            display: block;
            transition: background 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #ccc;
        }

        .section-title {
            background-color: #3e0303;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .content {
            margin: 100px auto;
            max-width: 90%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .logout-btn {
            background-color: #cca2a2;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
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

<!-- زر فتح القائمة -->
<button class="menu-btn" onclick="toggleSidebar()">☰ القائمة</button>

<!-- الشريط الجانبي -->
<div class="sidebar" id="sidebar">
    <button class="close-btn" onclick="toggleSidebar()">✖</button>
    <ul>
        <li class="section-title"> إدارة المحتوى </li>
        <li><a href="summaries.html">إدارة الملخصات</a></li>
        <li><a href="reviews.html">عرض التقييمات</a></li>
        <li><a href="qs.html">إدارة الأسئلة</a></li>
        <li><a href="visitors.html">إحصائيات الزوار</a></li>
        <li><a href="joinshow.html"> طلبات الاتضمام</a></li>

        
        <li class="section-title"> إعدادات </li>
        <li><a href="change_password.php">تغيير كلمة المرور</a></li>
        <li><a href="logout.php" class="logout-btn">تسجيل الخروج</a></li>
    </ul>
</div>

<!-- شريط الروابط -->
<div class="navbar">
    <a href="admin.html">الرئيسية</a>
    <a href="index.html">الملخصات</a>
    <a href="reviews.html">التقييمات</a>
    <a href="qs.html">الأسئلة</a>
    <a href="logout.php">خروج</a>
</div>

<!-- المحتوى الرئيسي -->
<div class="content">
    <h2>مرحبًا بك، أدمن!</h2>
    <p>اختر من القائمة لإدارة الموقع.</p>
</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("open");
    }

    document.addEventListener("click", (event) => {
        let sidebar = document.getElementById("sidebar");
        let menuBtn = document.querySelector(".menu-btn");

        if (!sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
            sidebar.classList.remove("open");
        }
    });

    let startX;
    document.getElementById("sidebar").addEventListener("touchstart", (e) => {
        startX = e.touches[0].clientX;
    });

    document.getElementById("sidebar").addEventListener("touchmove", (e) => {
        let diffX = e.touches[0].clientX - startX;
        if (diffX < -50) {
            document.getElementById("sidebar").classList.remove("open");
        }
    });
</script>

</body>
</html>
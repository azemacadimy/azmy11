<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// جلب عدد الزوار
$query = "SELECT COUNT(*) AS total_visitors FROM visitors";
$result = $conn->query($query);
$visitors = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إحصائيات الزوار</title>
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
    <h2>إحصائيات الزوار</h2>
    <p>إجمالي عدد الزوار: <?= $visitors['total_visitors'] ?></p>
</body>
</html>
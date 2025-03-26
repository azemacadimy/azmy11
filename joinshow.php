<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "your_database");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// جلب الطلبات من قاعدة البيانات
$sql = "SELECT * FROM join_requests ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبات الانضمام</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xm0ZsBeGOoreNmGxKu0MuOyeXYHydLH-aw&s" />

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>طلبات الانضمام</h2>
<table>
    <tr>
        <th>الاسم</th>
        <th>الكلية</th>
        <th>التخصص</th>
        <th>السنة الدراسية</th>
        <th>رقم الهاتف</th>
        <th>تاريخ الإرسال</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['college']}</td>
                    <td>{$row['major']}</td>
                    <td>{$row['study_year']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>لا توجد طلبات بعد</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
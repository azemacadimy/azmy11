<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الاتصال بقاعدة البيانات
    $conn = new mysqli("localhost", "root", "", "your_database");

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }

    // جلب البيانات من النموذج مع الحماية من SQL Injection
    $name = $conn->real_escape_string($_POST["name"]);
    $college = $conn->real_escape_string($_POST["college"]);
    $major = $conn->real_escape_string($_POST["major"]);
    $study_year = $conn->real_escape_string($_POST["study_year"]);
    $phone_number = $conn->real_escape_string($_POST["phone_number"]); // تعديل الاسم ليطابق input

    // إدخال البيانات إلى قاعدة البيانات
    $sql = "INSERT INTO join_requests (name, college, major, study_year, phone_number) 
            VALUES ('$name', '$college', '$major', '$study_year', '$phone_number')";
    
    if ($conn->query($sql) === TRUE) {
        echo "تم إرسال الطلب بنجاح!";
    } else {
        echo "خطأ: " . $sql . "<br>" . $conn->error;
    }

    // إغلاق الاتصال
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انضم لنا</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xm0ZsBeGOoreNmGxKu0MuOyeXYHydLH-aw&s" />

    <style>
          body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            direction: rtl;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 60%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
        }
        textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        textarea {
            resize: none;
            height: 80px;
        }
        button {
            background: #4b0101;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background: #040000;
        }
        .question-box, .summary-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>انضم لنا</h2>
    <form action="join.php" method="post">
        <label>الاسم:</label>
        <input type="text" name="name" required><br>

        <label>الكلية:</label>
        <input type="text" name="college" required><br>

        <label>التخصص:</label>
        <input type="text" name="major" required><br>

        <label>السنة الدراسية:</label>
        <input type="text" name="study_year" required><br>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone_number" required><br> <!-- تعديل الاسم ليطابق المتغير في PHP -->
        
        <button type="submit">إرسال</button>
    </form>
</body>
</html>
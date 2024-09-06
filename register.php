<?php
include('admin/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($password) || empty($re_password)) {
        echo "<script>
        alert('يرجى ملئ جميع الحقول');
        window.location.href='register.php';
        </script>";
        exit();
    }

    // Check if password and re-password match
    if ($password !== $re_password) {
        echo "<script>
        alert('كلمة السر غير متطابقة');
        window.location.href='register.php';
        </script>";
        exit();
    }

    // Add password length validation (optional)
    if (strlen($password) < 8) {
        echo "<script>
        alert('يجب أن تكون كلمة السر مكونة من 8 أحرف على الأقل');
        window.location.href='register.php';
        </script>";
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

    // Execute the statement and check if successful
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('تم التسجيل بنجاح');
                window.location.href='login.php';
            </script>";
    } else {
        echo "<script>
                alert('حدث خطأ ما: " . mysqli_error($conn) . "');
                window.location.href='register.php';
            </script>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="login-page.css">
    <!-- <script defer src="login-page.js"></script> -->
</head>

<body>
    <main id="main-holder">
        <h1 id="login-header">إنشاء حساب</h1>

        <form id="login-form" method="post" action="register.php">
            <input type="text" name="username" id="name-field" class="login-form-field" placeholder="اسم المستخدم">
            <input type="email" name="email" id="email-field" class="login-form-field" placeholder="البريد الالكترونى">
            <input type="password" name="password" id="password-field" class="login-form-field" placeholder="كلمة السر">
            <input type="password" name="re_password" id="re-password-field" class="login-form-field" placeholder="تأكيد كلمة السر">
            <input type="submit" value="إنشاء حساب" id="login-form-submit">
        </form>
        <div>
            <p>هل لديك حساب؟ <a href="login.php">تسجيل دخول</a></p>
        </div>
    </main>
</body>

</html>
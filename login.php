<?php
include('admin/config.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
        alert('البريد الالكترونى غير صحيح او كلمة السر');
        window.location.href='login.php';
        </script>";
        }
    } else {
        echo "<script>
        alert('البريد الالكترونى غير صحيح او كلمة السر');
        window.location.href='login.php';
        </script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="login-page.css">
</head>

<body>
    <main id="main-holder">
        <h1 id="login-header">تسجيل الدخول</h1>

        <form id="login-form" action="login.php" method="POST">
            <input type="email" name="email" id="email-field" class="login-form-field" placeholder="البريد الالكترونى" required>
            <input type="password" name="password" id="password-field" class="login-form-field" placeholder="كلمة السر" required>
            <input type="submit" value="تسجيل الدخول" id="login-form-submit">
        </form>

        <div>
            <p>هل تملك حساب بالفعل؟ <a href="register.php">إنشاء حساب </a></p>
        </div>

    </main>
</body>

</html>
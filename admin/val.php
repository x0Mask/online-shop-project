<?php
include('config.php');

$id = $_GET['id'];
$up = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$res = mysqli_fetch_array($up);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | المنتجات</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        h2 {
            text-align: center;
            font-weight: bold;
        }

        .main {
            width: 40%;
            padding: 50px 0;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
        }

        input {
            display: none;
        }
        .btn {
            margin: 30px 0;
        }

        a {
            text-decoration: none;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="main">
        <form action="insert_card.php" method="post">
            <h2>هل تريد شراء المنتج؟</h2>
            <input type="text" name="id" value="<?php echo $res['id'] ?>">
            <input type="text" name="name" value="<?php echo $res['name'] ?>">
            <input type="text" name="price" value="<?php echo $res['price'] ?>">
            <button type="submit" name="add" class="btn btn-warning">تأكيد إضافة المنتج للعربة</button>
            <br>
            <a href="shop.php">الرجوع لصفحة المنتجات</a>
        </form>
    </div>
</body>

</html>
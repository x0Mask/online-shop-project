<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <h2>موقع تسوق</h2>
            <img src="../images/logo.jpg" alt="online shop logo" width="450px">
            <input type="text" name="name" placeholder="اسم المنتج">
            <br>
            <input type="text" name="price" placeholder="سعر المنتج">
            <br>
            <input type="file" name="image" id="file" style="display: none;">
            <label for="file">اختيار صورة للمنتج</label>
            <button name="upload"> رفع المنتج</button>
            <br><br>
            <a href="products.php">عرض كل المنتجات</a>
        </form>
    </div>
    <p>© 2024 By Mohamed Abdelsalam</p>
</body>

</html>
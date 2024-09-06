<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل منتج</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        .main {
            margin-top: 170px;
        }
    </style>
</head>

<body>
    <?php
    include('config.php');
    $id = intval($_GET['id']);
    $edit = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $res = mysqli_fetch_array($edit);
    ?>
    <div class="main">
        <form action="update.php" method="post" enctype="multipart/form-data">
            <h2>تعديل منتج</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($res['id']); ?>">
            <br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($res['name']); ?>" required>
            <br>
            <input type="text" name="price" value="<?php echo htmlspecialchars($res['price']); ?>" required>
            <br>
            <input type="file" name="image" id="file" style="display: none;">
            <label for="file">تحديث صورة المنتج</label>
            <button name="edit" type="submit">تعديل المنتج</button>
            <br><br>
            <a href="products.php">عرض كل المنتجات</a>
        </form>
        <p>© 2024 By Mohamed Abdelsalam</p>
    </div>
</body>

</html>

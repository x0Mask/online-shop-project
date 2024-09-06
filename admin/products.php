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
        h3 {
            text-align: center;
            font-weight: bold;
            margin: 40px 0;
        }

        .card {
            flex: 0 0 auto;
            width: 15rem;
            margin: 0;
        }

        .card-title {
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 200px;
        }

        a {
            text-decoration: none;
            font-size: 20px;
            color: tomato;
            font-weight: bold;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .add-product-link {
            clear: both;
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h3>لوحة تحكم الادمن</h3>

    <div class="products-container">
        <?php
        include('config.php');

        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_array($result)) {
            echo "
                    <div class='card' style='width: 15rem;'>
                    <img src='$row[image]' class='card-img-top' alt='Product Image'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>$row[price]</p>
                        <a href='delete.php? id=$row[id]' class='btn btn-danger'>حذف منتج</a>
                        <a href='edit.php? id=$row[id]' class='btn btn-primary'>تعديل منتج</a>
                    </div>
                    </div>
            ";
        }
        ?>
    </div>

    <div class="add-product-link">
        <a href="index.php">إضافة منتج جديد</a>
    </div>
</body>

</html>
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
            margin-top: 20px;
        }

        main {
            width: 80%;
        }

        .card {
            float: right;
            margin: 20px 10px 0 10px;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 200px;
        }

        .navbar-brand {
            margin-left: 70px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="card.php" class="navbar-brand">Mycard | عربتى</a>
    </nav>
    <h3>المنتجات المتوفرة</h3>

    <?php
    include('config.php');

    $result = mysqli_query($conn, "SELECT * FROM products");
    while ($row = mysqli_fetch_array($result)) {
        echo "
                <main>
                    <div class='card' style='width: 15rem;'>
                    <img src='$row[image]' class='card-img-top' alt='Product Image'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>$row[price]</p>
                        <a href='val.php? id=$row[id]' class='btn btn-success'>إضافة المنتج الى العربة</a>
                    </div>
                    </div>
                </main>
            ";
    }
    ?>
</body>

</html>
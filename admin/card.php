<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منتجاتى | عربتى</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            text-align: center;
        }
        h3 {
            text-align: center;
            font-weight: bold;
            margin: 20px 0 30px 0;
            font-family: 'Cairo', sans-serif;
        }

        main {
            width: 60%;
            margin: 0 auto;
            text-align: center;
        }

        .table thead {
            background-color: blue;

        }

        #back {
            text-decoration: none;
            font-size: 20px;
            color: tomato;
            font-weight: bold;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h3>المنتجات المتوفرة</h3>
    <?php
    include('config.php');
    $result = mysqli_query($conn, 'SELECT * FROM addcard');
    while ($row = mysqli_fetch_array($result)) {
        echo "
        <main>
        <table class='table'>
            <thead>
                <tr>
                    <th scope='col'>اسم المنتج</th>
                    <th scope='col'>سعر المنتج</th>
                    <th scope='col'> حذف المنتج</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$row[name]</td>
                    <td>$row[price]</td>
                    <td><a href='del_card.php? id=$row[id]' class='btn btn-danger'>إزالة</a></td>
                </tr>
            </tbody>
        </table>
    </main>";
    }
    ?>
    <a id="back" href="shop.php">الرجوع الى صفحة المنتجات</a>
</body>

</html>
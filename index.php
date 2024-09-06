<?php
session_start();
include('admin/config.php'); // Include your database connection

// Generate CSRF token if not set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عربة التسوق</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="box" id="current-user-box">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<div class='current_user'>";
            echo "<p>المستخدم الحالي: " . htmlspecialchars($_SESSION['username']) . "</p>"; // Display the logged-in user
            echo "<form action='logout.php' method='POST'>";
            echo "<input type='submit' value='تسجيل الخروج' name='logout'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>مرحبا بك</p>";
            echo "<a href='login.php'>تسجيل الدخول</a>";
        }
        ?>
    </div>
    <div>
        <h2>أحدث المنتجات</h2>
    </div>
    <div class="box" id="products-box">
        <?php
        $result = mysqli_query($conn, "SELECT id, name, price, image FROM products");
        if (!$result) {
            die("Database query failed: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($result)) {
            $price = floatval($row['price']); // Ensure the price is a float
            $formatted_price = number_format($price, 2);
            echo "
            <div class='product' style='width: 15rem;'>
                <img src='" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='Product Image'>
                <div class='card-body'>
                    <h5 class='card-title'>" . htmlspecialchars($row['name']) . "</h5>
                    <p class='card-text'>$" . htmlspecialchars($formatted_price) . "</p>
                    <!-- Add to Cart Button -->
                    <form action='add_to_cart.php' method='POST'>
                        <input type='hidden' name='csrf_token' value='" . htmlspecialchars($csrf_token) . "'>
                        <input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>
                        <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                        <input type='hidden' name='product_price' value='" . htmlspecialchars($price) . "'>
                        <input type='hidden' name='product_image' value='" . htmlspecialchars($row['image']) . "'>
                        <input type='submit' value='إضافة الى العربة' class='btn btn-success'>
                    </form>
                </div>
            </div>
        ";
        }
        ?>
    </div>
    <div>
        <h2>عربة التسوق</h2>
    </div>
    <div class="box" id="shopping-cart-box">
        <table>
            <thead>
                <tr>
                    <th>الصورة</th>
                    <th>اسم المنتج</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>إجمالى السعر</th>
                    <th>حذف المنتج</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('admin/config.php');

                if (!isset($_SESSION['user_id'])) {
                    die('User not logged in.');
                }

                $user_id = $_SESSION['user_id'];
                $total_price = 0;
                $result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");

                if (mysqli_num_rows($result) > 0) {
                    while ($item = mysqli_fetch_assoc($result)) {
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;

                        echo "<tr data-product-id='{$item['product_id']}'>";
                        echo "<td><img src='" . htmlspecialchars($item['image']) . "' alt='" . htmlspecialchars($item['name'])."' width='50'></td>";
                        echo "<td>{$item['name']}</td>";
                        echo "<td>$" . number_format($item['price'], 2) . "</td>";
                        echo "<td>
                        <input type='number' name='quantity' value='{$item['quantity']}' min='1' max='20' class='form-control' onchange='updateQuantity({$item['product_id']}, this.value)'>
                    </td>";
                        echo "<td class='total-price'>$" . number_format($item_total, 2) . "</td>";
                        echo "<td><a href='remove_from_cart.php?id={$item['product_id']}' class='btn btn-danger'>حذف</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>عربتك فارغة.</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" id="cart-total" class="total-price"><strong>$<?php echo number_format($total_price, 2); ?></strong></td>
                    <td colspan="3" style="text-align: center;"><strong>إجمالى السعر</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        function updateQuantity(productId, newQuantity) {
            fetch('update_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: newQuantity,
                        csrf_token: '<?php echo $csrf_token; ?>'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        const totalPriceCell = row.querySelector('.total-price');
                        totalPriceCell.textContent = '$' + parseFloat(data.new_total).toFixed(2);

                        const cartTotal = document.getElementById('cart-total');
                        if (cartTotal) {
                            cartTotal.textContent = '$' + parseFloat(data.cart_total).toFixed(2);
                        }
                    } else {
                        alert('Failed to update quantity. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>

</body>

</html>
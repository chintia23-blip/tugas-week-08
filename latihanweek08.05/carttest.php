
<?php
session_start();

// Membuat keranjang jika belum tersedia
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Proses tambah barang
if (isset($_POST['apples'])) {
    $jumlah = $_POST['apples'];

    if (is_numeric($jumlah) && $jumlah > 0) {
        if (isset($_SESSION['cart']['apples'])) {
            $_SESSION['cart']['apples'] += $jumlah;
        } else {
            $_SESSION['cart']['apples'] = $jumlah;
        }
    }
}

if (isset($_POST['bananas'])) {
    $jumlah = $_POST['bananas'];

    if (is_numeric($jumlah) && $jumlah > 0) {
        if (isset($_SESSION['cart']['bananas'])) {
            $_SESSION['cart']['bananas'] += $jumlah;
        } else {
            $_SESSION['cart']['bananas'] = $jumlah;
        }
    }
}

// Proses tombol Remove
if (isset($_POST['remove'])) {
    $item = $_POST['remove'];

    if (isset($_SESSION['cart'][$item])) {
        $_SESSION['cart'][$item]--;

        if ($_SESSION['cart'][$item] <= 0) {
            unset($_SESSION['cart'][$item]);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart Test</title>
</head>
<body>

<h1>Items Available</h1>

<form action="carttest.php" method="post">
    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>
        <tr>
            <td>Apples</td>
            <td><input type="number" name="apples" min="0" size="2"></td>
        </tr>
        <tr>
            <td>Bananas</td>
            <td><input type="number" name="bananas" min="0" size="2"></td>
        </tr>
    </table>

    <input type="submit" value="Click to add to cart">
</form>

<br>

<fieldset style="width:300px">
    <legend>Your Shopping Cart</legend>

    <?php
    if (empty($_SESSION['cart'])) {
        echo "Your shopping cart is empty";
    } else {
        echo "<table>";
        echo "<tr><th>Item</th><th>Quantity</th><th>Action</th></tr>";

        foreach ($_SESSION['cart'] as $key => $value) {
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "<td>
                <form action='carttest.php' method='post'>
                    <button type='submit' name='remove' value='$key'>
                        Remove
                    </button>
                </form>
            </td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</fieldset>

</body>
</html>

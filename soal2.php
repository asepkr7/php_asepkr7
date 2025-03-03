<?php
session_start();

// Cek apakah form telah dikirim dan simpan data ke session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama'])) {
        $_SESSION['nama'] = $_POST['nama'];
        $_SESSION['step'] = 2; // Lanjut ke form umur
    } elseif (isset($_POST['umur'])) {
        $_SESSION['umur'] = $_POST['umur'];
        $_SESSION['step'] = 3; // Lanjut ke form hobi
    } elseif (isset($_POST['hobi'])) {
        $_SESSION['hobi'] = $_POST['hobi'];
        $_SESSION['step'] = 4; // Lanjut ke tampilan hasil
    }
} else {
    $_SESSION['step'] = 1; // Mulai dari form pertama
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Bertahap</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin-top: 50px;
    }

    form {
        border: 1px solid #333;
        padding: 20px;
        display: inline-block;
    }

    input {
        padding: 5px;
        margin: 10px;
    }

    button {
        padding: 8px 15px;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <?php
if ($_SESSION['step'] == 1) {
    // Form 1: Input Nama
    echo '<form method="post">';
    echo '<label>Nama Anda: </label>';
    echo '<input type="text" name="nama" required>';
    echo '<br><button type="submit">SUBMIT</button>';
    echo '</form>';
} elseif ($_SESSION['step'] == 2) {
    // Form 2: Input Umur
    echo '<form method="post">';
    echo '<label>Umur Anda: </label>';
    echo '<input type="number" name="umur" required>';
    echo '<br><button type="submit">SUBMIT</button>';
    echo '</form>';
} elseif ($_SESSION['step'] == 3) {
    // Form 3: Input Hobi
    echo '<form method="post">';
    echo '<label>Hobi Anda: </label>';
    echo '<input type="text" name="hobi" required>';
    echo '<br><button type="submit">SUBMIT</button>';
    echo '</form>';
} elseif ($_SESSION['step'] == 4) {
    // Menampilkan hasil
    echo "<h2>Data yang Anda Masukkan:</h2>";
    echo "<p><b>Nama:</b> " . $_SESSION['nama'] . "</p>";
    echo "<p><b>Umur:</b> " . $_SESSION['umur'] . "</p>";
    echo "<p><b>Hobi:</b> " . $_SESSION['hobi'] . "</p>";
    session_destroy(); // Hapus session setelah menampilkan hasil
}
?>

</body>

</html>
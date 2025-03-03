<?php 
// Konfigurasi database
$db_host = 'localhost'; 
$db_user = 'root'; 
$db_pass = ''; 
$db_name = 'person'; 

// Koneksi ke database
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$db) {
    die('Gagal terhubung ke MySQL: ' . mysqli_connect_error());
}

// Inisialisasi variabel pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';

// Query SQL dengan filter pencarian
$sql = "SELECT person.nama, person.alamat, hobi.hobi 
        FROM person 
        INNER JOIN hobi ON person.id = hobi.person_id
        WHERE person.nama LIKE '%$search%' 
           OR person.alamat LIKE '%$search%' 
           OR hobi.hobi LIKE '%$search%'";

$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Person & Hobi</title>
    <style>
    table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .search-container {
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <h2>Data Person & Hobi</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (mysqli_num_rows($result) > 0): 
                while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['hobi']) ?></td>
            </tr>
            <?php endwhile; 
            else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada data ditemukan</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Form Pencarian -->
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari nama, alamat, atau hobi..."
                value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
            <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>">
                <button type="button">Reset</button>
            </a>
        </form>
    </div>

</body>

</html>
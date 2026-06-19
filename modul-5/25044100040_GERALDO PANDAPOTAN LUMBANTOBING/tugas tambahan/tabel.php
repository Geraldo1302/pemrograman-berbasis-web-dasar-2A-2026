<?php
$host = "localhost";
$user = "root";
$pw = "";
$db = "modul_6";

$connet = new mysqli($host, $user, $pw, $db);
$query = "select * from mahasiswa";
$data = $connet->query($query);

var_dump($data);
$data = $data->fetch_assoc();
var_dump($data);
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tabel Mahasiswa</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    width: 95%;
    max-width: 1000px;
    background: white;
    padding: 35px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

nav {
    margin-bottom: 20px;
}

nav a {
    margin: 0 10px;
    text-decoration: none;
    font-weight: bold;
    padding: 6px 12px;
    border-radius: 8px;
    background-color: #1e3c72;
    color: white;
}

h2 {
    color: #1e3c72;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th {
    background: #1e3c72;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f2f2f2;
}

/* tombol hapus */
button {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    background: #e74c3c;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #c0392b;
}

/* warna status */
.status-aktif {
    color: green;
    font-weight: bold;
}

.status-cuti {
    color: red;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="container">
    <nav>
        <a href="form.php">Form</a>
        <a href="card.php">Card</a>
        <a href="tabel.php">Tabel</a>
    </nav>

    <h2>Tabel Data Mahasiswa</h2>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <?php
$file = "data_mahasiswa.json";

if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
} else {
    $data = [];
}

if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];

    if (isset($data[$index])) {
        array_splice($data, $index, 1);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    header("Location: tabel.php");
    exit;
}
?>
        <tbody>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $index => $mhs) : ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                <td><?= htmlspecialchars($mhs['umur']) ?> tahun</td>

                <td class="<?= $mhs['status'] == 'Aktif' ? 'status-aktif' : 'status-cuti' ?>">
                    <?= htmlspecialchars($mhs['status']) ?>
                </td>

                <td>
                    <a href="tabel.php?hapus=<?= $index ?>" 
                    onclick="return confirm('Yakin mau hapus data ini?')">
                    <button>Hapus</button>
                    </a>
                </td>
            </tr>

            <tr>
            <?php foreach($data_mahasiswa as $mahasiswa) { ?>
            <p>baris</p>
            <?php } ?>

            <?php
            if ($data_mahasiswa-> num_rows() > 0) {}
                while ($rows = $data_mahasiswa -> fetch_assoc()) 
            ?>
            </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">Belum ada data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

</body>
</html>
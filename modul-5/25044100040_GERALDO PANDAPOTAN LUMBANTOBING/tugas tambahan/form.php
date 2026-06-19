<?php
// proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $umur = intval($_POST['umur']); // pastikan angka
    $status = $_POST['status'];

    // ambil data lama dari file
    $file = "data_mahasiswa.json";
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
    } else {
        $data = [];
    }

    // tambah data baru
    $data[] = [
        "nama" => $nama,
        "umur" => $umur,
        "status" => $status
    ];

    // simpan kembali ke file
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    echo "<script>alert('Data berhasil disimpan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Mahasiswa</title>

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
    width: 90%;
    max-width: 450px;
    background: white;
    padding: 35px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

h2 {
    color: #1e3c72;
}

nav a {
    margin: 0 10px;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 8px;
    background: #1e3c72;
    color: white;
}

input[type="text"],
input[type="number"] {
    width: 80%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 10px;
    border: 1px solid #ccc;
}

button {
    margin-top: 15px;
    padding: 12px 25px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    color: white;
    cursor: pointer;
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

<h2>Form Input Mahasiswa</h2>

<form method="POST">
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="number" name="umur" placeholder="Umur" required><br>
    <label>
        <input type="radio" name="status" value="Aktif" required> Aktif
    </label>
    <label>
        <input type="radio" name="status" value="Cuti"> Cuti
    </label><br>
    <button type="submit">Simpan</button>
</form>

</div>
</body>
</html>
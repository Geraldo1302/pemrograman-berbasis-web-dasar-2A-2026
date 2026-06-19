<?php
$file = "data_mahasiswa.json";

if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
} else {
    $data = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Card Mahasiswa</title>

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
    max-width: 900px;
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

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
}

.card {
    background: #748fa9;
    padding: 15px;
    border-radius: 12px;
    width: 200px;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-align: center;
    color: white;
}

.card:hover {
    transform: scale(1.05);
}

.logo {
    width: 100%;
    height: 120px;
    object-fit: contain;
    mix-blend-mode: multiply;
    margin-bottom: 10px;
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

    <h2>Data Mahasiswa / Card</h2>

    <div class="card-container">
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $mhs) : ?>
                <div class="card">
                    <img src="logo.png" class="logo">
                    <h3><?= htmlspecialchars($mhs['nama']) ?></h3>
                    <p>Umur: <?= htmlspecialchars($mhs['umur']) ?> tahun</p>
                    <p>Status: <?= htmlspecialchars($mhs['status']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Belum ada data mahasiswa.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
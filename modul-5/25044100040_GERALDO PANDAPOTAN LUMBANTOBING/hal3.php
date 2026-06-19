<!DOCTYPE html>
<html>
<head>
    <title>Blog Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .layout {
            display: flex;
            gap: 20px;
        }

        .sidebar {
            width: 30%;
        }

        .content {
            width: 70%;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            background: #4CAF50;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #45a049;
        }

        img {
            width: 60%;
            border-radius: 10px;
            margin-top: 10px;
        }

        .quote {
            font-style: italic;
            color: #555;
            border-left: 4px solid #4CAF50;
            padding-left: 10px;
        }

        .nav {
            text-align: center;
            margin-top: 20px;
        }

        .nav a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            background: #333;
            color: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php
$artikel = [
    "html" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "10 Januari 2023",
        "isi" => "Awalnya saya bingung dengan struktur HTML, tetapi setelah mencoba membuat halaman dengam membuat Nasted List atau bisa di bilang list bersarang.",
        "gambar" => "HTMLfirst.png",
        "link" => "https://developer.mozilla.org/id/docs/Web/HTML"
    ],
    "error" => [
        "judul" => "Error Pertama Saya",
        "tanggal" => "5 Februari 2023",
        "isi" => "Saya mengalami error saat menjalankan kode JavaScript. Dari situ saya belajar pentingnya debugging dan membaca pesan error dengan teliti.",
        "gambar" => "error.png",
        "link" => "https://stackoverflow.com/"
    ],
    "project" => [
        "judul" => "Proyek Website Pertama",
        "tanggal" => "20 Maret 2024",
        "isi" => "Saya berhasil membuat website pertama. Walaupun sederhana, pengalaman ini sangat meningkatkan kepercayaan diri saya.",
        "gambar" => "prjk.png",
        "link" => "https://www.w3schools.com/"
    ]
];

$kutipan = [
    "Coding is like humor. If you have to explain it, it’s bad.",
    "First, solve the problem. Then, write the code.",
    "Experience is the name everyone gives to their mistakes.",
    "Fix the cause, not the symptom.",
    "Code never lies, comments sometimes do."
];

$randomQuote = $kutipan[array_rand($kutipan)];

$key = $_GET['artikel'] ?? null;
?>

<div class="container">
    <h2>Blog Reflektif Developer</h2>

    <div class="layout">

        <div class="sidebar">
            <div class="card">
                <h3>Daftar Artikel</h3>

                <?php foreach ($artikel as $keyArtikel => $data): ?>
                    <a href="?artikel=<?= $keyArtikel ?>">
                        <?= $data['judul'] ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="card">
                <h4>Kutipan Hari Ini</h4>
                <p class="quote">"<?= $randomQuote ?>"</p>
            </div>
        </div>

        <div class="content">
            <div class="card">

                <?php if ($key && isset($artikel[$key])): 
                    $data = $artikel[$key];
                ?>

                    <h3><?= $data['judul']; ?></h3>
                    <small><?= $data['tanggal']; ?></small>

                    <p><?= $data['isi']; ?></p>

                    <img src="<?= $data['gambar']; ?>" alt="gambar">

                    <p>
                        Referensi:
                        <a href="<?= $data['link']; ?>" target="_blank">
                            <?= $data['link']; ?>
                        </a>
                    </p>

                <?php else: ?>
                    <p>Pilih artikel untuk membaca.</p>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <div class="nav">
        <a href="hal1.php">⬅ Profil</a>
        <a href="hal2.php">⬅ Timeline</a>
    </div>

</div>

</body>
</html>
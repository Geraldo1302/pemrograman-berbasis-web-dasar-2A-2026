<!DOCTYPE html>
<html>
<head>
    <title>Timeline Belajar Coding</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        /* CONTAINER */
        .container {
            max-width: 800px;
            margin: auto;
        }

        /* TIMELINE */
        .timeline {
            position: relative;
            margin: 30px 0;
            padding-left: 40px;
        }

        /* GARIS VERTIKAL */
        .timeline::before {
            content: "";
            position: absolute;
            left: 15px;
            top: 0;
            width: 3px;
            height: 100%;
            background: #4CAF50;
        }

        /* ITEM */
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }

        /* TITIK */
        .timeline-item::before {
            content: "";
            position: absolute;
            left: -28px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            background: #4CAF50;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #4CAF50;
            transition: 0.3s;
        }

        /* HOVER TITIK */
        .timeline-item:hover::before {
            background: #ff9800;
            box-shadow: 0 0 0 2px #ff9800;
            transform: translateY(-50%) scale(1.2);
        }

        /* CARD */
        .card {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: left;
        }

        /* TAHUN */
        .tahun {
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }

        /* HIGHLIGHT (2026) */
        .highlight .card {
            border-left: 5px solid #d52307;
            background: #6992a4;
        }

        /* NAV */
        .nav {
            text-align: center;
            margin-top: 30px;
        }

        .nav a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            background: #4CAF50;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .nav a:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
<?php
$timeline = [
    [
        "tahun" => "2025",
        "judul" => "Masuk Kuliah",
        "deskripsi" => "Mulai belajar flowchart di kampus."
    ],
    [
        "tahun" => "2025",
        "judul" => "Belajar python",
        "deskripsi" => "Mulai membuat kalkulator sederhana dan lainnya."
    ],
    [
        "tahun" => "2025",
        "judul" => "Demo Projek",
        "deskripsi" => "Menjelaskan Projek yang di buat."
    ],
    [
        "tahun" => "2026",
        "judul" => "Belajar HTML, CSS dan JavaScript",
        "deskripsi" => "Membuat Project pertama."
    ],
    [
        "tahun" => "2026",
        "judul" => "Belajar Backend (PHP & MySQL)",
        "deskripsi" => "Mulai membangun aplikasi dinamis."
    ]
];

function highlightTahun($tahun) {
    if ($tahun == "2025") {
        return "highlight";
    }
    return "";
}
?>

<div class="container">
    <h2>Timeline Perjalanan Belajar Coding</h2>

    <div class="timeline">
        <?php foreach ($timeline as $data): ?>
            <div class="timeline-item <?= highlightTahun($data['tahun']); ?>">
                <div class="card">
                    <div class="tahun"><?= $data['tahun']; ?></div>
                    <h3><?= $data['judul']; ?></h3>
                    <p><?= $data['deskripsi']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="nav">
        <a href="hal1.php">⬅ Kembali ke Profil</a>
        <a href="hal3.php">➡ Menuju Blog Developer</a>
    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
        padding: 20px;
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #4CAF50;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f1f1f1;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #4CAF50;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #45a049;
        }

        label {
            font-weight: 600;
            color: #555;
        }

        .error {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: #2ecc71;
            text-align: center;
            font-weight: bold;
        }
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

<h2>Profil Interaktif Developer Pemula</h2>

<table border="1">
    <tr><th colspan="2">Data Profil</th></tr>
    <tr><td>Nama</td><td>Geraldo Pandapotan Lumbantobing</td></tr>
    <tr><td>ID Developer</td><td>DO18</td></tr>
    <tr><td>Kota/Tgl Lahir</td><td>Sigotom, *3 Februari 200*</td></tr>
    <tr><td>Email</td><td>tobingaldo***@email.com</td></tr>
    <tr><td>No. WhatsApp</td><td>0822130145**</td></tr>
</table>

<?php
function tampilkanList($dataArray) {
    $hasil = "<ul>";
    foreach ($dataArray as $item) {
        $hasil .= "<li>" . htmlspecialchars(trim($item)) . "</li>";
    }
    $hasil .= "</ul>";
    return $hasil;
}

$error = "";
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? "";
    $skill = $_POST['skill'] ?? "";

    if (empty($framework) || empty($pengalaman) || empty($tools) || empty($minat) || empty($skill)) {
        $error = "Semua field wajib diisi!";
    } else {

        $frameworkArray = explode(",", $framework);

        $pesanTambahan = "";
        if (count($frameworkArray) > 2) {
            $pesanTambahan = "<p style='color:green;'><b>Skill Anda cukup luas di bidang development!</b></p>";
        }

        $output = "
        <h3>Hasil Input</h3>
        <table border='1' cellpadding='10'>
            <tr><td><b>Framework/Tools</b></td><td>" . tampilkanList($frameworkArray) . "</td></tr>
            <tr><td><b>Tools Pendukung</b></td><td>" . tampilkanList($tools) . "</td></tr>
            <tr><td><b>Minat Bidang</b></td><td>$minat</td></tr>
            <tr><td><b>Tingkat Skill</b></td><td>$skill</td></tr>
        </table>

        <h4>Pengalaman:</h4>
        <p>$pengalaman</p>

        $pesanTambahan
        ";
    }
}
?>

<h3>Form Input</h3>

<?php if ($error != "") echo "<p class='error'>$error</p>"; ?>

<form method="POST">

    <label>Framework/Tools (pisahkan dengan koma):</label><br>
    <input type="text" name="framework"><br><br>

    <label>Pengalaman:</label><br>
    <textarea name="pengalaman" rows="4" cols="50"></textarea><br><br>

    <label>Tools Penunjang:</label><br>
    <input type="checkbox" name="tools[]" value="VS Code"> VS Code<br>
    <input type="checkbox" name="tools[]" value="GitHub"> GitHub<br>
    <input type="checkbox" name="tools[]" value="Figma"> Figma<br>
    <input type="checkbox" name="tools[]" value="Postman"> Postman<br><br>

    <label>Minat Bidang:</label><br>
    <input type="radio" name="minat" value="Frontend"> Frontend<br>
    <input type="radio" name="minat" value="Backend"> Backend<br>
    <input type="radio" name="minat" value="Fullstack"> Fullstack<br><br>

    <label>Tingkat Skill:</label><br>
    <select name="skill">
        <option value="">-- Pilih --</option>
        <option value="Dasar">Dasar</option>
        <option value="Cukup">Cukup</option>
        <option value="Profesional">Profesional</option>
    </select><br><br>

    <button type="submit">Submit</button>
</form>

<?php echo $output; ?>
<hr>
<div class="nav">
    <a href="hal2.php">➡ Timeline Perjalanan Belajar Coding </a>
    <a href="hal3.php">➡ Menuju Blog Developer</a>
</div>
</body>
</html>
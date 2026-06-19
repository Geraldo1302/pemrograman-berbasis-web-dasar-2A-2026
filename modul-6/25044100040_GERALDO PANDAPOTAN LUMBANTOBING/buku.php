<?php
include 'auth.php';
include 'koneksi.php';

if (isset($_POST['simpan']) && $_SESSION['role'] === 'admin') {
    $stmt = $conn->prepare("INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $_POST['judul'], $_POST['penulis'], $_POST['penerbit'], $_POST['tahun_terbit'], $_POST['stok']);
    $stmt->execute();
    header("Location: buku.php");
    exit;
}

if (isset($_POST['update']) && $_SESSION['role'] === 'admin') {
    $stmt = $conn->prepare("UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, stok=? WHERE id=?");
    $stmt->bind_param("sssiii", $_POST['judul'], $_POST['penulis'], $_POST['penerbit'], $_POST['tahun_terbit'], $_POST['stok'], $_POST['id']);
    $stmt->execute();
    header("Location: buku.php");
    exit;
}

if (isset($_GET['hapus']) && $_SESSION['role'] === 'admin') {
    $id = (int) $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM buku WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: buku.php");
    exit;
}

$edit = null;
if (isset($_GET['edit']) && $_SESSION['role'] === 'admin') {
    $id = (int) $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc();
}

$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = trim($_GET['cari']);
    $search_query = "%" . $keyword . "%";
    $stmt = $conn->prepare("SELECT * FROM buku WHERE judul LIKE ? OR penulis LIKE ? OR penerbit LIKE ? ORDER BY id DESC");
    $stmt->bind_param("sss", $search_query, $search_query, $search_query);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM buku ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">📚 Data Buku</h1>
            <p class="text-slate-500 mt-1">
                Selamat datang, <span class="font-semibold text-blue-600"><?= htmlspecialchars($_SESSION['username']) ?></span>
                <span class="text-sm bg-blue-100 text-blue-700 px-2 py-1 rounded-full ml-2"><?= htmlspecialchars($_SESSION['role']) ?></span>
            </p>
        </div>
        <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl shadow transition text-center">Logout</a>
    </div>

    <div class="bg-white shadow-md rounded-2xl p-4 mb-6">
        <form method="GET" action="buku.php" class="flex gap-2">
            <input 
                type="text" 
                name="cari" 
                placeholder="Cari judul, penulis, atau penerbit..." 
                value="<?= htmlspecialchars($keyword) ?>"
                class="flex-1 border border-slate-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition">
                Cari
            </button>
            <?php if ($keyword !== ""): ?>
                <a href="buku.php" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-xl transition flex items-center">
                    Reset
                </a>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
        <h2 class="text-2xl font-bold text-slate-700 mb-4"><?= $edit ? '✏️ Edit Buku' : '➕ Tambah Buku' ?></h2>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php if ($edit): ?> <input type="hidden" name="id" value="<?= $edit['id'] ?>"> <?php endif; ?>
            <input type="text" name="judul" placeholder="Judul Buku" value="<?= htmlspecialchars($edit['judul'] ?? '') ?>" required class="border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" name="penulis" placeholder="Penulis" value="<?= htmlspecialchars($edit['penulis'] ?? '') ?>" required class="border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" name="penerbit" placeholder="Penerbit" value="<?= htmlspecialchars($edit['penerbit'] ?? '') ?>" required class="border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" value="<?= htmlspecialchars($edit['tahun_terbit'] ?? '') ?>" required class="border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="number" name="stok" placeholder="Stok Buku" value="<?= htmlspecialchars($edit['stok'] ?? '') ?>" required class="border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <div class="flex gap-2 items-center">
                <button type="submit" name="<?= $edit ? 'update' : 'simpan' ?>" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl shadow transition">
                    <?= $edit ? 'Update' : 'Simpan' ?>
                </button>
                <?php if ($edit): ?>
                    <a href="buku.php" class="bg-slate-400 hover:bg-slate-500 text-white px-6 py-3 rounded-xl shadow transition">Batal</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Penulis</th>
                        <th class="px-4 py-3">Penerbit</th>
                        <th class="px-4 py-3 text-center">Tahun</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-center"><?= $no++ ?></td>
                            <td class="px-4 py-3 font-medium text-slate-800"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['penulis']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['penerbit']) ?></td>
                            <td class="px-4 py-3 text-center"><?= htmlspecialchars($row['tahun_terbit']) ?></td>
                            <td class="px-4 py-3 text-center">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <?= htmlspecialchars($row['stok']) ?>
                                </span>
                            </td>
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="buku.php?edit=<?= $row['id'] ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm">Edit</a>
                                    <a href="buku.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">Hapus</a>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= $_SESSION['role'] === 'admin' ? 7 : 6 ?>" class="px-4 py-10 text-center text-slate-500 italic">
                                Data tidak ditemukan untuk kata kunci "<strong><?= htmlspecialchars($keyword) ?></strong>"
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
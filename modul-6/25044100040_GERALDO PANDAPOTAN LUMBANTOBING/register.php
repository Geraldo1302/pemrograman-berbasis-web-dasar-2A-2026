<?php
include 'koneksi.php';

$pesan = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (strlen($username) < 3) {
        $pesan = '<div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
            Username minimal 3 karakter.
        </div>';
    } elseif (strlen($password) < 4) {
        $pesan = '
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
            Password minimal 4 karakter.
        </div>';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $cek = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $cek->bind_param("s", $username);
        $cek->execute();
        $result = $cek->get_result();

        if ($result->num_rows > 0) {
            $pesan = '
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
                Username sudah digunakan.
            </div>';
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO users (username, password, role)
                VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $username, $password_hash, $role);

            if ($stmt->execute()) {
                $pesan = '
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-4">
                    Registrasi berhasil!
                    <a href="login.php" class="font-semibold underline">
                        Login sekarang
                    </a>
                </div>';
            } else {
                $pesan = '
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
                    Registrasi gagal: ' . htmlspecialchars($stmt->error) . '
                </div>';
            }

            $stmt->close();
        }

        $cek->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="text-5xl mb-3">📝</div>
            <h1 class="text-3xl font-bold text-gray-800">Registrasi Akun</h1>
            <p class="text-gray-500 text-sm mt-2">
                Buat akun baru untuk mengakses sistem perpustakaan
            </p>
        </div>

        <?= $pesan ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    required
                    minlength="3"
                    placeholder="Masukkan username"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    minlength="4"
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Pilih Role
                </label>
                <select
                    name="role"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button
                type="submit"
                name="register"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5"
            >
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a
                href="login.php"
                class="text-blue-600 hover:text-blue-800 font-semibold"
            >
                Login di sini
            </a>
        </p>
    </div>

</body>
</html>
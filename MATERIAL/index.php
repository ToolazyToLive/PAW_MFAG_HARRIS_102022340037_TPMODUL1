<?php
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nim = "";
$namaErr = $emailErr = $nimErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // **********************  1  **************************  
    // Tangkap nilai nama yang ada pada form HTML
    if (empty($_POST["name"])) {
        $namaErr = "Nama wajib diisi";
    } else {
        $nama = htmlspecialchars($_POST["name"]);
    }

    // **********************  2  **************************  
    // Validasi format email agar sesuai dengan standar
    if (empty($_POST["email"])) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // **********************  3  **************************  
    // Pastikan NIM terisi dan angka
    if (empty($_POST["nim"])) {
        $nimErr = "NIM wajib diisi";
    } elseif (!ctype_digit($_POST["nim"])) {
        $nimErr = "NIM harus berupa angka";
    } else {
        $nim = htmlspecialchars($_POST["nim"]);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="styles.css">  
</head>
<body>
    <!-- **********************  4  ************************** -->
    <!-- Tambahkan kolom input untuk Nama, Email, dan NIM dengan mengambil class form-group sebagai referensi -->
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="<?php echo $nama; ?>">
                <span class="error"> <?php echo $namaErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"> <?php echo $emailErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>">
                <span class="error"> <?php echo $nimErr; ?></span>
            </div>
            
            <div class="button-container">
                <button type="submit">Daftar</button>
            </div>
        </form>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nimErr): ?>
            <div class="alert alert-success">Berhasil! Data pendaftaran telah diterima.</div>
        <?php endif; ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 400px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button, a.btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        a.btn { background-color: #6c757d; }
        button:hover, a.btn:hover { opacity: 0.85; }
    </style>
</head>
<body>

    <h2><?= esc($title) ?></h2>

    <form action="<?= esc($action) ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= esc($data['nama']) ?>" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= esc($data['email']) ?>" required>
        </div>

        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" required><?= esc($data['alamat']) ?></textarea>
        </div>

        <button type="submit">Simpan</button>
        <a href="<?= site_url('datatables') ?>" class="btn">Kembali</a>
    </form>

</body>
</html>

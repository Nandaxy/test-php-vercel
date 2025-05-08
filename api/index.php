<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Neo-Brutal Form</title>
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Courier New', monospace;
      padding: 50px;
      color: #111;
    }
    .card {
      background: white;
      border: 4px solid black;
      padding: 20px;
      max-width: 400px;
      margin: auto;
      box-shadow: 8px 8px 0px black;
    }
    input[type="text"], input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 3px solid black;
      background: #fff;
      font-size: 1em;
    }
    input[type="submit"] {
      background: black;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    .result {
      background: #ffde59;
      border: 3px solid black;
      padding: 15px;
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Masukkan Nama Kamu</h2>
    <form action="" method="POST">
      <input type="text" name="nama" placeholder="Nama kamu..." required>
      <input type="submit" value="Kirim">
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = htmlspecialchars($_POST['nama']);
        echo "<div class='result'>Halo, <u>$nama</u>! Gaya Brutal Banget!</div>";
      }
    ?>
  </div>
</body>
</html>

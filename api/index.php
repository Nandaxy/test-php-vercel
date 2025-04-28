<?php
session_start();

// Inisialisasi data jika belum ada
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
}

// Handle tambah item
if (isset($_POST['add'])) {
    $newItem = [
        'id' => uniqid(),
        'name' => htmlspecialchars($_POST['name'])
    ];
    $_SESSION['items'][] = $newItem;
    header('Location: index.php');
    exit;
}

// Handle hapus item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $_SESSION['items'] = array_filter($_SESSION['items'], function($item) use ($id) {
        return $item['id'] !== $id;
    });
    header('Location: index.php');
    exit;
}

// Handle edit item
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    foreach ($_SESSION['items'] as &$item) {
        if ($item['id'] === $id) {
            $item['name'] = htmlspecialchars($_POST['name']);
            break;
        }
    }
    unset($item); // clear reference
    header('Location: index.php');
    exit;
}

// Jika mau edit, ambil datanya
$editingItem = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    foreach ($_SESSION['items'] as $item) {
        if ($item['id'] === $id) {
            $editingItem = $item;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p-10">

    <h1 class="text-3xl font-bold mb-8">CRUD Sederhana Tanpa Database</h1>

    <div class="bg-white p-6 rounded shadow-md w-full max-w-md mb-8">
        <form method="post" class="flex flex-col gap-4">
            <?php if ($editingItem): ?>
                <input type="hidden" name="id" value="<?= $editingItem['id'] ?>">
                <input type="text" name="name" value="<?= $editingItem['name'] ?>" required class="border rounded p-2 w-full" placeholder="Edit nama item...">
                <button type="submit" name="edit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded">Update</button>
                <a href="index.php" class="text-blue-500 text-center mt-2">Batal Edit</a>
            <?php else: ?>
                <input type="text" name="name" required class="border rounded p-2 w-full" placeholder="Masukkan nama item...">
                <button type="submit" name="add" class="bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">Tambah</button>
            <?php endif; ?>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Daftar Item</h2>
        <?php if (empty($_SESSION['items'])): ?>
            <p class="text-gray-500">Belum ada item.</p>
        <?php else: ?>
            <ul class="flex flex-col gap-2">
                <?php foreach ($_SESSION['items'] as $item): ?>
                    <li class="flex justify-between items-center border-b py-2">
                        <span><?= htmlspecialchars($item['name']) ?></span>
                        <div class="flex gap-2">
                            <a href="?edit=<?= $item['id'] ?>" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            <a href="?delete=<?= $item['id'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</body>
</html>

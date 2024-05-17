<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, age, gender, email, country, city, picture_large) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['age'], $_POST['gender'], $_POST['email'], $_POST['country'], $_POST['city'], $_POST['picture_large']]);
    } elseif ($action == 'update') {
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, age = ?, gender = ?, email = ?, country = ?, city = ?, picture_large = ? WHERE id = ?");
        $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['age'], $_POST['gender'], $_POST['email'], $_POST['country'], $_POST['city'], $_POST['picture_large'], $_POST['id']]);
    } elseif ($action == 'delete') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    } elseif ($action == 'import') {
        $api_url = 'https://randomuser.me/api/';
        $response = file_get_contents($api_url);
        $data = json_decode($response, true);
        $user = $data['results'][0];

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, age, gender, email, country, city, picture_large) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user['name']['first'],
            $user['name']['last'],
            $user['dob']['age'],
            $user['gender'],
            $user['email'],
            $user['location']['country'],
            $user['location']['city'],
            $user['picture']['large']
        ]);
    }
}

$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestor de Usuarios</h1>

        <h2>Crear Usuario</h2>
        <form id="userForm">
            <input type="hidden" name="action" id="action" value="create">
            <input type="hidden" name="id" id="id">
            <input type="text" name="first_name" id="first_name" placeholder="Nombre" required>
            <input type="text" name="last_name" id="last_name" placeholder="Apellido" required>
            <input type="number" name="age" id="age" placeholder="Edad" required>
            <input type="text" name="gender" id="gender" placeholder="Género" required>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
            <input type="text" name="country" id="country" placeholder="País" required>
            <input type="text" name="city" id="city" placeholder="Ciudad" required>
            <input type="text" name="picture_large" id="picture_large" placeholder="URL de la Foto" required>
            <button type="submit" id="submitButton">Crear</button>
        </form>

        <button id="importButton" class="btn-import">Importar Usuario desde API</button>

        <h2>Usuarios</h2>
        <div id="users">
            <?php foreach ($users as $user): ?>
                <div class="user-card">
                    <div>
                        <p><?php echo "{$user['first_name']} {$user['last_name']} ({$user['age']} años, {$user['gender']})"; ?></p>
                        <p><?php echo "{$user['email']}, {$user['country']}, {$user['city']}"; ?></p>
                    </div>
                    <img src="<?php echo $user['picture_large']; ?>" alt="Foto del usuario" width="100">
                    <button class="edit" onclick="editUser(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)">Editar</button>
                    <button onclick="deleteUser(<?php echo $user['id']; ?>)">Eliminar</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

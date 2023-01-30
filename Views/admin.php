<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="Public/css/admin.css"/>
    <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
    <title>ADMIN</title>
    <script src="Public/js/admin-remove.js" type="text/javascript" defer></script>
</head>
<body>
    <div class="container">
        <div class="admin-container">
            <p class="admin-name">Admin</p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>EMAIL</th>
                    <th>NAME</th>
                    <th>SURNAME</th>
                    <th>REMOVE</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getId(); ?></td>
                        <td><?= $user->getEmail(); ?></td>
                        <td><?= $user->getName(); ?></td>
                        <td><?= $user->getSurname(); ?></td>
                        <td><span id="<?= $user->getId(); ?>" class="x-animation"><i class="fa-solid fa-xmark"></i></span></td></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="logout-container">
                <form action="logout" method="post">
                    <button class="logout">Log out</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
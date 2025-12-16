
<?php
$pdo = new Database();

if (($_SESSION['logged_in'] === true and $_SESSION['user_role'] === 'admin')) {
  $stmtUsers = $pdo->query("SELECT id, email, name, role FROM users WHERE role = 'user'");
  $users = $stmtUsers->fetchAll();
}

?>

<?php include APP_PATH . '/resources/views/components/header.php'; ?>

<section class="cabinet">
  <div class="container cabinet-container">
    <?php if (($_SESSION['logged_in'] === true and $_SESSION['user_role'] === 'admin')): ?>
      <form action="" method="post" class="cabinet-form">
        <h2>Пользователи сайта</h2>
        <ul class="cabinet-users">
          <?php foreach ($users as $user): ?>
            <li class="cabinet-user">
              <label for="name">Имя: <input type="text" value="<?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>"></label>
              <label for="email">Email: <input type="text" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" disabled></label>
              <label for="role">
                Роль: 
                <select name="user_role" id="user_role">
                  <option value="user" <?= ($user['role'] === 'user') ? 'selected' : '' ?>>user</option>
                  <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?>>admin</option>
                </select>
              </label>

              <button type="submit">Обновить</button>
            </li>
          <?php endforeach; ?>
        </ul>
      </form>
    <?php endif; ?>
  </div>
</section>

<?php include APP_PATH . '/resources/views/components/footer.php'; ?>
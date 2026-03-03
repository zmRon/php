<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>

<h2 class="text-center my-4">Simple PDO CRUD</h2>

<?php
$editUser = null;

if (isset($_GET['edit'])) {
  $users_id = $_GET['edit'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE users_id = ?");
  $stmt->execute([$users_id]);
  $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<hr>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap CRUD</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
    <div class="row">

    <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
        <div class="card-body">
        <h3 class="card-title"><?= $editUser ? 'Update User' : 'Add New User' ?></h3>
            <form method="POST">
              <?php if (!empty($editUser)): ?>
                <input type="hidden" name="users_id" value="<?= $editUser['users_id'] ?>">
              <?php endif; ?>

              <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" value="<?= !empty($editUser) ? $editUser['name'] : '' ?>" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" value="<?= !empty($editUser) ? $editUser['email'] : '' ?>" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="product" class="form-label">Product:</label>
                <input type="text" name="product" id="product" placeholder="Product" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="number" step="0.01" name="amount" id="amount" placeholder="Amount" class="form-control" required>
              </div>

              <?php if (!empty($editUser)): ?>
                <button type="submit" name="update" class="btn btn-success w-100">Update</button>
                <a href="landing.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
              <?php else: ?>
                <button type="submit" name="add" class="btn btn-success w-100">+ Add</button>
              <?php endif; ?>
            </form>
        </div>
    </div>
    </div>

    <div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-body">
        <h3 class="card-title">User List</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>users_id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                <td><?= $user['users_id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['amount'] ?></td>
                <td>
                    <a href="?edit=<?= $user['users_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $user['users_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
 </div>
</div>
  </body>
</html>
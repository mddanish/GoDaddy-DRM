<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GO DADDY DNS RECORDS MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container" style="margin-top: 50px;">
    <center><h1>GoDaddy DNS Record Management</h1></center>
      <?php
      session_start();

      if (!isset($_SESSION['logged_in'])) {
          $_SESSION['logged_in'] = false;
      }

      if (isset($_POST['username']) && isset($_POST['password'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];

          require_once 'users.php';

          if (isset($users[$username]) && password_verify($password, $users[$username])) {
              $_SESSION['logged_in'] = true;
          }
      }

      if ($_SESSION['logged_in'] == true) {
          echo "
            <div class='alert alert-success' role='alert'>
              Welcome, $username!
            </div>
            <div class='row'>
              <div class='col-sm-1'>
                <a href='index.php?page=list' class='btn btn-primary'>List DNS Records</a>
              </div>
              <div class='col-sm-1'>
                <a href='index.php?page=add' class='btn btn-success'>Add DNS Records</a>
              </div>
              <div class='col-sm-1'>
                <a href='index.php?page=change' class='btn btn-warning'>Change DNS Records</a>
              </div>
              <div class='col-sm-1'>
                <a href='index.php?page=delete' class='btn btn-danger'>Delete DNS Records</a>
              </div>
              
        
    ";
       
        $page = isset($_GET['page']) ? $_GET['page'] : 'list';
        include "$page.php"; 

    echo "</div>";

      } else {
          echo "
            <form method='post'>
              <div class='form-group'>
                <label>Username:</label>
                <input type='text' class='form-control' name='username' required>
              </div>
              <div class='form-group'>
                <label>Password:</label>
                <input type='password' class='form-control' name='password' required>
              </div>
              <input type='submit' class='btn btn-primary' value='Login'>
            </form>
          ";
      }
      ?>
    </div>
  </body>
</html>

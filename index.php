<?php 
  require 'dbManage.php';
  if ($_POST) {
    $email = $_POST['email'];
    echo $email;
    $role = getEmployeeRoleFromEmail($conn, $email);
    $_SESSION['Email'] = $email;
    $_SESSION['Role'] = $role;
    if($role==1) {
        header("Location: driver/dashboard.php");
    }
    else {
        header("Location: admin/dashboard.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Amec Test Drive App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Background image -->  
    <style>
      #intro {
        background-image: url(https://www.supercars.net/blog/wp-content/uploads/2020/07/1707753.jpg);
        height: 100vh;
      }
      .bg-white{
        --bs-bg-opacity: 0.8;
      }
    </style>
     <!-- Background image -->
     <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.2);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form class="bg-white rounded-5 shadow-5-strong p-5" method="post">

                <!-- Form header -->
                <div class="text-center">
                <h2 class="fw-bold mb-5">AMEC App Login</h2>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="loginForm">Email address</label>
                  <input type="email" id="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="loginForm">Password</label>
                  <input type="password" id="pwd" name="pwd" class="form-control" />
                </div>

                <div class="row mb-4 justify-content-center">
                  <!-- Extra spacing -->
                </div>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->

</body>
</html>

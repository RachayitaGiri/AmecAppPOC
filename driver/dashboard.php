<?php 
    session_start();
    require '../dbManage.php';
    if ($_SESSION) {
        $email = $_SESSION['Email'];
        $name = getEmployeeNameFromEmail($conn, $email);
        $_SESSION['Employee_Name'] = $name;
        $projects = getAllProjectNames($conn);
        $vehicles = getAllVehiclesNames($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome!</title>
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
            <!-- Navbar start -->
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><?php echo $name . "'s dashboard"; ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Navbar end -->
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 0;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-md-8">
                            <form class="bg-white rounded-5 shadow-5-strong p-5" method="post" action="shift.php">
                                <!-- Form header -->
                                <div class="text-center">
                                <h2 class="fw-bold mb-5">Project and Vehicle information</h2>
                                </div>

                                <!-- Project name dropdown -->
                                <div class="form-outline mb-4">
                                    <label class="form-label">Project Name</label>
                                    <select id="project" name="project" class="form-select" >
                                        <?php 
                                            foreach($projects as $project) {
                                                echo "<option value='$project[0]'>$project[1]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <!-- Vehicle dropdpwn -->
                                <div class="form-outline mb-4">
                                    <label class="form-label">Vehicle Make and Model</label>
                                    <select id="vehicle" name="vehicle" class="form-select" >
                                        <?php 
                                            foreach($vehicles as $vehicle) {
                                                echo "<option value='$vehicle[0]'>$vehicle[1]". " " . "$vehicle[2]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="row mb-4 justify-content-center">
                                    <!-- Extra spacing -->
                                </div>

                                <!-- Submit button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Save and Next</button>
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
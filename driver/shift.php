<?php
    session_start();
    require '../dbManage.php';
    if (isset($_POST)) {
        $_SESSION['Project_ID'] = $_POST['project'];
        $_SESSION['VIN'] = $_POST['vehicle'];
        $currentDateTime = date('Y-m-d\TH:i');
        $name = $_SESSION['Employee_Name'];
        $routes = getAllExistingRoutes($conn);
        $drivers = getAllDrivers($conn);
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
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.2);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-md-8">
                            <form class="bg-white rounded-5 shadow-5-strong p-5" method="post" action="drive.php">
                                <!-- Form header -->
                                <div class="text-center"><h2 class="fw-bold mb-5">Shift information</h2></div>

                                <!-- Shift inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col">
                                        <!-- Shift type dropdown -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Shift</label>
                                            <select id="shift" name="shift" class="form-select">
                                                <option value="Morning">Morning</option>
                                                <option value="Afternoon">Afternoon</option>
                                                <option value="Evening">Evening</option>
                                                <option value="Night">Night</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Shift start time -->
                                        <label class="form-label">Shift Start Time</label>
                                        <input type="datetime-local" id="shiftStart" name="shiftStart" class="form-control" 
                                            value="<?php echo $currentDateTime ?>" readonly/>
                                    </div>
                                    <div class="col">
                                        <!-- Shift end time -->
                                        <label class="form-label">Shift End Time</label>
                                        <input type="datetime-local" id="shiftEnd" name="shiftEnd" class="form-control" />
                                    </div>
                                </div>

                                <!-- Mileage, fuel and location inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col">
                                        <!-- Mileage input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Mileage</label>
                                            <input type="number" id="mileage" name="mileage" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Oil level input -->
                                        <label class="form-label">Oil level</label>
                                        <input type="number" id="oilLevel" name="oilLevel" class="form-control" min="1" max="10" />
                                    </div>
                                    <div class="col">
                                        <!-- Location input -->
                                        <label class="form-label">Location/Route</label>
                                        <input type="text" list="allRoutes" id="route" name="route" class="form-control" />
                                        <datalist id="allRoutes">
                                            <?php 
                                                foreach($routes as $route) {
                                                    echo "<option value='$route[0]'>$route[0]</option>";
                                                }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                
                                <!-- Co-Driver and comments inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col-4">
                                        <!-- Co-Driver input -->
                                        <label class="form-label">Co-Driver</label>
                                        <select type="text" id="coDriver" name="coDriver" class="form-control">
                                            <?php 
                                                foreach($drivers as $driver) {
                                                    echo "<option value='$driver[0]'>$driver[0] - $driver[1] $driver[2]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <!-- Comments input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Notes for this shift</label>
                                            <input type="text" id="notes" name="notes" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="fromShiftPage" name="fromShiftPage" value="true"/>

                                <div class="row mb-4 justify-content-center">
                                    <!-- Extra spacing -->
                                </div>

                                <!-- Submit button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Save and Begin Drive</button>
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
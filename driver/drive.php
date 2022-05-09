<?php
    session_start();
    require '../dbManage.php';
    if (isset($_POST['fromShiftPage'])) {
        $currentDateTime = date('Y-m-d\TH:i');
        $shiftID = createShift($conn, $_POST);  // get the Shift ID of the newly inserted record
        $driverID = getCurrentDriverID($conn, $_SESSION['Email']);
        $coDriverName = getEmployeeNameFromID($conn, $_POST['coDriver']);
        $_SESSION['Mileage'] = $_POST['mileage'];
        $_SESSION['Oil_Level'] = $_POST['oilLevel'];
        $_SESSION['Route'] = $_POST['route'];
        $_SESSION['Driver_ID'] = $driverID;
        $_SESSION['Co_Driver_ID'] = $_POST['coDriver'];
        $_SESSION['Shift_ID'] = $shiftID;
    }
    if(isset($_POST['btnEndDrive'])) {
        // insert Drive record and logout after destroying session
        $_SESSION['Drive_Start'] = $_POST['driveStart'];
        $_SESSION['Drive_End'] =  date('Y-m-d\TH:i');
        $driveID = createDrive($conn, $_SESSION);
        session_destroy();
        header("Location: ../index.php");
    }
    if(isset($_POST['btnIssueReport'])) {
        // insert Drive record and go to the Issue Report page
        $_SESSION['Drive_Start'] = $_POST['driveStart'];
        $_SESSION['Drive_End'] =  date('Y-m-d\TH:i');
        $driveID = createDrive($conn, $_SESSION);
        $_SESSION['Drive_ID'] = $driveID;   // get the Drive ID of the newly inserted record
        header("Location: issueReport.php");
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
            <!-- Navbar goes here, if needed -->
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.2);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-md-8">
                            <form class="bg-white rounded-5 shadow-5-strong p-5" method="post">
                                <!-- Form header -->
                                <div class="text-center"><h2 class="fw-bold mb-5">You are currently in an active drive.</h2></div>

                                <!-- Shift inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col">
                                        <!-- Drive start time -->
                                        <label class="form-label">Drive Start Time</label>
                                        <input type="datetime-local" id="driveStart" name="driveStart" class="form-control" 
                                            value="<?php echo $currentDateTime ?>" readonly/>
                                    </div>
                                    <div class="col">
                                        <!-- CoDriver name -->
                                        <label class="form-label">Co-Driver</label>
                                        <input type="text" id="coDriverName" name="coDriverName" class="form-control" 
                                            value="<?php echo $coDriverName ?>" readonly/>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-center">
                                    <!-- End Drive button -->
                                    <div class="text-center">
                                        <button type="submit" name="btnEndDrive" class="btn btn-primary btn-block">End Drive and Logout</button>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-center">
                                    <!-- End Drive and Issue Report button -->
                                    <div class="text-center">
                                        <button type="submit" name="btnIssueReport" class="btn btn-primary btn-block">End Drive and Issue Report</button>
                                    </div>
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

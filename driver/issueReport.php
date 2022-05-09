<?php 
    session_start();
    require '../dbManage.php';
    $currentDateTime = date('Y-m-d\TH:i');
    $mileage = $_SESSION['Mileage'];
    $oilLevel = $_SESSION['Oil_Level'];
    $route = $_SESSION['Route'];
    $car = getVehicleNameByVIN($conn, $_SESSION['VIN']);

    if(isset($_POST['btnSubmit'])) {
        // insert new Report record and logout after destroying session
        $_SESSION['Issue_Time'] = $_POST['issueTime'];
        $_SESSION['Speed'] = $_POST['speed'];
        $_SESSION['Temperature'] = $_POST['temp'];
        $_SESSION['Trigger'] = $_POST['trigger'];
        $_SESSION['Road_Type'] = $_POST['roadType'];
        $_SESSION['Road_Conditions'] = $_POST['roadCon'];
        $_SESSION['Concern_Level'] = $_POST['concern'];
        $_SESSION['Comments'] = $_POST['comments'];
        
        $reportID = createReport($conn, $_SESSION);

        session_destroy();
        header("Location: ../index.php");
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
                        <div class="col-xl-12 col-md-8">
                            <form class="bg-white rounded-5 shadow-5-strong p-5" method="post">
                                <!-- Form header -->
                                <div class="text-center"><h2 class="fw-bold mb-5">Report information</h2></div>

                                <!-- Report inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col">
                                        <!-- Report creation time -->
                                        <label class="form-label">Report Creation Time</label>
                                        <input type="datetime-local" id="issueTime" name="issueTime" class="form-control" 
                                            value="<?php echo $currentDateTime ?>" readonly/>
                                    </div>
                                    <div class="col">
                                        <!-- Vehicle input  -->
                                            <label class="form-label">Vehicle</label>
                                            <input type="text" id="vehicle" name="vehicle" class="form-control"
                                                value="<?php echo $car ?>" readonly/>
                                    </div>
                                    <div class="col">
                                        <!-- Location input -->
                                        <label class="form-label">Location/Route</label>
                                        <input type="text" id="route" name="route" class="form-control"
                                            value="<?php echo $route ?>" readonly />
                                    </div>
                                    <div class="col-1">
                                        <!-- Mileage input -->
                                        <label class="form-label">Mileage</label>
                                        <input type="number" id="mileage" name="mileage" class="form-control" 
                                                value="<?php echo $mileage ?>" readonly/>
                                    </div>
                                    <div class="col-1">
                                        <!-- Oil level input -->
                                        <label class="form-label">Oil level</label>
                                        <input type="number" id="oilLevel" name="oilLevel" class="form-control"
                                            value="<?php echo $oilLevel ?>" readonly/>
                                    </div>
                                    <div class="col">
                                        <!-- Customer Concern level input -->
                                        <label class="form-label">Customer Concern Level</label>
                                        <input type="number" id="concern" name="concern" class="form-control" min="1" max="10" />
                                    </div>
                                </div>

                                <!-- Road and weather inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col-2">
                                        <!-- Temperature input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Temperature (&deg;F)</label>
                                            <input type="number" id="temp" name="temp" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <!-- Speed input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Speed (mph)</label>
                                            <input type="number" id="speed" name="speed" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <!-- Trigger Value input -->
                                        <label class="form-label">Trigger</label>
                                        <select type="text" id="trigger" name="trigger" class="form-control">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <!-- Road Type -->
                                        <label class="form-label">Road Type</label>
                                        <select type="text" id="roadType" name="roadType" class="form-control">
                                            <option value="Circuit">Circuit</option>
                                            <option value="Expressway">Expressway</option>
                                            <option value="Freeway">Freeway</option>
                                            <option value="Street">Street</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <!-- Road conditions input -->
                                        <label class="form-label">Road conditions</label>
                                        <input type="text" id="roadCon" name="roadCon" class="form-control"/>
                                    </div>
                                </div>
                                
                                <!-- Co-Driver and comments inputs -->
                                <div class="row form-outline mb-4">
                                    <div class="col">
                                        <!-- Comments input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Detailed report comments</label>
                                            <textarea id="comments" name="comments" rows="3" class="form-control" 
                                            placeholder="You can enter upto 65000 characters"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-center">
                                    <!-- Extra spacing -->
                                </div>

                                <!-- Submit button -->
                                <div class="text-center">
                                    <button type="submit" name="btnSubmit" class="btn btn-primary btn-block">Submit Report</button>
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
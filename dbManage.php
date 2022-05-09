<?php
    session_start();
    require('dbConnect.php');
    date_default_timezone_set('America/Los_Angeles');
    
    $today = date("Y-m-d H:i:s");

    function getEmployeeNameFromEmail($conn, $email) {
        $res = $conn->query("SELECT FirstName, LastName FROM Employee WHERE Email='$email'");
        $row = $res->fetch_array();
        $name = $row[0] . " " . $row[1];
        return $name;
    }

    function getEmployeeNameFromID($conn, $id) {
        $res = $conn->query("SELECT FirstName, LastName FROM Employee WHERE ID='$id'");
        $row = $res->fetch_array();
        $name = $row[0] . " " . $row[1];
        return $name;
    }

    function getEmployeeRoleFromEmail($conn, $email) {
        $res = $conn->query("SELECT Designation FROM Employee WHERE Email='$email'");
        $row = $res->fetch_array();
        $designation = $row[0];
        if (strcmp($designation, "Driver")==0)
            $role = 1;  // Role is 1 for Driver
        else
            $role = 2;  // Role is 2 for Admins
        return $role;
    }

    function getAllProjectNames($conn) {
        $res = $conn->query("SELECT ID, ProjectName FROM Project");
        $projects = $res->fetch_all();
        return $projects;
    }

    function getAllVehiclesNames($conn) {
        $res = $conn->query("SELECT VIN, Make, Model FROM Vehicle");
        $vehicles = $res->fetch_all();
        return $vehicles;
    }

    function getVehicleNameByVIN($conn, $vin) {
        $res = $conn->query("SELECT Make, Model FROM Vehicle WHERE VIN='$vin'");
        $row = $res->fetch_array();
        $name = $row['Make'] . " " . $row['Model'];
        return $name;
    }

    function getAllExistingRoutes($conn) {
        $res = $conn->query("SELECT DISTINCT DriveRoute FROM Drive");
        $routes = $res->fetch_all();
        return $routes;
    }

    function getAllDrivers($conn) {
        $res = $conn->query("SELECT ID, FirstName, LastName FROM Employee WHERE Designation='Driver'");
        $drivers = $res->fetch_all();
        return $drivers;
    }

    function getCurrentDriverID($conn, $email) {
        $res = $conn->query("SELECT ID FROM Employee WHERE Email='$email'");
        $driver = $res->fetch_array();
        $driverID = $driver[0];
        return $driverID;
    }

    function getAllReports($conn) {
        $res = $conn->query("SELECT * FROM Report");
        $reports = $res->fetch_all();
        $ret = array();
        foreach($reports as $rep) {
            $temp = array();
            $temp['ID'] = $rep[0];
            $temp['Issue_Time'] = $rep[1];
            $temp['Mileage'] = $rep[2];
            $temp['Speed'] = $rep[3];
            $temp['Temperature'] = $rep[4];
            $temp['Trigger'] = $rep[5];
            $temp['Road_Type'] = $rep[6];
            $temp['Road_Conditions'] = $rep[7];
            $temp['Customer_Concern'] = $rep[8];
            $temp['Comments'] = $rep[9];
            $temp['Created_By'] = $rep[10];
            $temp['Drive_ID'] = $rep[11];

            $ret[] = $temp;
        }
        
        return $ret;
    }

    function createDrive($conn, $data) {
        $driveStart = date('Y-m-d H:i:s', strtotime($data['Drive_Start']));
        $driveEnd = date('Y-m-d H:i:s', strtotime($data['Drive_End']));
        $mileage = $data['Mileage'];
        $driverID = $data['Driver_ID'];
        $coDriverID = $data['Co_Driver_ID'];
        $route = $data['Route'];
        $shiftID = $data['Shift_ID'];
        $projectID = $data['Project_ID'];
        $vin = $data['VIN'];

        $res = $conn->query("INSERT INTO Drive (StartTime, EndTime, Mileage, DriverID, CoDriverID, DriveRoute, ShiftID, ProjectID, VIN)
        VALUES ('$driveStart', '$driveEnd', $mileage, $driverID, $coDriverID, '$route', $shiftID, $projectID, '$vin');");

        if(!$res) {
            echo 'Error inserting report: ' . $conn->error . "\n";
        }

        return $conn->insert_id;

    }

    function createShift($conn, $data) {
        $shiftType = $data['shift'];
        $startTime = date('Y-m-d H:i:s', strtotime($data['shiftStart']));
        $endTime = date('Y-m-d H:i:s', strtotime($data['shiftEnd']));
        $notes = $data['notes'];

        $res = $conn->query("INSERT INTO Shift (ShiftType, StartTime, EndTime, Comments) 
                            VALUES ('$shiftType', '$startTime', '$endTime', '$notes');");

        if(!$res) {
            echo 'Error inserting shift: ' . $conn->error . "\n";
        }

        return $conn->insert_id;
    }

    function createReport($conn, $data) {
        $issueTime = date('Y-m-d H:i:s', strtotime($data['Issue_Time']));
        $mileage = $data['Mileage'];
        $speed = $data['Speed'];
        $temp = $data['Temperature'];
        $trigger = $data['Trigger'];
        $road = $data['Road_Type'];
        $roadCon = $data['Road_Conditions'];
        $concern = $data['Concern_Level'];
        $comments = $data['Comments'];
        $createdBy = $data['Driver_ID'];
        $driveID = $data['Drive_ID'];

        $res = $conn->query("INSERT INTO Report (IssueTime, Mileage, Speed, Temperature, TriggerValue, RoadType, RoadConditionNotes, CustomerConcernLevel, Comments, CreatedBy, DriveID)
        VALUES ('$issueTime', $mileage, $speed, $temp, '$trigger', '$road', '$roadCon', $concern, '$comments', $createdBy, $driveID);");

        if(!$res) {
            echo 'Error inserting report: ' . $conn->error . "\n";
        }

        return $conn->insert_id;
    }
?>
<?php 
    require 'dbConnect.php';

    function createTables($conn) {
        $errors = [];

        // Employee table schema
        $tableEmployee = "CREATE TABLE IF NOT EXISTS Employee (
            ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            FirstName VARCHAR(30) NOT NULL,
            LastName VARCHAR(30) NOT NULL,
            Email VARCHAR(40) NOT NULL,
            Passcode CHAR(128),
            Designation VARCHAR(30) NOT NULL
        )";

        // Project table schema
        $tableProject = "CREATE TABLE IF NOT EXISTS Project (
            ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ProjectName VARCHAR(30) NOT NULL,
            Designation VARCHAR(30) NOT NULL,
            ManagerID INT(6) UNSIGNED,
            FOREIGN KEY (ManagerID) REFERENCES Employee(ID)
        )";

        // Shift table schema
        $tableShift = "CREATE TABLE IF NOT EXISTS Shift (
            ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ShiftType VARCHAR(10) NOT NULL,
            StartTime DATETIME NOT NULL,
            EndTime DATETIME NOT NULL,
            Comments TEXT
        )";

        // Vehicle table schema
        $tableVehicle = "CREATE TABLE IF NOT EXISTS Vehicle (
            VIN CHAR(17) PRIMARY KEY,
            Make VARCHAR(30) NOT NULL,
            Model VARCHAR(30) NOT NULL,
            Designation VARCHAR(15)
        )";

        // Drive table schema
        $tableDrive = "CREATE TABLE IF NOT EXISTS Drive (
            ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            StartTime DATETIME NOT NULL,
            EndTime DATETIME NOT NULL,
            Mileage DECIMAL(4,2) NOT NULL,
            DriverID INT(6) UNSIGNED,
            CoDriverID INT(6) UNSIGNED,
            DriveRoute VARCHAR(20) NOT NULL,
            OilLevel INT(2),
            ShiftID INT(6) UNSIGNED,
            ProjectID INT(6) UNSIGNED,
            VIN CHAR(17),
            FOREIGN KEY (ShiftID) REFERENCES Shift(ID),
            FOREIGN KEY (DriverID) REFERENCES Employee(ID),
            FOREIGN KEY (CoDriverID) REFERENCES Employee(ID),
            FOREIGN KEY (ProjectID) REFERENCES Project(ID),
            FOREIGN KEY (VIN) REFERENCES Vehicle(VIN)
        )";

        // Report table schema
        $tableReport = "CREATE TABLE IF NOT EXISTS Report (
            ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            IssueTime DATETIME NOT NULL,
            Mileage DECIMAL(4,2) NOT NULL,
            Speed DECIMAL(5,2) NOT NULL,
            TriggerValue VARCHAR(3),
            RoadType VARCHAR(50),
            RoadConditionNotes VARCHAR(100),
            CustomerConcernLevel INT(2) NOT NULL,
            Comments TEXT,
            CreatedBy INT(6) UNSIGNED,
            DriveID INT(6) UNSIGNED,
            FOREIGN KEY (CreatedBy) REFERENCES Employee(ID),
            FOREIGN KEY (DriveID) REFERENCES Drive(ID)
        )";

        $tables = [
            $tableEmployee,
            $tableProject,
            $tableShift,
            $tableVehicle,
            $tableDrive,
            $tableReport,
        ];
        
        // create all the tables in a foreach loop
        foreach($tables as $k => $sql){
            $query = $conn->query($sql);

            if(!$query)
                $errors[] = "Table $k : Creation failed ($conn->error)";
            else
                $errors[] = "Table $k : Creation successful";
        }

        // print the status of each query for table creation
        foreach($errors as $msg) {
            echo "$msg <br>";
        }
        listAllTables($conn);
    }

    function listAllTables($conn) {
        // show all the tables created
        $res = $conn->query("SHOW TABLES");
        $rows = $res->fetch_all();
        echo "================= <br>";
        echo "Database tables: <br>";
        echo "================= <br>";
        foreach($rows as $row){
            echo $row[0] . "<br>";
        }
    }

    function populateEmployeeTable($conn) {
        $sql = "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Daniel', 'Ricciardo', 'dricciardo@amec.com', 'password', 'Driver');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Charles', 'Leclerc', 'cleclerc@amec.com', 'password', 'Driver');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Carlos', 'Sainz', 'csainz@amec.com', 'password', 'Driver');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Lewis', 'Hamilton', 'lhamilton@amec.com', 'password', 'Driver');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Toto', 'Wolff', 'twolff@amec.com', 'password', 'Manager');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Christian', 'Horner', 'chorner@amec.com', 'password', 'Manager');";
        $sql .= "INSERT INTO Employee (FirstName, LastName, Email, Passcode, Designation)
        VALUES ('Guenther', 'Steiner', 'gsteiner@amec.com', 'password', 'Manager');";

        if ($conn->multi_query($sql) === TRUE) {
            echo "New Employee records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    function populateProjectTable($conn) {
        $sql = "INSERT INTO Project (ProjectName, Designation, ManagerID)
        VALUES ('Long Beach McLaren', 'F1', 5);";
        $sql .= "INSERT INTO Project (ProjectName, Designation, ManagerID)
        VALUES ('LA Porsche', 'F2', 6);";
        $sql .= "INSERT INTO Project (ProjectName, Designation, ManagerID)
        VALUES ('San Diego Mercedes', 'F1', 5);";
        $sql .= "INSERT INTO Project (ProjectName, Designation, ManagerID)
        VALUES ('LA Redbull', 'F2', 7);";

        if ($conn->multi_query($sql) === TRUE) {
            echo "New Project records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    function populateShiftTable($conn) {
        $sql = "INSERT INTO Shift (ShiftType, StartTime, EndTime, Comments)
        VALUES ('Morning', '2022-01-15 09:30:00', '2022-01-15 13:30:00', 'My shift notes');";
        $sql .= "INSERT INTO Shift (ShiftType, StartTime, EndTime, Comments)
        VALUES ('Afternoon', '2022-01-15 14:00:00', '2022-01-15 17:00:00', 'My shift notes');";
        $sql .= "INSERT INTO Shift (ShiftType, StartTime, EndTime, Comments)
        VALUES ('Evening', '2022-01-23 18:00:00', '2022-01-23 21:00:00', 'My shift notes');";
        
        if ($conn->multi_query($sql) === TRUE) {
            echo "New Shift records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    function populateVehicleTable($conn) {
        $sql = "INSERT INTO Vehicle (VIN, Make, Model, Designation)
        VALUES ('5NPEC4ABXDH539433', 'Hyundai', 'Sonata', 'Sedan');";
        $sql .= "INSERT INTO Vehicle (VIN, Make, Model, Designation)
        VALUES ('1FVACWCT67HY22127', 'Freightliner', 'M2', 'Truck');";
        $sql .= "INSERT INTO Vehicle (VIN, Make, Model, Designation)
        VALUES ('3C8FY68B82T297664', 'Chrysler', 'PT Cruiser', 'Compact');";
        
        if ($conn->multi_query($sql) === TRUE) {
            echo "New Vehicle records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    function populateDriveTable($conn) {
        $sql = "INSERT INTO Drive (StartTime, EndTime, Mileage, DriverID, CoDriverID, DriveRoute, OilLevel, ShiftID, ProjectID, VIN)
        VALUES ('2022-01-15 10:30:00', '2022-01-15 11:00:00', 25, 2, 3, 'Route1', 8, 1, 3, '5NPEC4ABXDH539433');";
        $sql .= "INSERT INTO Drive (StartTime, EndTime, Mileage, DriverID, CoDriverID, DriveRoute, OilLevel, ShiftID, ProjectID, VIN)
        VALUES ('2022-01-15 15:15:00', '2022-01-15 16:00:00', 30, 1, 4, 'Route66', 10, 2, 1, '1FVACWCT67HY22127');";
        
        if ($conn->multi_query($sql) === TRUE) {
            echo "New Drive records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    function populateReportTable($conn) {
        $sql = "INSERT INTO Report (IssueTime, Mileage, Speed, TriggerValue, RoadType, RoadConditionNotes, CustomerConcernLevel, Comments, CreatedBy, DriveID)
        VALUES ('2022-01-15 11:15:00', 25, 98.55, 'No', 'Freeway', 'Dry and hot', 6, 'Tires worn out very easily. Additional comments here.', 2, 1);";
        $sql .= "INSERT INTO Report (IssueTime, Mileage, Speed, TriggerValue, RoadType, RoadConditionNotes, CustomerConcernLevel, Comments, CreatedBy, DriveID)
        VALUES ('2022-01-15 16:15:00', 30, 80, 'Yes', 'Expressway', 'Dry and hot', 1, 'Great drive by Daniel and Lewis! Gotta love the LA weather!', 1, 2);";
        
        if ($conn->multi_query($sql) === TRUE) {
            echo "New Report records created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

    createTables($conn);
    populateEmployeeTable($conn);
    populateProjectTable($conn);
    populateShiftTable($conn);
    populateVehicleTable($conn);
    populateDriveTable($conn);
    populateReportTable($conn);
?>
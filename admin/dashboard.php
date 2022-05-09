<?php 
    session_start();
    require '../dbManage.php';
    if ($_SESSION) {
        $email = $_SESSION['Email'];
        $name = getEmployeeNameFromEmail($conn, $email);
        $_SESSION['Employee_Name'] = $name;
        $reports = getAllReports($conn);
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-md-8">
                <div class="text-center p-4"><h2 class="fw-bold">Reports - Live Feed</h2></div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Trigger Value</th>
                            <th scope="col">Road Type</th>
                            <th scope="col">Road Condition</th>
                            <th scope="col">Customer Concern</th>
                            <th scope="col">Full Notes</th>
                            <th scope="col">Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($reports as $r) {
                                echo "<tr>";
                                echo "<td>".$r['ID']."</td>";                   // ID
                                echo "<td>".$r['Issue_Time']."</td>";           // Created At or Issue Time
                                echo "<td>".$r['Trigger']."</td>";              // Trigger
                                echo "<td>".$r['Road_Type']."</td>";            // Road Type
                                echo "<td>".$r['Road_Conditions']."</td>";      // Road Condition
                                echo "<td>".$r['Customer_Concern']."</td>";     // Customer Concern Level
                                echo "<td>".$r['Comments']."</td>";             // Comments
                                echo "<td>".$r['Created_By']."</td>";           // Created By
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
</html>
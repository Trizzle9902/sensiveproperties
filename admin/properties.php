<?php 

include('../connect.php');
include ('session.php');
$properties = mysqli_query($dbconnect,"select * from properties" );
$number = 1;

if(isset($_POST['delete'])){
    $id=$_GET['id'];
    $msg = '';
    $error = '';

    $delete= mysqli_query($dbconnect,"DELETE FROM `properties` WHERE `id`=$id");
    if($delete){
        global $msg;
        $msg .= "Property deleted successfully";
    }else{
        global $error;
        $error .= "Unable to delete property. Try Again";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        .dataTable {
        display: block;
        width: 100%;
        margin: 1em 0;
        }

        .dataTable thead, .dataTable tbody, .dataTable thead tr, .dataTable th {
        display: block;
        }

        .dataTable thead {
        float: left;
        }

        .dataTable tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
        }

        .dataTable td, .dataTable th {
        padding: .625em;
        line-height: 1.5em;
        border-bottom: none;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        }

        .dataTable th {
        text-align: left;
        background: rgba(0, 0, 0, 0.14);
        border-bottom: none;
        }

        .dataTable tbody tr {
        display: table-cell;
        }

        .dataTable tbody td {
        display: block;
        }

        .dataTable tr:nth-child(odd) {
            background: rgba(0, 0, 0, 0.07);
        }

        @media screen and (min-width: 50em) {

        .dataTable {
            display: table;
        }
        
        .dataTable thead {
            display: table-header-group;
            float: none;
        }
        
        .dataTable tbody {
            display: table-row-group;
        }
        
        .dataTable thead tr, .dataTable tbody tr {
            display: table-row;
        }
        
        .dataTable th, .dataTable tbody td {
            display: table-cell;
        }
        
        .dataTable td, .dataTable th {
            width: auto;
        }
        
        }

    </style>
    <style>
        a:link, a:visited {
        text-decoration: none;
        }
    </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Sensive Homes</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            >
            <ul class="navbar-nav ml-auto ml-md-12">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a>
                            
                            <a class="nav-link" href="subscribers.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                subscribers
                            </a>
                            <a class="nav-link" href="properties.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-university"></i></div>
                                Properties
                            </a>

                            <a class="nav-link" href="news.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                                News
                            </a>

                            <a class="nav-link" href="queries.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                                Enquiry
                            </a>
                            
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <br>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Properties</li>
                            <ul class="navbar-nav ml-auto ml-md-12">
                                <li class="nav-item ">
                                    <a  href="addproperty.php" role="button"  ><i class="fas fa-plus"></i> Add</a>
                                </li>
                            </ul>
                        </ol>
                        <div class="container-fluid">
                        <?php 
                            if (!empty($error)){ ?>
                            <div class="alert alert-danger alert-dismissible col-md-12">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error!</strong> <?php  echo $error  ?>
                            </div>
                        <?php } ?>
                        <?php 
                            if (!empty($msg)){ ?>
                            <div class="alert alert-success alert-dismissible col-md-12">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>success!</strong> <?php  echo $msg  ?>
                            </div>
                        <?php } ?>
                            <table class="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>category</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Date added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($property=mysqli_fetch_assoc($properties)) { ?>
                                    <tr>
                                        <td><?php echo $number ?></td>
                                        <td><?php echo $property['title'] ?></td>
                                        <td><?php echo $property['category'] ?></td>
                                        <td><?php echo $property['location'] ?></td>
                                        <td><?php echo $property['price'] ?></td>
                                        <td><?php echo date("dS M Y  ", strtotime($property['added_on']));; ?></td>
                                        <td>
                                            <a href="editproperty.php?id=<?php echo $property['id'] ?>"><i class="far fa-edit" style="font-size:24px;margin-right:15px;"></i></a> 
                                            <a href="#"><i class="fas fa-trash-alt"  style="font-size:24px;"></i></a> 
                                        </td>
                                    </tr>
                                <?php 
                                    $number++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
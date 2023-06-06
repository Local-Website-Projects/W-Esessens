<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (!isset($_SESSION['userid'])) {
    header("Location: Login");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pending Order | Wayshk Admin</title>
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <?php include 'include/css.php'; ?>
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <?php include 'include/header.php'; ?>

    <?php include 'include/nav.php'; ?>

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <!-- Add Order -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zip Code</th>
                                    <th>Note</th>
                                    <th>Payment Type</th>
                                    <th>Shipping Method</th>
                                    <th>Total (HKD)</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $bill_data = $db_handle->runQuery("SELECT * FROM billing_details where approve = '1' order by id desc");
                                $row_count = $db_handle->numRows("SELECT * FROM billing_details where approve = '1' order by id desc");

                                for ($i = 0; $i < $row_count; $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo '#WHK'.$bill_data[$i]['id']; ?></td>
                                        <td><?php echo $bill_data[$i]["f_name"] . ' ' . $bill_data[$i]["l_name"]; ?></td>
                                        <td><?php echo $bill_data[$i]["email"]; ?></td>
                                        <td><?php echo $bill_data[$i]["phone"]; ?></td>
                                        <td><?php echo $bill_data[$i]["address"]; ?></td>
                                        <td><?php echo $bill_data[$i]["city"]; ?></td>
                                        <td><?php echo $bill_data[$i]["zip_code"]; ?></td>
                                        <td><?php echo $bill_data[$i]["note"]; ?></td>
                                        <td><?php echo $bill_data[$i]["payment_type"]; ?></td>
                                        <td><?php echo $bill_data[$i]["shipping_method"]; ?></td>
                                        <td><?php echo $bill_data[$i]["total_purchase"]; ?></td>
                                        <td>Delivered</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="Order-Details?id=<?php echo $bill_data[$i]["id"]; ?>"
                                                   class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <?php include 'include/footer.php'; ?>

</div>
<!--**********************************
    Main wrapper end
***********************************-->

<?php include 'include/js.php'; ?>
<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>
</body>
</html>

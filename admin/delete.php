<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();

if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='Login';
                </script>";
}

if (isset($_GET['catId'])) {
    $row = $db_handle->numRows("select * FROM `product` WHERE category_id='{$_GET['catId']}'");

    if ($row == 0) {
        $data = $db_handle->runQuery("select * FROM `category` WHERE id='{$_GET['catId']}'");
        unlink($data[0]['image']);
        $db_handle->insertQuery("delete from category where id=" . $_GET['catId'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}

if(isset($_GET['productId'])){
    $db_handle->insertQuery("delete from product where id=" . $_GET['productId'] . "");
    echo 'success';
}


if(isset($_GET['courseId'])){
    $data = $db_handle->runQuery("select * FROM `course` WHERE course_id='{$_GET['courseId']}'");
    unlink($data[0]['course_image']);
    $db_handle->insertQuery("delete from course where course_id=" . $_GET['courseId'] . "");
    echo 'success';
}

if(isset($_GET['promoCodeId'])){
    $db_handle->insertQuery("delete from promo_code where id=" . $_GET['promoCodeId'] . "");
    echo 'success';
}

if(isset($_GET['adminId'])){
    $data = $db_handle->runQuery("select * FROM `admin_login` WHERE id ='{$_GET['adminId']}'");
    unlink($data[0]['image']);
    $db_handle->insertQuery("delete from admin_login where id=" . $_GET['adminId'] . "");
    echo 'success';
}

if(isset($_GET['textBookId'])){
    $data = $db_handle->runQuery("select * FROM `textbook` WHERE id ='{$_GET['textBookId']}'");
    unlink($data[0]['image']);
    $db_handle->insertQuery("delete from textbook where id=" . $_GET['textBookId'] . "");
    echo 'success';
}

if(isset($_GET['bookId'])){
    $db_handle->insertQuery("delete from book_keeping where bookkeeping_id =" . $_GET['bookId'] . "");
    echo 'success';
}

if(isset($_GET['cashFlowId'])){
    $db_handle->insertQuery("delete from cash_flow where cash_id =" . $_GET['cashFlowId'] . "");
    echo 'success';
}

if(isset($_GET['bankInterestId'])){
    $db_handle->insertQuery("delete from bank_interest where bank_id =" . $_GET['bankInterestId'] . "");
    echo 'success';
}

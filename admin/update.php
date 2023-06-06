<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();

date_default_timezone_set("Asia/Hong_Kong");

if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='Login';
                </script>";
}

if (isset($_POST['updateCategory'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $name = $db_handle->checkValue($_POST['c_name']);
    $name_en = $db_handle->checkValue($_POST['c_name_en']);
    $status = $db_handle->checkValue($_POST['status']);
    $image = '';
    $query = '';
    if (!empty($_FILES['cat_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['cat_image']['name'];
        $file_size = $_FILES['cat_image']['size'];
        $file_tmp = $_FILES['cat_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
            $image = '';
        } else {
            $data = $db_handle->runQuery("select * FROM `category` WHERE id='{$id}'");
            unlink($data[0]['image']);
            move_uploaded_file($file_tmp, "assets/cat_img/" . $file_name);
            $image = "assets/cat_img/" . $file_name;
            $query .= ",`image`='" . $image . "'";
        }
    }

    $data = $db_handle->insertQuery("update category set c_name='$name',`c_name_en` = '$name_en', status='$status'" . $query . " where id={$id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Category';
                </script>";


}

if (isset($_POST['updateProduct'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $p_name = $db_handle->checkValue($_POST['p_name']);
    $p_name_en = $db_handle->checkValue($_POST['p_name_en']);
    $product_code = $db_handle->checkValue($_POST['p_code']);
    $product_description = $db_handle->checkValue($_POST['product_description']);
    $product_description_en = $db_handle->checkValue($_POST['product_description_en']);
    $product_category = $db_handle->checkValue($_POST['product_category']);
    $status = $db_handle->checkValue($_POST['status']);
    $today_deal = $db_handle->checkValue($_POST['today_deal']);
    $product_price = $db_handle->checkValue($_POST['product_price']);
    $cost = $db_handle->checkValue($_POST['cost']);
    $product_weight = $db_handle->checkValue($_POST['product_weight']);
    $query = '';

    $updated_at = date("Y-m-d H:i:s");

    if (!empty($_FILES['images']['tmp_name'][0])) {
        // At least one image is selected

        $dataFileName = []; // Array to store the file names

        // Loop through each uploaded image file
        foreach ($_FILES['images']['tmp_name'] as $index => $uploadedFile) {
            $originalFileName = $_FILES['images']['name'][$index];
            // Get the original image size and type
            list($originalWidth, $originalHeight, $imageType) = getimagesize($uploadedFile);

            // Create image resource from uploaded file based on image type
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($uploadedFile);
                    break;
                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($uploadedFile);
                    break;
                case IMAGETYPE_GIF:
                    $image = imagecreatefromgif($uploadedFile);
                    break;
                default:
                    throw new Exception('Unsupported image type.');
            }

            // Resize the image to 250x250 and save it
            $newImage = imagecreatetruecolor(250, 250);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, 250, 250, $originalWidth, $originalHeight);
            $RandomAccountNumber = mt_rand(1, 99999);
            imagejpeg($newImage, 'assets/products_image/250/' . $RandomAccountNumber . '_' . $originalFileName . '.jpg');

            // Resize the image to 650x650 and save it
            $newImage = imagecreatetruecolor(650, 650);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, 650, 650, $originalWidth, $originalHeight);
            $RandomAccountNumber = mt_rand(1, 99999);
            imagejpeg($newImage, 'assets/products_image/650/' . $RandomAccountNumber . '_' . $originalFileName . '.jpg');
            $dataFileName[] = 'assets/products_image/650/' . $RandomAccountNumber . '_' . $originalFileName . '.jpg';

            // Free up memory
            imagedestroy($image);
            imagedestroy($newImage);
        }

        $databaseValue = implode(',', $dataFileName);
        $query .= ",`p_image`='" . $databaseValue . "'";
        $fetch_image = $db_handle->runQuery("select p_image from product WHERE id={$id}");
        $img = explode(',',$fetch_image[0]['p_image']);
        foreach ($img as $i){
            unlink($i);
        }
    }

    $data = $db_handle->insertQuery("UPDATE `product` SET `category_id`='$product_category',`product_code`='$product_code',`p_name`='$p_name',`description`='$product_description',`description_en` = '$product_description_en',
                     `status`='$status',`updated_at`='$updated_at',`product_price`='$product_price',`p_name_en` = '$p_name_en',`cost` = '$cost',`product_weight` = '$product_weight', `deal_today` = '$today_deal'" . $query . " WHERE id={$id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Product';
                </script>";
}



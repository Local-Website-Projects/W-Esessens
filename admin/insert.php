<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");

if (isset($_POST["add_cat"])) {
    $name = $db_handle->checkValue($_POST['cat_name']);
    $name_cn = $db_handle->checkValue($_POST['cat_name_cn']);
    $image = '';
    if (!empty($_FILES['cat_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['cat_image']['name'];
        $file_size = $_FILES['cat_image']['size'];
        $file_tmp  = $_FILES['cat_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
            $attach_files = '';
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Add-Category';
                </script>";

        } else {
            move_uploaded_file($file_tmp, "assets/cat_img/" . $file_name);
            $image = "assets/cat_img/" . $file_name;
        }
    }

    $inserted_at = date("Y-m-d H:i:s");

    $insert = $db_handle->insertQuery("INSERT INTO `category`(`c_name`,`c_name_en`, `image`,  `inserted_at`) VALUES ('$name_cn','$name','$image','$inserted_at')");

    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Add-Category';
                </script>";
}

if (isset($_POST["add_product"])) {
    $product_name = $db_handle->checkValue($_POST['product_name']);
    $product_name_en = $db_handle->checkValue($_POST['product_name_en']);
    $product_code = $db_handle->checkValue($_POST['product_code']);
    $product_weight = $db_handle->checkValue($_POST['product_weight']);
    $product_category = $db_handle->checkValue($_POST['product_category']);
    $selling_price = $db_handle->checkValue($_POST['selling_price']);
    $cost = $db_handle->checkValue($_POST['cost']);
    $product_status = $db_handle->checkValue($_POST['product_status']);
    $today_deal = $db_handle->checkValue($_POST['today_deal']);
    $product_description = $db_handle->checkValue($_POST['product_description']);
    $product_description_en = $db_handle->checkValue($_POST['product_description_en']);
    $inserted_at = date("Y-m-d H:i:s");

    $products_image='';
    $arr = array();
    if (!empty($_FILES['product_image']['tmp_name'][0])) {
        // At least one image is selected

        $dataFileName = []; // Array to store the file names

        // Loop through each uploaded image file
        foreach ($_FILES['product_image']['tmp_name'] as $index => $uploadedFile) {
            $originalFileName = $_FILES['product_image']['name'][$index];
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
            imagejpeg($newImage, 'assets/products_image/250/' . $RandomAccountNumber . '_' . $originalFileName);

            // Resize the image to 650x650 and save it
            $newImage = imagecreatetruecolor(650, 650);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, 650, 650, $originalWidth, $originalHeight);
            imagejpeg($newImage, 'assets/products_image/650/' . $RandomAccountNumber . '_' . $originalFileName);

            $dataFileName[] = 'assets/products_image/650/' . $RandomAccountNumber . '_' . $originalFileName;

            // Free up memory
            imagedestroy($image);
            imagedestroy($newImage);
        }

        $databaseValue = implode(',', $dataFileName);
        $products_image = $databaseValue;
    } else {
        $products_image = '';
    }

    $insert = $db_handle->insertQuery("INSERT INTO `product` (`category_id`, `product_code`,`product_weight`, `p_name`,`p_name_en`,`product_price`, `description`,`description_en`, `p_image`,`status`, `inserted_at`,`cost`,`deal_today`) VALUES 
                ('$product_category','$product_code','$product_weight','$product_name','$product_name_en','$selling_price','$product_description','$product_description_en','$products_image','$product_status','$inserted_at','$cost','$today_deal')");
    if($insert){
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Add-Product';
                </script>";
    }


}

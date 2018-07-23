<?php
require 'vendor/autoload.php';

include 'helper.php';
include 'server.php';
include "vendor/verot/class.upload.php/src/class.upload.php";

// error output setting
ini_set('display_errors', 1);

$handle = new upload($_FILES['image_field']);
$fileInfo = pathinfo($_FILES['image_field']['name']);

// clicked save button
if (isset($_POST['save'])) {

    if ($handle->uploaded) {
        $imageName = uniqid();

        //  name the file with uniqu ID and file extension
        $handle->file_new_name_body = $imageName;

        $handle->image_resize = true;
        $handle->image_x = 100;
        $handle->image_ratio_y = true;
        $handle->process('images');

        if ($handle->processed) {

            $description = $_POST['description'];

            //  insert data into database
            $database->insert('items', [
                'image' => $imageName . '.' . $fileInfo['extension'],
                'description' => $description,
            ]);

            $handle->clean();

            header('Location: index.php');

        } else {
            echo 'error : ' . $handle->error;
        }
    } else {
        echo 'something went wrong';
    }
}

<?php
include 'server.php';
include 'helper.php';

$image_dir = 'images/';

if (isset($_GET['del'])) {
    // delete button is clicked

    $id = $_GET['del'];

    // get image file name form database using item's ID
    $fileName = $database->get('items', 'image',
        [
            'id' => $id,
        ]);

    // check if the file exists
    if (file_exists($image_dir . $fileName)) {
        //  delete the image file
        unlink($image_dir . $fileName);
    }

    // delete item
    $database->delete("items", [
        'id' => $id,
    ]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <title>upload test</title>
</head>
<body>
<div class="container">
<h1>Image upload test</h1>

<form method="post" action="upload.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" class="form-control" name="image_field"/>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" placeholder="description" name="description"></textarea>
  </div>

  <button type="submit" name='save' class="btn btn-primary">Save</button>

</form>

<div class="d-flex justify-content-around">
<?php foreach ($items as $item) {?>


<div class="card mt-5" style="width: 200px; height:250px;">
  <img class="card-img-top" src=<?php echo $image_dir . $item['image'] ?>
    alt="Card image cap">
  <div class="card-body">
    <p class="card-text"><?php echo $item['description'] ?></p>
  </div>
  <a class="btn btn-danger" href="index.php?del=<?php echo $item['id'] ?>" style="width: 100px;">Delete</a>
</div>


<?php }?>
</div>
</div>
</body>
</html>

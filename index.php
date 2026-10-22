<?php
include_once "./function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
                                if (isset($_POST["upload"])) {
                                    $file = $_FILES["fileUpload"];

                                    $allowed = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif'];
                                    $validUpload = isset($file['error']) && $file['error'] === UPLOAD_ERR_OK
                                        && is_uploaded_file($file['tmp_name'])
                                        && $file['size'] > 0 && $file['size'] <= 5 * 1024 * 1024;
                                    $imageType = $validUpload ? @exif_imagetype($file['tmp_name']) : false;
                                    if ($validUpload && isset($allowed[$imageType])) {
                                        $file_name = bin2hex(random_bytes(16)) . '.' . $allowed[$imageType];
                                        $destination = __DIR__ . '/image/' . $file_name;
                                        if (!is_dir(__DIR__ . '/image') || !move_uploaded_file($file['tmp_name'], $destination)) {
                                            $msg = '<p class="alert alert-danger">Upload failed.</p>';
                                        }
                                    } else {
                                        $msg = '<p class="alert alert-danger">Invalid image or file exceeds 5 MB.</p>';
                                    }

                                    
                                }
                                ?>

    <div class="form-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 mt-5">
                
                    <div class="form-container">
                        <h3 class="title">Image Upload</h3>
                        
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="file-content">
                                <input type="file" id="uploadImage" name="fileUpload">
                                <label for="uploadImage"><i class="form-icon fa fa-cloud-upload"></i></label>
                                <div class="preview">
                                    <img id="preview_photo" class="shadow" src="" alt="">
                                </div>
                                <?php echo $msg ?? ''; ?>
                                <button type="submit" name="upload" class="btn btn-default my-4">Upload</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $('#uploadImage').change(function(e) {
            $('.preview').show();
            let file = URL.createObjectURL(e.target.files[0]);
            $('#preview_photo').attr('src', file);
        });
    </script>
</body>

</html>
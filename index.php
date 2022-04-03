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

                                    $file_name = time() . "_" . rand() . "_" . $file["name"];
                                    $file_tmp_name = $file["tmp_name"];
                                    $file_type = $file["type"];
                                    $file_size = $file["size"];

                                    if ($file_type=='image/jpeg' || $file_type=='image/jpg' || $file_type=='image/png' || $file_type=='image/gif') {
                                        move_uploaded_file($file_tmp_name, "image/" . $file_name);
                                    }
                                    else{
                                        $msg="<p class=\"alert alert-danger\">Invalid Image Format</p>";
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
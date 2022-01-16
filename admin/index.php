<?php
    require_once('../database/requetes.php');

    if (!empty($_POST) && !empty($_POST['submit'])) {
        extract($_POST);
        $error = '';
        $image_target_dir = "../img/";
        $image_target_file = $image_target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($image_target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($image_target_file)) {
          $error .= "Ce fichier existe déjà.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
          $error .="<br>Seul les fichiers jpg, png, gif et jpeg sont autorisés";
          $uploadOk = 0;
        }

        $target_dir = "../video/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
          $error .= "Ce fichier existe déjà.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($fileType != "mp4" && $fileType != "webm" && $fileType != "avi") {
          $error .="<br>Seul les fichiers mp4, webm et avi sont autorisés";
          $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
           $error .= "<br>Désolé fichiers non téléchargé";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["image"]["tmp_name"], $image_target_file)) {
            $success = "Le fichier ". htmlspecialchars( basename( $_FILES["video"]["name"])). " a été enregistré.";
            $path = "video/".basename($_FILES["video"]["name"]);
            $image = "img/".basename($_FILES["image"]["name"]);
            insertVideo($title, $description, $path, $image);

            header("location: /admin/");
          } else {
           $error .= "Désolé fichiers non enregistrer";
          }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Catalog</title>
    
    <?php require("../link.html"); ?>
<!--

TemplateMo 552 Video Catalog

https://templatemo.com/tm-552-video-catalog

-->
<style type="text/css">
    .form-control{
        padding: 0 !important;
    }

    .file{
        padding-top: 3px !important;
    }

    main{
        flex-direction: column;
        align-items: center;
    }
</style>
</head>

<body>
    <?php require("../nav.html"); ?>
    

    <div class="tm-page-wrap mx-auto">
        <div class="container-fluid">
            <div id="content" class="mx-auto tm-content-container">
                <main class="d-flex  justify-content-center">
                    <div class="w-75">
                        <?php if ( isset($error) && !empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                              <?= $error ?>
                            </div>
                        <?php endif ?>
                        <?php if ( isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                              <?= $success ?>
                            </div>
                        <?php endif ?>
                    </div>
                    
                    <div class="card" style="width: 75%;">
                      <div class="card-body">
                        <h5 class="card-title">Insérer des vidéos</h5>
                        <form method="post" action="" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titre de la vidéo<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="title" aria-describedby="emailHelp" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description de la vidéo</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                          </div>
                          <div class="mb-3">
                              <label for="formFile" class="form-label">Image de présentation<span style="color: red">*</span></label>
                              <input class="form-control file" type="file" name="image" id="formFile" required>
                            </div>
                          <div class="mb-3">
                              <label for="formFile" class="form-label">Vidéo<span style="color: red">*</span></label>
                              <input class="form-control file" type="file" name="video" id="formFile" required>
                            </div>
                          <input type="submit" name="submit" class="btn btn-primary" value="Envoyer" />
                        </form>
                      </div>
                    </div>
                </main>
            </div> <!-- tm-content-container -->
        </div>
    </div> <!-- .tm-page-wrap -->

    <?php require("../footer.html"); ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/check-auth.js"></script>
    
</body>

</html>
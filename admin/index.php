<?php
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
</style>
</head>

<body>
    <?php require("../nav.html"); ?>
    

    <div class="tm-page-wrap mx-auto">
        <div class="container-fluid">
            <div id="content" class="mx-auto tm-content-container">
                <main class="d-flex justify-content-center">
                    <div class="card" style="width: 75%;">
                      <div class="card-body">
                        <h5 class="card-title">Insérer des vidéos</h5>
                        <form method="post" action="">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titre de la vidéo<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="title" aria-describedby="emailHelp" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description de la vidéo</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                          </div>
                          <div class="mb-3">
                              <label for="formFile" class="form-label">Vidéo<span style="color: red">*</span></label>
                              <input class="form-control file" type="file" name="video" id="formFile" required>
                            </div>
                          <button type="submit" class="btn btn-primary">Enregistrer la vidéo</button>
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
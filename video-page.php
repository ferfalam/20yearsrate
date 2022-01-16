<?php

	extract($_GET);
	$videoId = strip_tags($videoId); // recuperation de l'id de la video par $get depuis l'index
	require_once('database/requetes.php');

	$video = getVideo($videoId); // get current video
	$videoNotes = getVideoNotes($videoId); // recuperations de toutes les notes d'une video
	$videoNotesAVG = getVideoNotesAVG($videoId); // get rate average
	$rate = intval($videoNotesAVG[0]->rate);

	if (!empty($_POST)) {
		extract($_POST);

		if ((!empty($note)) and (searchNotes($videoId, getIp()) == null)) { 
		// annuler la possibilité que l'utilisateur ait deje voté pour la video
			$videoNote = insertNote(getIp(), $note, $videoId);
			header("Location: /video-page.php?videoId=".$videoId);
		}
	}

	//fonction de recuperation de l'ip utilisateur 
	function getIp(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		  $ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
		  $ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Catalog</title>

    
    <?php require("./link.html"); ?>
</head>
<!--

TemplateMo 552 Video Catalog

https://templatemo.com/tm-552-video-catalog

-->
<body>
	<?php require('./nav.html'); ?>
	<div class="tm-page-wrap mx-auto">
		<!-- Page content -->
		<div class="container-fluid">
			<div class="mx-auto tm-content-container">
				<main>
					<div class="row mb-5 pb-4">
						<div class="col-12">
							<!-- Video player 1422x800 -->
							<video width="1422" height="800" controls autoplay>
							  <source src="<?= $video[0]->path ?>" type="video/mp4">							  
							Your browser does not support the video tag.
							</video>
						</div>
					</div>
					<div class="row mb-5 pb-5">
						<div class="col-xl-8 col-lg-7">
							<!-- Video description -->
							<div class="tm-video-description-box">
								<h2 class="mb-5 tm-video-title"><?= $video[0]->title ?></h2>
								<p class="mb-4"><?= $video[0]->description ?></p>	
							</div>							
						</div>
						<div class="col-xl-4 col-lg-5">
							<!-- Share box -->
							<div class="tm-bg-gray tm-share-box">
								<h4 class="tm-share-box-title mb-4">Note actuel : </h4>
								<div class="mb-5 d-flex align-items-baseline">
	                                <div class="rate f-right mr-4">
	                                	<?php for ( $i=1; $i<=10; $i++): ?>
	                                		<?php if ($rate > $i): ?>
	                                    		<span class="fa fa-star checked"></span>
	                                    		<?php $i++; ?>
	                                		<?php elseif ($rate == $i): ?>
	                                    		<span class="fa fa-star-half-alt checked"></span>
	                                    		<?php $i++; ?>
	                                    	<?php else : ?>
	                                    		<span class="far fa-star checked"></span>
	                                    		<?php $i++; ?>
	                                		<?php endif?>
	                                	<?php endfor ?>
	                                </div>
	                                <span class="h6"><?= count($videoNotes) ?> participant(s)</span>
								</div>
								<form action="" method="post">
									<h4 class="mb-4"> Notez le travail : </h4>
									<input name="note" type="number" min="1" max="10" class="tm-bg-white px-5 mb-4 d-inline-block tm-text-primary tm-likes-box tm-liked"/>
									<div>
										<button name="submit" class="btn btn-primary p-0 tm-btn-animate tm-btn-download tm-icon-submit"><span>Valider la note</span></button>	
									</div>	
								</form>								
							</div>
						</div>
					</div>
				</main>
			</div> <!-- .tm-content-container -->
		</div>
	</div>

    <?php require("./footer.html"); ?>

	<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$(document).ready(function() {
    		$('.tm-likes-box').click(function(e) {
    			e.preventDefault();
    			$(this).toggleClass('tm-liked');

    			if($(this).hasClass('tm-liked')) {
    				$('#tm-likes-count').html('486 likes');
    			} else {
    				$('#tm-likes-count').html('485 likes');
    			}
    		});
    	});
    </script>
</body>
</html>
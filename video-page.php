<?php

	extract($_GET);
	$videoId = strip_tags($videoId); // recuperation de l'id de la video par $get depuis l'index
	require_once('database/requetes.php');

	$videoNotes = getVideoNotes($videoId); // recuperations de toutes les notes d'une video

	if (!empty($_POST)) {
		extract($_POST);

		if ((!empty($note)) and (searchNotes($videoId, getIp()) == null)) { 
		// annuler la possibilité que l'utilisateur ait deje voté pour la video
			$videoNote = insertNote(getIp(), $note, $videoId);
			$videoNotes = getVideoNotes($videoId);
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
							  <source src="video/wheat-field.mp4" type="video/mp4">							  
							Your browser does not support the video tag.
							</video>
						</div>
					</div>
					<div class="row mb-5 pb-5">
						<div class="col-xl-8 col-lg-7">
							<!-- Video description -->
							<div class="tm-video-description-box">
								<h2 class="mb-5 tm-video-title">Mauris dapibus urna nec ipsum posuere</h2>
								<p class="mb-4">Cras dictum pretium est, et imperdiet ex. Fusce vitae vestibulum ipsum. Maecenas ultricies ipsum a urna ullamcorper, id interdum est blandit. Vivamus sit amet justo sed erat iaculis consequat. Nulla suscipit posuere lectus ut venenatis. Proin sed orci eget tellus euismod vulputate eu eu arcu.</p>
								<p class="mb-4">Etiam a bibendum lorem. Curabitur ac bibendum odio. Vivamus euismod dui mauris, ut tincidunt mi congue quis. Phasellus luctus orci dolor, a luctus massa tincidunt vitae. Integer sit amet odio id libero tincidunt dignissim in eget arcu.</p>
								<p class="mb-4">Aliquam tristique ut magna sit amet tincidunt. Sed tempor tellus nulla, molestie luctus lectus tincidunt id. Cras euismod leo a urna placerat, vel blandit turpis fermentum.</p>	
							</div>							
						</div>
						<div class="col-xl-4 col-lg-5">
							<!-- Share box -->
							<div class="tm-bg-gray tm-share-box">
								<h4 class="tm-share-box-title mb-4">Note actuel : </h4>
								<div class="mb-5 d-flex align-items-baseline">
	                                <div class="rate f-right mr-4">
	                                    <span class="fa fa-star checked"></span>
	                                    <span class="fa fa-star checked"></span>
	                                    <span class="fa fa-star checked"></span>
	                                    <span class="fa fa-star"></span>
	                                    <span class="fa fa-star"></span>
	                                </div>
	                                <span class="h4"><?= count($videoNotes) ?></span>
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
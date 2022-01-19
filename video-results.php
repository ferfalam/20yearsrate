<?php

	extract($_GET);
	$videoId = strip_tags($videoId); // recuperation de l'id de la video par $get depuis l'index
	require_once('database/requetes.php');

	$videoNotes = getVideoNotes($videoId); // recuperations de toutes les notes d'une video
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Catalog</title>

    
    <?php require("./link.html"); ?>
    <style>
        table, th, td {
        border:1px solid black;
}
</style>
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
					<div class="row mb-5 pb-5">
                        <h2>Statistiques</h2>
                        <?php if (count($videoNotes) == 0) { ?>
                            <h3>Pas de votes</h3>
                        <?php } else {?>
                        <table style="width:100%"> 
                            <tr>
                                <th>Adresse IP du votant</th>
                                <th>Note</th>
                                <th>Heure de vote</th>
                            </tr>
                            <?php foreach ($videoNotes as $videoNote): ?>
                            <tr>
                                <td><?= $videoNote->voterIP ?></td>
                                <td><?= $videoNote->note ?></td>
                                <td><?= $videoNote->voteDate ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php }?>
					</div>
				</main>
			</div> <!-- .tm-content-container -->
		</div>
	</div>

</body>
</html>
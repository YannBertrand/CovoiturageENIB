<?php include_once('includes/header.php'); ?>

<div id="content">
	<?php include_once('menu.php'); //menu de gauche ?>
	<?php include_once('includes/menu.php'); //menu de droite ?>
	
	<div id="middle">
		<?php if(count($news) > 0) { ?>
		<?php 	foreach($news as $new) { ?>
			<div class="news">
				<div class="newsheader">
					<h1><?php echo $new['title']; ?></h1>
					<div class="date_news">
						<p>
							Le <em><?php echo $new['day']; ?></em> à <em><?php echo $new['hour']; ?></em>
						</p>
					</div>
				</div>
				<div class="newscontent" >
					<p><?php echo $new['message']; ?></p>
				</div>
				<div class="newsfooter" ></div>
			</div>
		<?php 	} ?>
		<?php } else { ?>
			<div class="newsheader"><h1>Pas de news</h1></div>
			<div class="newscontent">
				<p>Il n'y a aucune nouvelles news pour le moment.</p>
			</div>
			<div class="newsfooter"></div>
		<?php } ?>
			<div class="page_link">
			<span class="prev"><?php  if ($pageact != 1){ ?><a href="?goto=<?php echo ($pageact-1); ?>">Page précédente</a><?php  } else {echo "Page précédente";} ?></span>
			<span class="next"><?php  if ($nb_total > ($max * $pageact)){ ?> <a href="?goto=<?php echo ($pageact+1); ?>">Page suivante</a><?php } else {echo "Page suivante";} ?></span>
		</div>
	</div>
</div>

<?php include_once('includes/footer.php'); ?>

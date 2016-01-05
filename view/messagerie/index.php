<?php include_once('view/includes/header.php'); ?>

<div id="content">
	<?php include_once('menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post" style="width:100%; margin: auto;">
			<div class="postheader"><h1>Voir ses messages</h1></div>
			<div class="postcontent">
				<?php if(count($messages) > 0) { ?>
				<?php 	foreach($messages as $message) { ?>
				<div class="post" >
					<div class="postheader">
						<h1><?php echo $message['title']; ?></h1>
					</div>
					<div class="postcontent" style="background:white">
						<p><?php echo $message['message']; ?></p>
						<p>
							De <em><?php echo $message['sender']; ?></em>
							à <em><?php echo $message['receiver']; ?></em>
							le <em><?php echo $message['date']; ?></em>
							à <em><?php echo $message['hour']; ?></em>
						</p>
					</div>
					<div class="postfooter" style="background:white"></div>
				</div>
				<?php 	} ?>
				<?php } else { ?>
					<p>Vous n'avez pas de messages.</p>
				<?php } ?>
				<div class="page_link">
					<span class="prev"><?php  if ($pageact != 1){ ?><a href="/covoiturage-yann/?page=messagerie&goto=<?php echo ($pageact-1); ?>">Page précédente</a><?php  } else {echo "Page précédente";} ?></span>
					<span class="next"><?php  if ($nb_total >  ($max * $pageact)){ ?> <a href="/covoiturage-yann/?page=messagerie&goto=<?php echo ($pageact+1); ?>">Page suivante</a><?php } else {echo "Page suivante";} ?></span>
				</div>
			</div>
			<div class="postfooter"></div>
		 </div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>

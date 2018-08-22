<?php if (relation_link_to_display($_GET['pseudo']) == ACCEPT_REJECT_RELATION_LINK): ?>

	<div class="btn-group">

		<a href="accept_friend.php?pseudo=<?php echo $_GET['pseudo']; ?>" class="btn btn-success"><i class="icon-ok"></i> Accepter</a> 

		<a href="delete_friend.php?pseudo=<?php echo $_GET['pseudo']; ?>" class="btn btn-danger"><i class="icon-ban-circle"></i> Decliner</a>
		
	</div>

<?php elseif (relation_link_to_display($_GET['pseudo']) == CANCEL_RELATION_LINK): ?>

	<a href="delete_friend.php?pseudo=<?php echo $_GET['pseudo']; ?>" class="btn btn-info"><i class="icon-ban-circle"></i> Annuler la demande</a>

<?php elseif (relation_link_to_display($_GET['pseudo']) == DELETE_RELATION_LINK): ?>

	<a href="delete_friend.php?pseudo=<?php echo $_GET['pseudo']; ?>" class="btn btn-danger"><i class="icon-ban-circle"></i> Retirer de ma liste d'amis</a>

<?php elseif (relation_link_to_display($_GET['pseudo']) == ADD_RELATION_LINK): ?>

	<a href="add_friend.php?pseudo=<?php echo $_GET['pseudo']; ?>" class="btn btn-primary"><i class="icon-plus-sign"></i> Ajouter comme ami</a>

<?php endif ?>
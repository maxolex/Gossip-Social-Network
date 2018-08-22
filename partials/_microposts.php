<article class="media status-media" id="micropost<?php echo $micropost->m_id ?>">
    <div>
        <a href="profile.php?pseudo=<?php echo $micropost->pseudo ?>"><img style="max-width: 15%;" src="<?php echo get_avatar($micropost->email); ?>" alt="<?php echo e($micropost->pseudo); ?>" class="media-object"/></a>
    </div>
    <div class="media-body">
        <a href="profile.php?pseudo=<?php echo $micropost->pseudo ?>"><h4 class="media-heading"><?php echo e($micropost->pseudo); ?></h4></a>
        <p><i class="icon-time"></i> <span class="timeago" title="<?php echo $micropost->created_at; ?>"><?php echo $micropost->created_at; ?></span>
        	<?php if (!empty($micropost->pseudo) && $micropost->pseudo == get_session('pseudo')) :?>
        		<a data-confirm="Voulez-vous vraiment supprimer cette publication ?" href="delete_micropost.php?id=<?php echo $micropost->m_id; ?>"><i class="icon-trash"></i> Supprimer</a>
        	<?php endif; ?>
        </p>
        <pre><?php echo e($micropost->content); ?></pre>

        <hr>

        <p>
            <?php if(user_has_already_liked_the_micropost($micropost->m_id)): ?>
                <a id="unlike<?php echo $micropost->m_id; ?>" data-action="unlike" class="like" href="unlike_micropost.php?id=<?php echo $micropost->m_id; ?>"><i class="icon-thumbs-down"></i> Je n'aime plus</a>
            <?php else: ?>
                 <a id="like<?php echo $micropost->m_id; ?>" data-action="like"  class="like" href="like_micropost.php?id=<?php echo $micropost->m_id; ?>"><i class="icon-thumbs-up"></i> J'aime</a>
            <?php endif; ?>
        </p>

        <div id="likers_<?php echo $micropost->m_id; ?>">

            <?php echo get_likers_text($micropost->m_id); ?>

        </div>

    </div>
</article>
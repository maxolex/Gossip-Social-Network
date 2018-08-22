<a href="profile.php?pseudo=<?php echo $notification->pseudo ?>">

<img style="max-width: 8%;" src="<?php echo get_avatar($notification->email); ?>" alt="<?php echo e($notification->pseudo); ?>"/>
<?php echo e($notification->pseudo) ?>
</a>
a accepté votre demande d'amitié <span class="timeago" title="<?php echo $notification->created_at ?>"><?php echo $notification->created_at ?></span>.
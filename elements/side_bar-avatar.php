<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php require 'route.php'; ?>

<?php
    $userData = getUserLogData(AUTH_ID);
    $profileImageUrl = $userData['profileImageUrl'];
    $user = $userData['userData'];
?>

<div class="image" style="margin-top: 2%; margin-left: -4%;">
    <img src="<?php echo $profileImageUrl; ?>" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
    <a href="<?= $profile_link ?>" class="d-block"><?php echo $user->fname ?> <?php echo $user->lname ?></a>
    <a href="<?= $profile_link ?>" style="font-size: 10pt">
        <i class="fa fa-circle text-success" style="font-size: 8pt"></i> <?php echo $user->usertype ?>
    </a>
</div>
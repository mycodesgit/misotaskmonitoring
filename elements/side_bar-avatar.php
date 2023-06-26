<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php require 'route.php'; ?>
<?php
    $userId = $_SESSION[AUTH_ID];

    $userQuery = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $userQuery->bind_param("i", $userId);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_object();
        
        if ($userData->profile_image !== null) {
            $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/img/profile/" . $userData->profile_image;
        } else {
            $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/adminLTE-3/img/user.png";
        }
    } else {
        $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/adminLTE-3/img/user.png";
    }
?>

<div class="image" style="margin-top: 2%; margin-left: -4%;">
    <img src="<?php echo $profileImageUrl; ?>" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
    <?php
        $stmt = $DB->prepare("SELECT * FROM users where id=?");
        $stmt->bind_param("i", $_SESSION[AUTH_ID]);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
    ?>
    <a href="<?= $profile_link ?>" class="d-block"><?php echo $user->fname ?> <?php echo $user->lname ?></a>
    <a href="<?= $profile_link ?>" style="font-size: 10pt">
        <i class="fa fa-circle text-success" style="font-size: 8pt"></i> <?php echo $user->usertype ?>
    </a>
</div>
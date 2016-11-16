<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
if (isset($_SESSION['id']) === true) {
    $username = $user_data['username'];
    ?>

    <li>
        <?php
        //for user thumbnail: include wi_user_thumbnail.php
        ?>
        <div class="user_logged_in_dropdown">
            <button class="user_logged_in_dropbtn">
                <?php echo $user_data['username']; ?>
            </button>
            <div class="user_logged_in_dropdown-content">
                <a href="<?php echo $config['file']['profile'] . '?username=' . $username ?>">Profile</a>
                <a href="<?php echo $config['file']['change_password'] ?>">Change Password</a>
                <a href="<?php echo $config['file']['settings'] ?>">Settings</a>
                <?php
                if (Role::is_band()) {
                    ?>
                    <a href="<?php echo $config['file']['settings_band_members'] ?>">Settings - Band Members</a>
                    <?php
                }
                $exp_option = 'My experience';
                if (Role::is_band()) {
                    $exp_option = 'Our experience';
                }
                ?>
                <hr>
                <?php
                if (Role::is_musician()) {
                    ?>
                    <a href="<?php echo $config['file']['experience_musician_alone'] ?>"><?php echo $exp_option . ' alone'; ?></a>
                    <a href="<?php echo $config['file']['experience_musician_bands'] ?>"><?php echo $exp_option . ' with bands'; ?></a>  
                    <?php
                } else if (Role::is_band()) {
                    ?>
                    <a href="<?php echo $config['file']['experience_band'] ?>"><?php echo $exp_option; ?></a>  
                    <?php
                } else if (Role::is_agent()) {
                    ?>
                    <a href="<?php echo $config['file']['experience_agent'] ?>"><?php echo $exp_option; ?></a>  
                    <?php
                }
                ?>
                <hr>        
                <a href="<?php echo $config['file']['invitations'] ?>">Invitations</a>
                <hr>        
                <a href="<?php echo $config['file']['matches'] ?>">Matches</a>
                <hr>        
                <a href="<?php echo $config['file']['pursuit'] ?>">Pursuit</a>
                <hr>   
                <a href="<?php echo $config['file']['messages'] ?>">Messages</a>
                <hr>
                <?php
                $prof_comp = User::get_profile_completeness() * 100;
                ?>
                <a href="<?php echo $config['file']['profile_completeness'] ?>">Profile Completeness: <?php echo "$prof_comp%"; ?></a>
                <hr>  
                <a href="<?php echo $config['file']['logout'] ?>">Logout</a>
            </div>
        </div>
    </li>
    <?php
} else {
    ?>
    <li><a href="<?php echo $config['url']['register_pre']; ?>">Create a Free Account</a></li>
    <li><a href="<?php echo $config['url']['login'] ?>">Log In</a></li>
    <?php
}



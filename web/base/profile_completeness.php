<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$prof_comp = User::get_profile_completeness() * 100;
$role = User::get_role();
Presentation::print_page_title("Profile Completeness - $prof_comp%");
?>
<ul>
    <li>25% - Register</li>
    <li>25% - <a href="<?php echo $config['file']['settings'] ?>">Settings</a></li>

    <?php
    $exp_option = 'My experience';
    if (Role::is_band()) {
        $exp_option = 'Our experience';
    }
    if (Role::is_musician()) {
        ?>
        <li>25% - 
            <a href="<?php echo $config['file']['experience_musician_alone'] ?>"><?php echo $exp_option . ' alone'; ?></a> 
            or
            <a href="<?php echo $config['file']['experience_musician_bands'] ?>"><?php echo $exp_option . ' with bands'; ?></a>
        </li>
        <?php
    } else if (Role::is_band()) {
        ?>
        <li>25% - <a href="<?php echo $config['file']['experience_band'] ?>"><?php echo $exp_option; ?></a></li>
        <?php
    } else if (Role::is_agent()) {
        ?>
        <li>25% - <a href="<?php echo $config['file']['experience_agent'] ?>"><?php echo $exp_option; ?></a></li>  
        <?php
    }
    ?>

    <li>25% - <a href="<?php echo $config['file']['pursuit'] ?>">Pursuit</a></li>
</ul>

<div class="profile_completeness_question">
    Why is this important?
</div>
<div class="profile_completeness_answer">
    Because the <a href="<?php echo $config['file']['matches'] ?>">matches</a> are based on the information that
    you provide. 
    <br>
    If you provide information on the 4 fields above you'll have higher chances of 
    finding your match.
</div>
<?php
include $config['file']['ov_footer'];

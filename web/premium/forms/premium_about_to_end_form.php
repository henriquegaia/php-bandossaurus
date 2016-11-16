<div class="premium_about_to_end">
    You have revoked your premium account. 
    <br>
    You can still use the advantages until <?php echo User::get_premium_end(); ?>
    <br>
    or
    <br>
    <?php include $config['file']['become_premium_form']; ?>
</div>
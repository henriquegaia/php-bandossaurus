<div class="widget">
    <h2>Users</h2>
    <div class="inner">
        <?php
        $num_users = User::count();
        echo 'We currently have ' . $num_users . ' registered users.'
        ?>

    </div>
</div>
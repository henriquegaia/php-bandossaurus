
<form action="" method="post">
    <ul>
        <?php include $config['file']['input_token_csrf']; ?>
        <li>
            <label for="item">
                Service
            </label>
            <label class="form_predefined_value">
                1 Month Premium Membership
            </label>

        </li>
        <li>
            <label for="number_items">
                Quantity
            </label>
            <label class="form_predefined_value">
                1
            </label>
        </li>
        <li>
            <label for="amount">
                Price (u.s. dollars)
            </label>
            <label class="form_predefined_value">
                <?php echo Premium::FEE_US_DOLLARS; ?>
            </label>
        </li>


        <li>
            <label></label>
            <input type="submit" name="Pay">
        </li>

    </ul>
</form>

<div class="redirect"> 
    You'll be redirected to <b>paypal</b> to start your payment process. 
</div>
<br>
<hr>
<br>
<p>
    <b> To proceed with the checkout, please use one of the following browsers:</b>
    <br>
<ul>
    <li>Internet Explorer version 9 or later</li>
    <li>Chrome version 27 or later</li>
    <li>Firefox version 30 or later</li>
    <li>Safari version 5.1 or later</li>
    <li>Opera version 23 or later</li>
</ul>
</p>


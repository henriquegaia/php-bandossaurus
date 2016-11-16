<?php

class Dummy {
    /*
     * use logged out because pursuit will not be created for current role
     * if logged in
     */

    public static function generate_users() {
        $amount_users = 1;
//        User::generate_multiple($amount_users, 'musician');
//        User::generate_multiple($amount_users, 'band');
        User::generate_multiple($amount_users, 'agent');
    }

}

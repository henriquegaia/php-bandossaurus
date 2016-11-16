<div class="widget">
    <h2>
        <?php
        $config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
        $user_id = $user_data['id'];
        $image_profile_path = $user_data['profile'];

        /*
         * changed profile photo: flag to control the refresh of the page
         * once user update profile image
         */
        $changed_profile_image = (int) 0;
        ?>    
    </h2>
    <div class="inner">
        <div class="profile">
            <?php
            /*
             * ****************************************************
             * check if form below was submitted 
             * ****************************************************
             */

            if (isset($_FILES['profile']) === true) {
                /*
                 * ****************************************************
                 * if user has not chosen a file
                 * ****************************************************
                 */

                if (empty($_FILES['profile']['name']) === true) {
                    echo 'Please choose a file!';
                }
                /*
                 * ****************************************************
                 * if user has already chosen a file
                 * ****************************************************
                 */ else {
                    $allowed = array('jpg', 'jpeg', 'gif', 'png');
                    $file_name = $_FILES['profile']['name'];
                    $file_extn = strtolower(end(explode('.', $file_name)));
                    $file_tmp_name = $_FILES['profile']['tmp_name'];

                    /*
                     * ****************************************************
                     * upload file if extension is allowed
                     * ****************************************************
                     */

                    if (in_array($file_extn, $allowed) === true) {
                        change_profile_image($user_id, $file_tmp_name, $file_extn);
                        $changed_profile_image = (int) 1;
                    }
                    /*
                     * ****************************************************
                     * if extension is not allowed
                     * ****************************************************
                     */ else {
                        echo 'Incorrect file type.<br>';
                        echo 'Types allowed: ';
                        echo implode(',', $allowed);
                    }
                }
            }

            /*
             * ****************************************************
             * reload page
             * ****************************************************
             */
            if ($changed_profile_image === 1) {
                echo "<meta http-equiv='refresh' content='0'>"; ////echo '<script> reload_page(); </script>';//v.1
                $changed_profile_image = (int) 0;
            }

            /*
             * ****************************************************
             * show profile image
             * ****************************************************
             */
            if (empty($user_data['profile']) === false) {
                $filepath = $config['url']['images/profile'] . '/' . $user_data['profile_img_name'];
                echo '<img src="', $filepath, '" alt="profile image">';
            }

            /*
             * ****************************************************
             * form to upload image
             * ****************************************************
             */
            include $config['file']['change_user_image_form'];
            ?>
        </div>
    </div>
</div>
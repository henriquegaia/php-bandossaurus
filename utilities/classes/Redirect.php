<?php

class Redirect {
    /*
     * **************************************************
     * Not Checked
     * **************************************************
     */

    public static function get_previous_page() {
        global $config;
        $previous_temp = File::get_filename_by_path($_SERVER['HTTP_REFERER']);
        $previous_file_exists = File::exists($previous_temp);

        /*
          if($previous_file_exists){
          echo 'previous exists';
          }else{
          echo 'previous doesnt exists';
          }
         */
        /*
         * -------------------------------------------------
         * 
         * previous = $_server['referer']
         * 
         * if       (previous !belong_to_this_site)
         *          return index.php
         * else if  (previous == (protected || activate))
         *          ???????????
         * else     
         *          return previous
         * 
         * -------------------------------------------------
         * 
         */
        return $previous_temp;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function logged_in() {
        global $config;
        if (User::logged_in() === true) {
            self::to_index();
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function register_pre($query) {
        global $config;
        $roles_range = Role::get_roles_range();

        $range_max = $roles_range['max'];
        $range_min = $roles_range['min'];

        if (isset($_GET[$query]) == false ||
                (isset($_GET[$query]) == true && !Validation::is_value_in_range($_GET[$query], $range_min, $range_max)) ||
                (isset($_GET[$query]) == true && $_SESSION['role'] != $_GET[$query])) {
            self::no_status('register_pre', '');
        }
    }

    /*
     * ****************************************************************
     * Redirect success / unsuccess
     * ****************************************************************
     */

    public static function success_status_with_other_get($file, $mode, $other_get, $status) {
        global $config;
        $link = $config['file'][$file] . '?' . $other_get . '&' . $status;
        $link_txt = $mode . ' ' . $file . ' ' . $status;
        Redirect::by_headers_sent($link, $link_txt);
    }

    public static function success_status($file, $mode, $status) {
        global $config;
        $link = $config['file'][$file] . '?' . $status;
        $link_txt = $mode . ' ' . $file . ' ' . $status;
        Redirect::by_headers_sent($link, $link_txt);
    }

    public static function to_index() {
        self::no_status('index', '');
    }

    public static function no_status($file, $mode) {
        global $config;
        $link = $config['file'][$file];
        $link_txt = $mode . ' ' . $file;
        Redirect::by_headers_sent($link, $link_txt);
    }

    public static function no_status_with_param($file, $mode, $param) {
        global $config;
        $link = $config['file'][$file] . $param;
        $link_txt = $mode . ' ' . $file;
        Redirect::by_headers_sent($link, $link_txt);
    }

    public static function with_array_params($file, $mode, $params) {
        global $config;
        $link = $config['file'][$file];
        $link_params = self::append_params_to_link($link, $params);
        $link_txt = $mode . ' ' . $file;
        Redirect::by_headers_sent($link, $link_txt);
    }

    private static function append_params_to_link($link, $params) {
        foreach ($params as $param) {
            $link.='?' . $param;
        }
        return $link;
    }

    public static function by_headers_sent($link, $link_txt) {
        if (headers_sent($filename, $line_num)) {
            echo "Redirect failed. Please click on this link: ";
            ?>
            <a href="<?php echo $link; ?>">
                <?php echo $link_txt; ?>
            </a>
            <?php
            if (Project::testing()) {
                echo "<br>Headers already sent in $filename on line $line_num.<br>";
            }
            die();
        } else {
            ////////////////
            // JS alternative
            ////////////////
//            echo "<script type='text/javascript'>window.top.location='$link';</script>";
//            exit;
            ////////////////
            // Old version
            //////////////////
            header('Location: ' . $link);
            exit();
        }
    }

}

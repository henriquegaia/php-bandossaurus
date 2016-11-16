<?php

class Regex {
    /*
     * *****************************************************************
     * Example of how regex looks like
     * *****************************************************************
     */

    /*
     * *****************************************************************
     * Chars
     * *****************************************************************
     */
    private $other_chars = '$.&?!:;-';
    private $underscore = '_';


    /*
     * *****************************************************************
     * Lines
     * *****************************************************************
     */
    private $beg_line_1 = '/^';
    private $bod_line_2;
    private $bod_line_3 = '(?=[^A-Za-z]*[A-Za-z])';
    private $bod_line_4 = '(?=[^0-9]*[0-9])';
    private $bod_line_5;
    private $end_line_6 = '$/';

    /*
     * *****************************************************************
     * Mins and Maxs
     * *****************************************************************
     */
    private $username_min = 6;
    private $username_max = 16;
    private $password_min = 6;
    private $password_max = 20;
    private $first_name_min = 2;
    private $first_name_max = 20;
    private $last_name_min = 0;
    private $last_name_max = 20;
    private $band_min = 1;
    private $band_max = 50;
    private $other_details_min = 1;
    private $other_details_max = 200;

    /*
     * *****************************************************************
     * username 
     * *****************************************************************
     */

    public function get_regex_username() {
        $append = '';
        return $this->get_regex_gen($this->username_min, $this->username_max, true, $append);
    }

    public function get_regex_username_error_msg() {
        $msg_a_append = 'must have at least one letter; ';
        return $this->get_regex_gen_error_msg('username', $this->username_min, $this->username_max, true, $msg_a_append);
    }

    public function get_regex_username_txt() {
        $msg_a_append = 'must have at least one letter; ';
        return $this->get_regex_gen_txt($this->username_min, $this->username_max, true, $msg_a_append);
    }

    /*
     * *****************************************************************
     * password 
     * *****************************************************************
     */

    public function get_regex_password() {
        $append = $this->bod_line_4;
        return $this->get_regex_gen($this->password_min, $this->password_max, true, $append);
    }

    public function get_regex_password_error_msg() {
        $msg_a_append = 'must have at least one letter and one number; ';
        return $this->get_regex_gen_error_msg('password', $this->password_min, $this->password_max, true, $msg_a_append);
    }

    public function get_regex_password_txt() {
        $msg_a_append = 'must have at least one letter and one number; ';
        return $this->get_regex_gen_txt($this->password_min, $this->password_max, true, $msg_a_append);
    }

    /*
     * *****************************************************************
     * Functions for general regexes
     * -username
     * -password
     * *****************************************************************
     */

    private function get_regex_gen($min, $max, $has_Max, $append) {
        $bod_line_2_beg = '(?=.{';
        $bod_line_2_end = '}$)';
        $bod_line_5_beg = '(?:([\w\d';
        $bod_line_5_end = '])\1?(?!\1))+';
        $bod_line_5 = $bod_line_5_beg .
                $this->other_chars .
                $bod_line_5_end;
        $lines_3456 = $this->bod_line_3 .
                $append .
                $bod_line_5 .
                $this->end_line_6;

        return $this->get_regex($has_Max, $min, $max, $bod_line_2_beg, $bod_line_2_end, $lines_3456);
    }

    private function get_regex_gen_error_msg($field, $min, $max, $has_Max, $msg_a_append) {
        $msg_a = 'Your ' . $field . ': a) must not countain spaces; must not repeat same character more than 2 times consecutively; ';
        $msg_a = $msg_a . $msg_a_append;
        $msg_b_1 = 'b) must have between ' . $min . ' and ' . $max . ' characters; ';
        $msg_b_2 = 'b) must have at least ' . $min . ' characters; ';
        $msg_c = 'c) accepts letters, numbers and ' . $this->other_chars . '; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    private function get_regex_gen_txt($min, $max, $has_Max, $msg_a_append) {
        $msg_a = 'No spaces; Max 2x same consecutive char; ';
        $msg_a = $msg_a . $msg_a_append;
        $msg_b_1 = $min . ' - ' . $max . ' characters; ';
        $msg_b_2 = 'Min ' . $min . ' characters; ';
        $msg_c = 'Accepts: letters, numbers and ' . $this->other_chars . '; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    /*
     * *****************************************************************
     * first name
     * *****************************************************************
     */

    public function get_regex_first_name() {
        return $this->get_regex_txt_only($this->first_name_min, $this->first_name_max, true);
    }

    public function get_regex_first_name_error_msg() {
        return $this->get_regex_txt_only_error_msg('first name', $this->first_name_min, $this->first_name_max, true);
    }

    public function get_regex_first_name_txt() {
        return $this->get_regex_txt_only_txt($this->first_name_min, $this->first_name_max, true);
    }

    /*
     * *****************************************************************
     * last name
     * *****************************************************************
     */

    public function get_regex_last_name() {
        return $this->get_regex_txt_only($this->last_name_min, $this->last_name_max, true);
    }

    public function get_regex_last_name_error_msg() {
        return $this->get_regex_txt_only_error_msg('last name', $this->last_name_min, $this->last_name_max, true);
    }

    public function get_regex_last_name_txt() {
        return $this->get_regex_txt_only_txt($this->last_name_min, $this->last_name_max, true);
    }

    /*
     * *****************************************************************
     * Functions for txt regexes
     * -first name
     * -last name
     * *****************************************************************
     */

    public function get_regex_txt_only($min, $max, $has_Max) {
        $bod_line_2_beg = '(?=.{';
        $bod_line_2_end = '}$)';
        $bod_line_5 = '(?:([a-zA-Z])\1?(?!\1))+';
        $lines_56 = $bod_line_5 .
                $this->end_line_6;

        return $this->get_regex($has_Max, $min, $max, $bod_line_2_beg, $bod_line_2_end, $lines_56);
    }

    public function get_regex_txt_only_error_msg($field, $min, $max, $has_Max) {
        $msg_a = 'Your ' . $field . ': a) must not countain spaces; must not repeat same character more than 2 times consecutively; ';
        $msg_b_1 = 'b) must have between ' . $min . ' and ' . $max . ' characters; ';
        $msg_b_2 = 'b) must have at least ' . $min . ' characters; ';
        $msg_c = 'c) accepts letters only; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    public function get_regex_txt_only_txt($min, $max, $has_Max) {
        $msg_a = 'No spaces; Max 2x same consecutive char; ';
        $msg_b_1 = $min . ' - ' . $max . ' characters; ';
        $msg_b_2 = 'Min ' . $min . ' characters; ';
        $msg_c = 'Accepts: letters; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    /*
     * *****************************************************************
     * Functions for txt or empty regexes
     * -last name
     * *****************************************************************
     */

    public function get_regex_txt_only_or_empty($min, $max, $has_Max) {
        $bod_line_2_beg = '(?=.{';
        $bod_line_2_end = '}$)';
        $lines_3456 = '(?:([a-zA-Z]))*' .
                $this->end_line_6;

        return $this->get_regex($has_Max, $min, $max, $bod_line_2_beg, $bod_line_2_end, $lines_3456);
    }

    public function get_regex_txt_only_or_empty_error_msg($field, $min, $max, $has_Max) {
        $msg_a = 'Your ' . $field . ': a) must not countain spaces; ';
        $msg_b_1 = 'b) must have between ' . $min . ' and ' . $max . ' characters; ';
        $msg_b_2 = 'b) must have at least ' . $min . ' characters; ';
        $msg_c = 'c) accepts letters only; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    public function get_regex_txt_only_or_empty_txt($min, $max, $has_Max) {
        $msg_a = 'No spaces; ';
        $msg_b_1 = $min . ' - ' . $max . ' characters; ';
        $msg_b_2 = 'Min ' . $min . ' characters; ';
        $msg_c = 'Accepts: letters; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    /*
     * *****************************************************************
     * email regex
     * 
     * http://emailregex.com/
     * *****************************************************************
     */

    public function get_regex_email() {
        return '/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*'
                . '@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.'
                . '(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|'
                . '([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/';
    }

    /*
     * *****************************************************************
     * Functions for text with spaces
     * *****************************************************************
     */

    public function get_regex_txt_with_spaces($min, $max, $has_Max) {
        return '/^'
                . '(?=.{' . $min . ',' . $max . '}$)'//min to max characters
                . '(?=[^A-Za-z]*[A-Za-z])'//At least one Alpha
                . '(?:([\w\d\s])\1?(?!\1))+'//Valid Characters, not repeated thrice.
                . '$/';
    }

    public function get_regex_txt_with_spaces_error_msg($field, $min, $max, $has_Max) {
        $msg_a = 'Your ' . $field . ': a) accepts spaces; must have at least one letter; '
                . 'must not repeat same character more than 2 times consecutively; ';
        $msg_b_1 = 'b) must have between ' . $min . ' and ' . $max . ' characters; ';
        $msg_b_2 = 'b) must have at least ' . $min . ' characters; ';
        $msg_c = 'c) accepts letters, numbers;';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    public function get_regex_txt_with_spaces_txt($min, $max, $has_Max) {
        $msg_a = 'Max 2x same consecutive char; Accepts spaces; ';
        $msg_b_1 = $min . ' - ' . $max . ' characters; ';
        $msg_b_2 = 'Min ' . $min . ' characters; ';
        $msg_c = 'Accepts: letters, numbers; ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    /*
     * *****************************************************************
     * band name
     * *****************************************************************
     */

    public function get_regex_band_name() {
        return $this->get_regex_not_empty($this->band_min, $this->band_max);
    }

    public function get_regex_band_name_error_msg() {
        return $this->get_regex_not_empty_error_msg('band name', $this->band_min, $this->band_max, true);
    }

    public function get_regex_band_name_txt() {
        return $this->get_regex_not_empty_txt($this->band_min, $this->band_max, true);
    }

    /*
     * *****************************************************************
     * band member name (same as the name for band)
     * *****************************************************************
     */

    public function get_regex_band_member_name() {
        return $this->get_regex_not_empty($this->band_min, $this->band_max);
    }

    public function get_regex_band_member_name_error_msg() {
        return $this->get_regex_not_empty_error_msg('band member name', $this->band_min, $this->band_max, true);
    }

    public function get_regex_band_member_name_txt() {
        return $this->get_regex_not_empty_txt($this->band_min, $this->band_max, true);
    }

    /*
     * *****************************************************************
     * Functions anything except empty
     * *****************************************************************
     */

    public function get_regex_not_empty($min, $max) {
        return '/^\s*([^\s]\s*){' . $min . ',' . $max . '}$/';
    }

    public function get_regex_not_empty_error_msg($field, $min, $max, $has_Max) {
        $msg_a = 'Your ' . $field . ': a) accepts any character; ';
        $msg_b_1 = 'b) must have between ' . $min . ' and ' . $max . ' characters; ';
        $msg_b_2 = 'b) must have at least ' . $min . ' characters; ';
        $msg_c = '';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    public function get_regex_not_empty_txt($min, $max, $has_Max) {
        $msg_a = 'Accepts: everything; ';
        $msg_b_1 = $min . ' - ' . $max . ' characters; ';
        $msg_b_2 = 'Min ' . $min . ' characters; ';
        $msg_c = ' ';
        return $this->return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c);
    }

    /*
     * *****************************************************************
     * youtube url
     * *****************************************************************
     */

    public function get_regex_youtube_link() {
        return '/^https:\/\/www\.youtube\.com\/watch(.*)$/';
    }

    public function get_regex_youtube_link_error_msg() {
        return 'Your youtube link (url): a) should be directly to a video and not a channel; '
                . 'b) It should start like this: \'https://www.youtube.com/watch\'; ';
    }

    public function get_regex_youtube_link_txt() {
        return '';
    }

    /*
     * *****************************************************************
     * other details
     * *****************************************************************
     */

    public function get_regex_other_details() {
        return $this->get_regex_not_empty($this->other_details_min, $this->other_details_max);
    }

    public function get_regex_other_details_error_msg() {
        return $this->get_regex_not_empty_error_msg('other details', $this->other_details_min, $this->other_details_max, true);
    }

    public function get_regex_other_details_txt() {
        return $this->get_regex_not_empty_txt($this->other_details_min, $this->other_details_max, true);
    }

    /*
     * *****************************************************************
     * Common Functions 
     * *****************************************************************
     */

    private function get_regex($has_Max, $min, $max, $bod_line_2_beg, $bod_line_2_end, $lines_3456) {
        if ($has_Max == true) {
            return $this->beg_line_1 .
                    $bod_line_2_beg . $min . ',' . $max . $bod_line_2_end .
                    $lines_3456;
        } else {
            return $this->beg_line_1 .
                    $bod_line_2_beg . $min . ',' . $bod_line_2_end .
                    $lines_3456;
        }
    }

    public function return_txt_or_error_msg($has_Max, $msg_a, $msg_b_1, $msg_b_2, $msg_c) {
        if ($has_Max == true) {
            return $msg_a . $msg_b_1 . $msg_c;
        } else {
            return $msg_a . $msg_b_2 . $msg_c;
        }
    }

}

<?php

class File {
    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function exists($file_to_check) {
        global $config;
        if ($file_to_check == 'index.php') {
            return true;
        }

        $files = scandir($config['dir']['web']);
        foreach ($files as $file) {
            if ($file == $file_to_check) {
                return true;
            }
        }
        return false;
    }

    /*
     * **************************************************
     * 
     * **************************************************
     */

    public static function get_filename_by_path($path) {
        $path_exploded = explode('/', $path);
        $file = end($path_exploded);
        return $file;
//$file_exploded = explode('.', $file);
//return $file_exploded[0];
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function write_error_to_file($file_name, $error) {
        global $config;
        $ip = getHostByName(getHostName()) . ' -> ';
        $date_time = date("d/m/Y") . ' ' . date("h:i:s a") . ' -> ';
        $error_log_file = $config['file'][$file_name];
        $fp = fopen($error_log_file, "a");
        $line = $date_time . $ip . $error;
        fwrite($fp, $line . "\r\n");
        fclose($fp);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function usa_csv_file_to_js_array_string_has_repeated__just_cities($file) {
        $handle = fopen($file, "r");
        fgetcsv($handle);
        $txt = '';
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $parts = explode(',', $line);
                $txt.='|' . $parts[2] . ', ' . $parts[1];
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return $txt;
    }

    public static function usa_csv_file_to_php_array_no_repeated__just_cities($file) {
        $handle = fopen($file, "r");
        fgetcsv($handle);
        $arr = [];
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $parts = explode(',', $line);
                $city_state = $parts[2] . ', ' . $parts[1];
                if (!in_array($city_state, $arr)) {
                    $arr [] = $city_state;
                }
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return $arr;
    }

    public static function usa_csv_file_to_php_array_no_repeated__all_by_cities($file) {
        $handle = fopen($file, "r");
        fgetcsv($handle);
        $arr = [];
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $parts = explode(',', $line);
                $zip = $parts[0];
                $city_state = $parts[2] . ', ' . $parts[1];
                $lat = $parts[3];
                $lon = $parts[4];
                if (!in_array($city_state, $arr)) {
                    $arr [$city_state] = [
                        'zip' => $zip,
                        'lat' => $lat,
                        'lon' => $lon
                    ];
                }
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return $arr;
    }

    public static function php_array_to_txt_file($array, $destiny) {
        $fp = fopen($destiny, 'w');
        fwrite($fp, print_r($array, TRUE));
        fclose($fp);
    }

    public static function json_array_to_txt_file($array, $destiny) {
        $fp = fopen($destiny, 'w');
        fwrite($fp, $array);
        fclose($fp);
    }

    public static function usa_cities_php_array_to_json_array($array) {
        return json_encode($array);
    }

    public static function usa_csv_file_to_js_array_string_no_repeated($file) {
        $array = self::usa_csv_file_to_php_array_no_repeated($file);
        $txt = '';
        foreach ($array as $key => $value) {
            $txt.='|' . $value;
        }
        return $txt;
    }

    public static function instruments_txt_file_to_php_array($file) {
        $handle = fopen($file, "r");
        $arr = [];
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (!in_array($line, $arr)) {
                    $arr [] = $line;
                }
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return $arr;
    }

    public static function instruments_array_to_txt_file($origin, $destiny) {
        $insts = file($origin);
        asort($insts);

        $comma_separated = implode("','", $insts);
        $comma_separated = "'" . $comma_separated . "'";

        $fp = fopen($destiny, 'w');
        fwrite($fp, $comma_separated);
        fclose($fp);
    }
    
    public static function instruments_txt_file_to_json($origin,$destiny) {
        $insts = file($origin);
        asort($insts);

        $insts_json=json_encode($insts);

        $fp = fopen($destiny, 'w');
        fwrite($fp, $insts_json);
        fclose($fp);
    }

}

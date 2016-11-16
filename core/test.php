<?php

$base = dirname(dirname(__FILE__));
$base = str_replace('\\', '/', $base);

echo "test1<br>";

require_once $base . '/utilities/classes/Regex.php';
//require_once $base . '/utilities/classes/Token.php';
//require_once $base . '/utilities/classes/Email.php';
//require_once $base . '/utilities/classes/Security.php';
//require_once $base . '/utilities/classes/Presentation.php';
//require_once $base . '/utilities/classes/File.php';
//require_once $base . '/utilities/classes/Validation.php';
//require_once $base . '/utilities/classes/Redirect.php';
//require_once $base . '/utilities/classes/Country.php';
//require_once $base . '/utilities/classes/City.php';
//require_once $base . '/utilities/classes/Gender.php';
//require_once $base . '/utilities/classes/Instrument.php';
//require_once $base . '/utilities/classes/Genre.php';
//require_once $base . '/utilities/classes/Practice.php';
//require_once $base . '/utilities/classes/Song.php';
//require_once $base . '/utilities/classes/Singer.php';
//require_once $base . '/utilities/classes/MusicComposition.php';
//require_once $base . '/utilities/classes/DataStructure.php';
//require_once $base . '/utilities/classes/Post.php';
//require_once $base . '/utilities/classes/Random.php';
//require_once $base . '/utilities/classes/Error.php';
require_once $base . '/utilities/classes/JavaScript.php';
//require_once $base . '/utilities/classes/ArtistType.php';
//require_once $base . '/utilities/classes/Browser.php';
//require_once $base . '/utilities/classes/Get.php';
//require_once $base . '/utilities/classes/Urgency.php';
//require_once $base . '/utilities/classes/Age.php';
//require_once $base . '/utilities/classes/Location.php';
//require_once $base . '/utilities/classes/Search.php';
//require_once $base . '/utilities/classes/Cookie.php';
//require_once $base . '/utilities/classes/Premium.php';
//require_once $base . '/utilities/classes/PayPalClass.php';
//require_once $base . '/utilities/classes/Project.php';

//$classesDir = array(
////    ROOT_DIR . 'utilities/classes/',
//    ROOT_DIR . 'core/database/',
//    ROOT_DIR . 'model/',
//    ROOT_DIR . 'repository/'
//);
//
//function __autoload($class_name) {
//    global $classesDir;
//    foreach ($classesDir as $directory) {
//        if (file_exists($directory . $class_name . '.php')) {
//            require_once ($directory . $class_name . '.php');
//            return;
//        }
//    }
//}

//$dirs_to_require = [
//    '/core/database/*.php',
//    '/model/*.php',
//    '/repository/*.php'
//];
/*
 * connection
 */
//foreach ($dirs_to_require as $dir) {
//    foreach (glob($base . $dir) as $filename) {
//        require_once $filename;
//    }
//}
//require_once $base . '/core/database/Connection.php';
//require_once $base . '/core/database/MySQLiConnection.php';
/*
 * model
 */
//require_once $base . '/model/User.php';
//require_once $base . '/model/Experience.php';
//require_once $base . '/model/Role.php';
//require_once $base . '/model/Musician.php';
//require_once $base . '/model/MusicianExperienceAlone.php';
//require_once $base . '/model/MusicianExperienceBand.php';
//require_once $base . '/model/Band.php';
//require_once $base . '/model/BandMember.php';
//require_once $base . '/model/BandExperience.php';
//require_once $base . '/model/Agent.php';
//require_once $base . '/model/AgentExperience.php';
//require_once $base . '/model/Match.php';
//require_once $base . '/model/Dummy.php';
//require_once $base . '/model/Pursuit.php';
//require_once $base . '/model/Invitation.php';
//require_once $base . '/model/MatchMusicianBand.php';
//require_once $base . '/model/MatchMusicianAgent.php';
//require_once $base . '/model/MatchBandAgent.php';
//require_once $base . '/model/Message.php';
/*
 * repository
 */
//require_once $base . '/repository/BaseRepository.php';
//require_once $base . '/repository/SharedRepository.php';
/*
 * 
 */
$included_files = get_included_files();

foreach ($included_files as $filename) {
    echo "$filename\n";
}
// No   Regex
//$r = new Regex();
//echo $r->get_regex_email();
// Yes  Token
//echo Token::$test;
// Yes  Instrument
//print_r(Instrument::get_all());
// Yes  Email
//echo Email::LIMIT_MONTH_NOT_PREMIUM;
// Yes  Security
//echo Security::get_hash_cost();
// Yes  Presentation
//echo Presentation::failure_message();

require_once $base . '/core/test2.php';

<?php

$base = dirname(dirname(__FILE__));
$base = str_replace('\\', '/', $base);
/*
 * utilities
 */
require_once $base . '/utilities/classes/Regex.php';
require_once $base . '/utilities/classes/Token.php';
require_once $base . '/utilities/classes/Email.php';
require_once $base . '/utilities/classes/Security.php';
require_once $base . '/utilities/classes/Presentation.php';
require_once $base . '/utilities/classes/File.php';
require_once $base . '/utilities/classes/Validation.php';
require_once $base . '/utilities/classes/Redirect.php';
require_once $base . '/utilities/classes/Country.php';
require_once $base . '/utilities/classes/City.php';
require_once $base . '/utilities/classes/Gender.php';
require_once $base . '/utilities/classes/Instrument.php';
require_once $base . '/utilities/classes/Genre.php';
require_once $base . '/utilities/classes/Practice.php';
require_once $base . '/utilities/classes/Song.php';
require_once $base . '/utilities/classes/Singer.php';
require_once $base . '/utilities/classes/MusicComposition.php';
require_once $base . '/utilities/classes/DataStructure.php';
require_once $base . '/utilities/classes/Post.php';
require_once $base . '/utilities/classes/Random.php';
require_once $base . '/utilities/classes/Error.php';
require_once $base . '/utilities/classes/JavaScript.php';
require_once $base . '/utilities/classes/ArtistType.php';
require_once $base . '/utilities/classes/Browser.php';
require_once $base . '/utilities/classes/Get.php';
require_once $base . '/utilities/classes/Urgency.php';
require_once $base . '/utilities/classes/Age.php';
require_once $base . '/utilities/classes/Location.php';
require_once $base . '/utilities/classes/Search.php';
require_once $base . '/utilities/classes/Cookie.php';
require_once $base . '/utilities/classes/Premium.php';
require_once $base . '/utilities/classes/PayPalClass.php';
require_once $base . '/utilities/classes/Project.php';

/*
 * connection
 */
require_once $base . '/core/database/Connection.php';
require_once $base . '/core/database/MySQLiConnection.php';
/*
 * model
 */
require_once $base . '/model/User.php';
require_once $base . '/model/Experience.php';
require_once $base . '/model/Role.php';
require_once $base . '/model/Musician.php';
require_once $base . '/model/MusicianExperienceAlone.php';
require_once $base . '/model/MusicianExperienceBand.php';
require_once $base . '/model/Band.php';
require_once $base . '/model/BandMember.php';
require_once $base . '/model/BandExperience.php';
require_once $base . '/model/Agent.php';
require_once $base . '/model/AgentExperience.php';
require_once $base . '/model/Match.php';
require_once $base . '/model/Dummy.php';
require_once $base . '/model/Pursuit.php';
require_once $base . '/model/Invitation.php';
require_once $base . '/model/MatchMusicianBand.php';
require_once $base . '/model/MatchMusicianAgent.php';
require_once $base . '/model/MatchBandAgent.php';
require_once $base . '/model/Message.php';
/*
 * repository
 */
require_once $base . '/repository/BaseRepository.php';
require_once $base . '/repository/SharedRepository.php';

/*
  $dirs_to_require = [
  '/utilities/classes/*.php',
  '/core/database/*.php',
  '/model/*.php',
  '/repository/*.php'
  ];
 */

/*
 * *****************************************************************
 * Hard coded variables
 * *****************************************************************
 */
$base_url = Project::get_url();
$project_state = Project::get_status();
$company_name = Project::$company_name;
$title = Project::$title;

/*
 * *****************************************************************
 * All the directories
 * *****************************************************************
 */

$dirs = array(
    'core' => $base . '/core',
    'core/database' => $base . '/core/database',
    'core/functions' => $base . '/core/functions',
    'css' => $base . '/css',
    'docs' => $base . '/docs',
    'images' => $base . '/images',
    'images/general' => $base . '/images/general',
    'images/profile' => $base . '/images/profile',
    'includes' => $base . '/includes',
    'includes/overall' => $base . '/includes/overall',
    'includes/widgets' => $base . '/includes/widgets',
    'js' => $base . '/js',
    'libraries' => $base . '/libraries',
    'libraries/phpmailer' => $base . '/libraries/phpmailer',
    'log' => $base . '/log',
    'model' => $base . '/model',
    'private' => $base . '/private',
    'repository' => $base . '/repository',
    'utilities' => $base . '/utilities',
    'web' => $base . '/web',
    'web/base/forms' => $base . '/web/base/forms',
    'web/base/forms/includes' => $base . '/web/base/forms/includes',
    'web/base/forms/includes/includes' => $base . '/web/base/forms/includes/includes',
    'web/messages/forms' => $base . '/web/messages/forms',
    'web/exp/forms' => $base . '/web/exp/forms',
    'web/footer' => $base . '/web/footer',
    'web/premium/forms' => $base . '/web/premium/forms',
    'web/premium/includes' => $base . '/web/premium/includes',
    'web/pursuit/forms' => $base . '/web/pursuit/forms',
    'web/pursuit/includes' => $base . '/web/pursuit/includes',
    'web/search/by_pursuit' => $base . '/web/search/by_pursuit',
    'web/search/overall' => $base . '/web/search/overall'
);

/*
 * *****************************************************************
 * Url's
 * *****************************************************************
 */

$urls = array(
    'web/base' => $base_url . '/web/base',
    'images' => $base_url . '/images',
    'images/general' => $base_url . '/images/general',
    'images/profile' => $base_url . '/images/profile',
    'js/exp' => $base_url . '/js/exp',
    'js/locations' => $base_url . '/js/locations',
    'js/matches' => $base_url . '/js/matches',
    'js/messages' => $base_url . '/js/messages',
    'js/pursuit' => $base_url . '/js/pursuit',
    'js/search' => $base_url . '/js/search',
    'js/search/by_pursuit' => $base_url . '/js/search/by_pursuit',
    'js/search/overall' => $base_url . '/js/search/overall',
    'js/settings' => $base_url . '/js/settings',
    'web' => $base_url . '/web',
    'web/base' => $base_url . '/web/base',
    'web/chat' => $base_url . '/web/chat',
    'web/email' => $base_url . '/web/email',
    'web/exp' => $base_url . '/web/exp',
    'web/footer' => $base_url . '/web/footer',
    'web/invitation' => $base_url . '/web/invitation',
    'web/matches' => $base_url . '/web/matches',
    'web/messages' => $base_url . '/web/messages',
    'web/premium' => $base_url . '/web/premium',
    'web/pursuit' => $base_url . '/web/pursuit',
    'web/search/by_pursuit' => $base_url . '/web/search/by_pursuit',
    'web/search/overall' => $base_url . '/web/search/overall',
);


/*
 * *****************************************************************
 * *****************************************************************
 * *****************                                 ***************
 * ***************** The array that will be returned ***************
 * *****************                                 ***************
 * *****************************************************************
 * *****************************************************************
 */

return array(
    'base_url' => $base_url,
    'email' => [
        'support' => 'not@defined.com'
    ],
    'dir' => array(
        'web' => $dirs['web'],
        'images' => $dirs['images'],
        'profile' => $dirs['images/profile'],
        'general' => $dirs['images/general']
    ),
    'url' => array(
        'base' => $base_url,
        'images' => $urls['images'],
        'images/general' => $urls['images/general'],
        'images/profile' => $urls['images/profile'],
        'register' => $urls['web/base'] . '/register.php',
        'register_pre' => $urls['web/base'] . '/register_pre.php',
        'login' => $urls['web/base'] . '/login.php',
    ),
    'file' => array(
        'favicon' => $base_url . '/images/logo/favicon2/favicon.ico',
// ===============================================
// === / (root)
// ===============================================
        'index' => $base_url . '/index.php',
        'js_chat_client' => $base_url . '/chat_client.js',
// ===============================================
// === core 
// ===============================================
        'init' => $dirs['core'] . '/init.php',
// ===============================================
// === core / database
// ===============================================
        'connect' => $dirs['core/database'] . '/connect.php',
// ===============================================
// === css
// ===============================================
        'overall' => $base_url . '/css/overall.css',
        'jquery_css' => $base_url . '/css/jquery-ui.min.css',
// ===============================================
// === images
// ===============================================
        'logo_img' => $base_url . '/images/logo/logo.jpg',
        'paypal_logo' => $dirs['images'] . '/paypal/paypal_logo.png',
        'me' => $base_url . '/images/me/me.jpg',
// ===============================================
// === includes / overall
// ===============================================
        'ov_header' => $dirs['includes/overall'] . '/ov_header.php',
        'ov_footer' => $dirs['includes/overall'] . '/ov_footer.php',
// ===============================================
// === includes / widgets
// ===============================================
        'wi_logged_in_old' => $dirs['includes/widgets'] . '/wi_logged_in_old.php',
        'wi_login_old' => $dirs['includes/widgets'] . '/wi_login_old.php',
        'wi_user' => $dirs['includes/widgets'] . '/wi_user.php',
        'wi_user_count_old' => $dirs['includes/widgets'] . '/wi_user_count_old.php',
        'wi_user_profile_img' => $dirs['includes/widgets'] . '/wi_user_profile_img.php',
// ===============================================
// === includes
// ===============================================
        'aside' => $dirs['includes'] . '/aside.php',
        'footer' => $dirs['includes'] . '/footer.php',
        'head' => $dirs['includes'] . '/head.php',
        'header' => $dirs['includes'] . '/header.php',
        'menu' => $dirs['includes'] . '/menu.php',
// ===============================================
// === libraries
// ===============================================
        'autoload' => $dirs['libraries'] . '/vendor/autoload.php',
// ===============================================
// === js
// ===============================================
        'js_angular' => $base_url . '/js/angular.min.js',
        'js_global' => $base_url . '/js/global.js',
        'js_urls' => $base_url . '/js/urls.js',
        'jquery' => $base_url . '/js/jquery-1.12.4.min.js',
        'jquery_ui' => $base_url . '/js/jquery-ui.min.js',
        'jquery_lazyload' => $base_url . '/js/jquery.lazyload.js',
        'js_lazy_load' => $base_url . '/js/lazy_load.js',
        'js_validations' => $base_url . '/js/validations.js',
        'js_locations' => $base_url . '/js/locations.js',
        'js_plugin_table_sort' => $base_url . '/js/plugin_table_sort.js',
        'js_settings_1d_table_generic' => $base_url . '/js/settings_1d_table_generic.js',
        'js_settings_2d_table_generic' => $base_url . '/js/settings_2d_table_generic.js',
// ===============================================
// === js / chat
// ===============================================
        'js_chat' => $base_url . '/js/chat/chat.js',
// ===============================================
// === js / exp
// ===============================================
        'js_experience_musician_alone' => $urls['js/exp'] . '/experience_musician_alone.js',
        'js_experience_musician_bands' => $urls['js/exp'] . '/experience_musician_bands.js',
        'js_experience_band' => $urls['js/exp'] . '/experience_band.js',
        'js_experience_agent' => $urls['js/exp'] . '/experience_agent.js',
// ===============================================
// === js / locations
// ===============================================       
        'js_usa' => $urls['js/locations'] . '/usa.js',
// ===============================================
// === js / matches
// ===============================================       
        'js_matches' => $urls['js/matches'] . '/matches.js',
// ===============================================
// === js / messages
// ===============================================       
        'js_messages' => $urls['js/messages'] . '/messages.js',
// ===============================================
// === js / pursuit
// ===============================================
        'js_pursuit' => $urls['js/pursuit'] . '/pursuit.js',
// ===============================================
// === js / search / by_pursuit
// ===============================================   
        'js_search_by_pursuit' => $urls['js/search/by_pursuit'] . '/search_by_pursuit.js',
// ===============================================
// === js / search / overall
// ===============================================  
        'js_search_overall_filter' => $urls['js/search/overall'] . '/search_overall_filter.js',
        'js_search_overall_agent' => $urls['js/search/overall'] . '/search_overall_agent.js',
        'js_search_overall_band' => $urls['js/search/overall'] . '/search_overall_band.js',
        'js_search_overall_musician' => $urls['js/search/overall'] . '/search_overall_musician.js',
// ===============================================
// === js / settings
// ===============================================
        'js_settings_band_members' => $urls['js/settings'] . '/settings_band_members.js',
        'js_settings' => $urls['js/settings'] . '/settings.js',
        'js_settings_location' => $urls['js/settings'] . '/settings_location.js',
// ===============================================
// === libraries
// ===============================================
        'phpmailer_autoload' => $dirs['libraries/phpmailer'] . '/PHPMailerAutoload.php',
// ===============================================
// === log
// ===============================================
        'email_error_log' => $dirs['log'] . '/log_email_error.txt',
        'csrf_attacks' => $dirs['log'] . '/log_csrf.txt',
        'brute_force' => $dirs['log'] . '/log_brute_force.txt',
        'pay_pal_log' => $dirs['log'] . '/pay_pal_log.txt',
// ===============================================
// === private
// ===============================================        
        'ini' => $dirs['private'] . '/config.ini',
// ===============================================
// === repository
// =============================================== 
        'base_repository' => $dirs['repository'] . '/Base_Bepository.php',
        'user_repository' => $dirs['repository'] . '/User_Repository.php',
// ===============================================
// === utilities
// =============================================== 
        'google_analytics_tracking' => $dirs['utilities'] . '/google/analytics_tracking.php',
// ===============================================
// === web / base
// ===============================================
        'about' => $urls['web/base'] . '/about.php',
        'activate' => $urls['web/base'] . '/activate.php',
        'admin' => $urls['web/base'] . '/admin.php',
        'change_password' => $urls['web/base'] . '/change_password.php',
        'check_user_profile' => $urls['web/base'] . '/check_user_profile.php',
        'login' => $urls['web/base'] . '/login.php',
        'logout' => $urls['web/base'] . '/logout.php',
        'mass_mail' => $urls['web/base'] . '/mass_mail.php',
        'profile' => $urls['web/base'] . '/profile.php',
        'profile_completeness' => $urls['web/base'] . '/profile_completeness.php',
        'protected' => $urls['web/base'] . '/protected.php',
        'recover' => $urls['web/base'] . '/recover.php',
        'redirect_to_recover' => $urls['web/base'] . '/redirect_to_recover.php',
        'register' => $urls['web/base'] . '/register.php',
        'register_pre' => $urls['web/base'] . '/register_pre.php',
        'role' => $urls['web/base'] . '/role.php',
        'settings' => $urls['web/base'] . '/settings.php',
        'settings_band_members' => $urls['web/base'] . '/settings_band_members.php',
// ===============================================
// === web / base / forms
// ===============================================
        'login_form' => $dirs['web/base/forms'] . '/login_form.php',
        'change_password_form' => $dirs['web/base/forms'] . '/change_password_form.php',
        'settings_form' => $dirs['web/base/forms'] . '/settings_form.php',
        'update_band_members_form' => $dirs['web/base/forms'] . '/update_band_members_form.php',
        'create_band_members_form' => $dirs['web/base/forms'] . '/create_band_members_form.php',
        'delete_band_members_form' => $dirs['web/base/forms'] . '/delete_band_members_form.php',
        'register_form' => $dirs['web/base/forms'] . '/register_form.php',
        'register_pre_form' => $dirs['web/base/forms'] . '/register_pre_form.php',
        'mass_mail_form' => $dirs['web/base/forms'] . '/mass_mail_form.php',
        'recover_form' => $dirs['web/base/forms'] . '/recover_form.php',
        'change_user_image_form' => $dirs['web/base/forms'] . '/change_user_image_form.php',
// =============================================== 
// === web / base / forms / includes
// ===============================================
        'input_token_csrf' => $dirs['web/base/forms/includes'] . '/input_token_csrf.php',
        'input_token_csrf_form_1' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_1.php',
        'input_token_csrf_form_2' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_2.php',
        'input_token_csrf_form_3' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_3.php',
        'input_token_csrf_form_4' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_4.php',
        'input_token_csrf_form_5' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_5.php',
        'input_token_csrf_form_6' => $dirs['web/base/forms/includes'] . '/input_token_csrf_form_6.php',
        'register_begin' => $dirs['web/base/forms/includes'] . '/register_begin.php',
        'register_end' => $dirs['web/base/forms/includes'] . '/register_end.php',
        'settings_end' => $dirs['web/base/forms/includes'] . '/settings_end.php',
        'settings_musician' => $dirs['web/base/forms/includes'] . '/settings_musician.php',
        'settings_band' => $dirs['web/base/forms/includes'] . '/settings_band.php',
        'settings_agent' => $dirs['web/base/forms/includes'] . '/settings_agent.php',
        'generic_end' => $dirs['web/base/forms/includes'] . '/generic_end.php',
        'generic_end_no_reset' => $dirs['web/base/forms/includes'] . '/generic_end_no_reset.php',
// ===============================================
// === web / chat
// ===============================================
        'chat' => $urls['web/chat'] . '/chat.php',
        'check_user_can_chat' => $urls['web/chat'] . '/check_user_can_chat.php',
// ===============================================
// === web / exp
// ===============================================
        'experience_musician_alone' => $urls['web/exp'] . '/experience_musician_alone.php',
        'experience_musician_bands' => $urls['web/exp'] . '/experience_musician_bands.php',
        'experience_agent' => $urls['web/exp'] . '/experience_agent.php',
        'experience_band' => $urls['web/exp'] . '/experience_band.php',
// ===============================================
// === web /exp /forms
// ===============================================
//musician bands exp
        'update_experience_musician_bands_form' => $dirs['web/exp/forms'] . '/update_experience_musician_bands_form.php',
        'delete_experience_musician_bands_form' => $dirs['web/exp/forms'] . '/delete_experience_musician_bands_form.php',
        'create_experience_musician_bands_form' => $dirs['web/exp/forms'] . '/create_experience_musician_bands_form.php',
        //musician alone exp
        'create_experience_musician_alone_form' => $dirs['web/exp/forms'] . '/create_experience_musician_alone_form.php',
        'delete_experience_musician_alone_form' => $dirs['web/exp/forms'] . '/delete_experience_musician_alone_form.php',
        'update_experience_musician_alone_form' => $dirs['web/exp/forms'] . '/update_experience_musician_alone_form.php',
        //band exp
        'update_experience_band_form' => $dirs['web/exp/forms'] . '/update_experience_band_form.php',
        'delete_experience_band_form' => $dirs['web/exp/forms'] . '/delete_experience_band_form.php',
        'create_experience_band_form' => $dirs['web/exp/forms'] . '/create_experience_band_form.php',
        //agent exp
        'update_experience_agent_form' => $dirs['web/exp/forms'] . '/update_experience_agent_form.php',
        'delete_experience_agent_form' => $dirs['web/exp/forms'] . '/delete_experience_agent_form.php',
        'create_experience_agent_form' => $dirs['web/exp/forms'] . '/create_experience_agent_form.php',
// ===============================================
// === web / footer
// ===============================================
        'contact' => $urls['web/footer'] . '/contact.php',
        'terms' => $urls['web/footer'] . '/terms.php',
        'privacy' => $urls['web/footer'] . '/privacy.php',
// ===============================================
// === web / footer / includes
// ===============================================
        'footer_intro_def' => $dirs['web/footer'] . '/includes/footer_intro_def.php',
// ===============================================
// === web / invitation
// ===============================================
        'invitations' => $urls['web/invitation'] . '/invitations.php',
// ===============================================
// === web / matches
// ===============================================
        'matches' => $urls['web/matches'] . '/matches.php',
// ===============================================
// === web / messages
// ===============================================
        'messages' => $urls['web/messages'] . '/messages.php',
// ===============================================
// === web / premium
// ===============================================        
        'premium' => $urls['web/premium'] . '/premium.php',
        'paypal_checkout' => $urls['web/premium'] . '/paypal_checkout.php',
        'revoke_premium' => $urls['web/premium'] . '/revoke_premium.php',
        'paypal_pay' => $urls['web/premium'] . '/paypal_pay.php',
// ===============================================
// === web / premium / forms
// ===============================================  
        'paypal_form' => $dirs['web/premium/forms'] . '/paypal_form.php',
        'become_premium_form' => $dirs['web/premium/forms'] . '/become_premium_form.php',
        'revoke_premium_form' => $dirs['web/premium/forms'] . '/revoke_premium_form.php',
        'premium_about_to_end_form' => $dirs['web/premium/forms'] . '/premium_about_to_end_form.php',
// ===============================================
// === web / premium / includes
// ===============================================  
        'premium_comparison' => $dirs['web/premium/includes'] . '/premium_comparison.php',
        'premium_faq' => $dirs['web/premium/includes'] . '/premium_faq.php',
// ===============================================
// === web / messages / includes
// ===============================================
        'message_user_to_user_form' => $dirs['web/messages/forms'] . '/message_user_to_user_form.php',
// ===============================================
// === web / pursuit
// ===============================================
        'pursuit' => $urls['web/pursuit'] . '/pursuit.php',
// ===============================================
// === web / pursuit / forms
// ===============================================
        'create_pursuit_form' => $dirs['web/pursuit/forms'] . '/create_pursuit_form.php',
        'delete_pursuit_form' => $dirs['web/pursuit/forms'] . '/delete_pursuit_form.php',
        'update_pursuit_form' => $dirs['web/pursuit/forms'] . '/update_pursuit_form.php',
// ===============================================
// === web / pursuit / includes
// ===============================================
        'index_pursuits_lists' => $dirs['web/pursuit/includes'] . '/index_pursuits_lists.php',
// ===============================================
// === web / search / by_pursuit
// ===============================================
        'search_by_pursuit' => $urls['web/search/by_pursuit'] . '/search_by_pursuit.php',
// ===============================================
// === web / search / overall
// ===============================================
        'search_overall' => $urls['web/search/overall'] . '/search_overall.php',
// ===============================================
// === web / search_ / overall /includes
// ===============================================
        'search_overall_filter' => $dirs['web/search/overall'] . '/includes/search_overall_filter.php',
        'search_overall_panel_musician' => $dirs['web/search/overall'] . '/includes/search_overall_panel_musician.php',
        'search_overall_panel_band' => $dirs['web/search/overall'] . '/includes/search_overall_panel_band.php',
        'search_overall_panel_agent' => $dirs['web/search/overall'] . '/includes/search_overall_panel_agent.php',
// ===============================================
// === others
// ===============================================
    ),
    'allowed_file_type' => array(
        'images' => [
            'jpg',
            'jpeg',
            'gif',
            'png'
        ]
    ),
    'company' => array(
        'name' => $company_name,
    ),
    'site' => array(
        'title' => $title,
    ),
    'project_state' => $project_state,
);


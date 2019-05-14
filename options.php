<?php
/**
 * Description: Options Framework Code
 *
 * @package MistNet.ai
 * @subpackage Options
 * @author Luis Franco
 * @version 1.0
 */

/**
 * Theme identifier
 */
function optionsframework_option_name() {
    // Theme name (lowercase and without spaces)
    $themename = preg_replace("/\W/", "_", strtolower(get_option('stylesheet')) );

    $options_framework_settings          = get_option('optionsframework');
    $options_framework_settings['id']    = $themename;
    update_option('optionsframework', $options_framework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 * @since  0.1.0
 * @version  1.0
 * @return  array Array of options
 */
function optionsframework_options() {

    $options = [];

    $options[] = [
        'name'  =>  __('Basic Settings', 'mistnet_theme'),
        'type'  =>  'heading'
    ];

    $options[] = [
        'id'    =>  'theme_default_logo',
        'name'  =>  __('Theme Default Logo', 'mistnet_theme'),
        'type'  =>  'upload',
        'std'		=>	'',
    ];

    $options[] = [
        'id'    =>  'theme_social_media_logo',
        'name'  =>  __('Social Media Logo URL', 'mistnet_theme'),
        'type'  =>  'upload',
        'std'		=>	'',
    ];

    $options[] = [
        'id'    =>  'theme_favicon_url',
        'name'  =>  __('Favicon URL', 'mistnet_theme'),
        'type'  =>  'upload',
        'std'		=>	'',
    ];

    $options[] = [
        'id'    =>  'google_analytics_id',
        'name'  =>  __('Google Analytics ID', 'mistnet_theme'),
        'desc'  =>  __('e.g. UA-802001-11', 'mistnet_theme'),
        'type'  =>  'text',
        'class' =>  'mini',
    ];

    $options[] = [
        'id'    =>  'domain_path',
        'name'  =>  __('WP Domain Path', 'mistnet_theme'),
        'desc'  =>  __('Blue Host Temp URL is a  domain with a subfolder, remove this when going live.', 'mistnet_theme'),
        'type'  =>  'text',
        'class' =>  'normal',
        'std'   =>  ''
    ];

    $options[] = [
        'name'  =>  __('Static Resources', 'mistnet_theme'),
        'type'  =>  'heading'
    ];

    $options[] = [
        'id'    =>  'css_version',
        'name'  =>  __('CSS Version', 'mistnet_theme'),
        'desc'  =>  __('CSS Version', 'mistnet_theme'),
        'type'  =>  'text',
        'std'   =>  '20190514',
    ];

    $options[] = [
        'id'    =>  'js_version',
        'name'  =>  __('JS Version', 'mistnet_theme'),
        'desc'  =>  __('JS Version', 'mistnet_theme'),
        'type'  =>  'text',
        'std'   =>  '20190514',
    ];

    $options[] = [
        'name'  =>  __('Social Media', 'mistnet_theme'),
        'type'  =>  'heading'
    ];

    $options[] = [
        'id'    =>  'social_media_logo',
        'name'  =>  __('Social Media Logo URL', 'mistnet_theme'),
        'desc'  =>  __('The one that will show up in social media', 'mistnet_theme'),
        'type'  =>  'text',
    ];

    $options[] = [
        'id'    =>  'site_publisher_id',
        'name'  =>  __('Publisher Markup ID', 'mistnet_theme'),
        'desc'  =>  __( "The Publisher's URL: usually the front page URL", 'mistnet_theme' ),
        'type'  =>  'text',
        'class' =>  'normal'
    ];

    $options[] = [
        'id'    =>  'twitter_site_username',
        'name'  =>  __('Twitter Site Username @', 'mistnet_theme'),
        'desc'  =>  __( '@username', 'mistnet_theme' ),
        'type'  =>  'text',
        'class' =>  'normal'
    ];

    $options[] = [
        'id'        =>  'twitter_card_type',
        'name'      =>  __('Twitter Card Type', 'mistnet_theme'),
        'desc'      =>  __( 'The type card.  Player will fall back to photo if no video.  Photo (or video that fell back to photo) will fall back to summary if no photo', 'mistnet_theme' ),
        'type'      =>  'select',
        'class'     =>  'normal',
        'std'       =>  'summary',
        'options'       =>  array(
            'player'    =>  __('Video Player', 'mistnet_theme'),
            'photo'     =>  __('Photo', 'mistnet_theme'),
            'summary'   =>  __('Summary', 'mistnet_theme'),
        ),
    ];

    $options[] = [
        'id'    =>  'linkedin_url',
        'name'  =>  __('LinkedIn URL', 'mistnet_theme'),
        'desc'  =>  __( 'The URL to the LikedIn account', 'mistnet_theme' ),
        'type'  =>  'text',
        'class' =>  'normal'
    ];

    $options[] = [
        'name'  =>  __('Custom HTML', 'mistnet_theme'),
        'type'  =>  'heading'
    ];

    $options[] = [
        'id'    =>  'above_widget_area',
        'name'  =>  __('Above Main Widget Area', 'mistnet_theme'),
        'desc'  =>  __('Custom HTML Present on the above Main Area', 'mistnet_theme'),
        'type'  =>  'textarea',
    ];

    $options[] = [
        'id'    =>  'below_widget_area',
        'name'  =>  __('Below Main Widget Area', 'mistnet_theme'),
        'desc'  =>  __('Custom HTML Present below the Main Area', 'mistnet_theme'),
        'type'  =>  'textarea',
    ];

    $options[] = [
        'name'  =>  __('Advanced', 'mistnet_theme'),
        'type'  =>  'heading'
    ];

    $options[] = [
        'id'    =>  'is_development',
        'name'  =>  __('Development', 'mistnet_theme'),
        'desc'  =>  __('Check if you are using the Temp domain from Blue Host', 'mistnet_theme'),
        'type'  =>  'checkbox',
    ];

    return $options;
}
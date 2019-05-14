<?php
/**
 * User: Luis Franco
 * Date: 5/9/19
 */

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class mistNetSite extends Timber\Site {
    /** Add timber support. */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
        add_filter( 'timber/context', array( $this, 'add_to_context' ) );
        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'init', array( $this, 'register_mistnet_menus' ) );
        parent::__construct();
    }


    /** This is where you can register custom post types. */
    public function register_post_types() {

    }

    /** This is where you can register custom taxonomies. */
    public function register_taxonomies() {

    }

    public function register_mistnet_menus() {
        register_nav_menus( array(
            'topnav'    => __( 'Top Navigation Menu' ),
            'footernav' => __( 'Footer Navigation Menu' ),
        ) );
    }

    /**
     * Returns the context.
     *
     * @param $context
     *
     * @return mixed
     */
    public function add_to_context( $context ) {

        $tmp_subfolder = of_get_option( 'is_development' ) ? '/~mistneta' : '';

        $context['static_path'] = "$tmp_subfolder/wp-content/themes/mistneta/static";
        $context['assets']      = "$tmp_subfolder/wp-content/themes/mistneta/assets";
        $context['domain_path'] = of_get_option( 'domain_path' );

        $context['social_media'] = $this->get_social_media_data();
        $context['custom_html']  = $this->get_custom_html();
        $context['breadcrumbs']  = $this->get_breadcrumbs();
        $context['analytics']    = $this->get_analytics_data();

        if ( function_exists( 'yoast_breadcrumb' ) ) {
            $context['custom_html'] = $this->get_custom_html();
        }

        $context['menu']['topnav']    = new Timber\Menu( 'topnav' );
        $context['menu']['footernav'] = new Timber\Menu( 'footernav' );
        $context['site']              = $this;

        return $context;
    }

    public function get_social_media_data() {
        return [
            'twitter_username' => of_get_option( 'twitter_site_username' ),
            'linkedin_url'     => of_get_option( 'linkedin_url' ),
            'theme_logo'       => of_get_option( 'theme_default_logo' ),
        ];
    }

    public function get_custom_html() {
        return [
            'above' => of_get_option( 'above_widget_area' ),
            'below' => of_get_option( 'below_widget_area' ),
        ];
    }

    /**
     * If yoast_breadcrumb function exists, returns SEO Yoast Breadcrumbs HTML
     * @return string
     */
    public function get_breadcrumbs() {
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            return yoast_breadcrumb( '', '', false );
        }

        return '';
    }

    public function get_analytics_data() {
        return [ 'google_analytics_id' => of_get_option( 'google_analytics_id' ) ];
    }


    public function theme_supports() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        ) );

        add_theme_support( 'menus' );
    }

    /**
     * Returns a `slug` ready string.
     *
     * @param $text
     *
     * @return string
     */
    public function slugify_string( $text ) {
        return preg_replace( '@\s+@i', '-', strip_tags( strtolower( $text ) ) );
    }

    /** This is where you can add your own functions to twig.
     *
     * @param string $twig get extension.
     *
     * @return mixed
     */
    public function add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        $twig->addFilter( new Twig_SimpleFilter( 'slugify_string', array( $this, 'slugify_string' ) ) );

        return $twig;
    }

}
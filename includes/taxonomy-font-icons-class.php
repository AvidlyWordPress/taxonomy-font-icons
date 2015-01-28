<?php
/**
 * Plugin main class.
 *
 * @since 1.0
 */
class Taxonomy_Font_Icons {

	// Public variables
	public $taxonomy_font_icons_option;
	public $taxonomies;
	public $font;
	public $stylesheet;
	public $icons;

	function __construct() {

		// Set the wp_options option name
		$this->taxonomy_font_icons_option = '_taxonomy_font_icons';

		// Plugin init
		add_action( 'init', array( $this, 'plugin_init' ) );
	}

	/**
	 * Plugin activation.
	 *
	 * Creates the '_taxonomy_font_icons' wp_option if it doesn't exist.
	 *
	 * @since 1.0
	 */
	public function plugin_activation() {

		$tfi_icons = get_option( '_taxonomy_font_icons' );

		if ( empty( $tfi_icons ) ) {
			update_option( '_taxonomy_font_icons', '' );
		}
	}

	/**
	 * Plugin unistall.
	 *
	 * Remove the '_taxonomy_font_icons' option from wp_options.
	 *
	 * @since 1.0
	 */
	public function plugin_uninstall() {

		delete_option( '_taxonomy_font_icons' );
	}

	/**
	 * Plugin init.
	 *
	 * @since 1.0
	 */
	public function plugin_init() {

		// Get the default args
		$args = $this->default_args();

		// Set up the public variables
		$this->taxonomies = $args['taxonomies'];
		$this->font       = $args['font'];
		$this->stylesheet = $args['stylesheet'];
		$this->icons      = $args['icons'];

		// Add icon select to the defined taxonomies
		foreach ( $this->taxonomies as $taxonomy ) {

			// Add icon select
			add_action( $taxonomy . '_add_form_fields', array( $this, 'add_taxonomy_icon' ) );
			add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_taxonomy_icon' ) );

			// Save icon to wp_options
			add_action( 'edited_' . $taxonomy, array( $this, 'save_taxonomy_icon' ), 10, 2 );
			add_action( 'create_' . $taxonomy, array( $this, 'save_taxonomy_icon' ), 10, 2 );
		}

		// Enqueue stylesheets
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_stylesheets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_stylesheets' ) );
	}

	/**
	 * Default args.
	 *
	 * Use apply_filters( 'taxicon_filters_default_args', $args ); to modify the default values.
	 *
	 * @since 1.0
	 */
	public function default_args() {

		$args = array(
			'taxonomies' => array( 'category', 'post_tag' ),
			'font'       => 'FontAwesome',
			'stylesheet' => 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"',
			'icons'      => array(
				'fa fa-adjust'               => '&#xf042;',
				'fa fa-adn'                  => '&#xf170;',
				'fa fa-align-center'         => '&#xf037;',
				'fa fa-align-justify'        => '&#xf039;',
				'fa fa-align-left'           => '&#xf036;',
				'fa fa-align-right'          => '&#xf038;',
				'fa fa-ambulance'            => '&#xf0f9;',
				'fa fa-anchor'               => '&#xf13d;',
				'fa fa-android'              => '&#xf17b;',
				'fa fa-angellist'            => '&#xf209;',
				'fa fa-angle-double-down'    => '&#xf103;',
				'fa fa-angle-double-left'    => '&#xf100;',
				'fa fa-angle-double-right'   => '&#xf101;',
				'fa fa-angle-double-up'      => '&#xf102;',
				'fa fa-angle-down'           => '&#xf107;',
				'fa fa-angle-left'           => '&#xf104;',
				'fa fa-angle-right'          => '&#xf105;',
				'fa fa-angle-up'             => '&#xf106;',
				'fa fa-apple'                => '&#xf179;',
				'fa fa-archive'              => '&#xf187;',
				'fa fa-area-chart'           => '&#xf1fe;',
				'fa fa-arrow-circle-down'    => '&#xf0ab;',
				'fa fa-arrow-circle-left'    => '&#xf0a8;',
				'fa fa-arrow-circle-o-down'  => '&#xf01a;',
				'fa fa-arrow-circle-o-left'  => '&#xf190;',
				'fa fa-arrow-circle-o-right' => '&#xf18e;',
				'fa fa-arrow-circle-o-up'    => '&#xf01b;',
				'fa fa-arrow-circle-right'   => '&#xf0a9;',
				'fa fa-arrow-circle-up'      => '&#xf0aa;',
				'fa fa-arrow-down'           => '&#xf063;',
				'fa fa-arrow-left'           => '&#xf060;',
				'fa fa-arrow-right'          => '&#xf061;',
				'fa fa-arrow-up'             => '&#xf062;',
				'fa fa-arrows'               => '&#xf047;',
				'fa fa-arrows-alt'           => '&#xf0b2;',
				'fa fa-arrows-h'             => '&#xf07e;',
				'fa fa-arrows-v'             => '&#xf07d;',
				'fa fa-asterisk'             => '&#xf069;',
				'fa fa-at'                   => '&#xf1fa;',
				'fa fa-automobile'           => '&#xf1b9;',
				'fa fa-backward'             => '&#xf04a;',
				'fa fa-ban'                  => '&#xf05e;',
				'fa fa-bank'                 => '&#xf19c;',
				'fa fa-bar-chart'            => '&#xf080;',
				'fa fa-bar-chart-o'          => '&#xf080;',
				'fa fa-barcode'              => '&#xf02a;',
				'fa fa-bars'                 => '&#xf0c9;',
				'fa fa-bed'                  => '&#xf236;',
				'fa fa-beer'                 => '&#xf0fc;',
				'fa fa-behance'              => '&#xf1b4;',
				'fa fa-behance-square'       => '&#xf1b5;',
				'fa fa-bell'                 => '&#xf0f3;',
				'fa fa-bell-o'               => '&#xf0a2;',
				'fa fa-bell-slash'           => '&#xf1f6;',
				'fa fa-bell-slash-o'         => '&#xf1f7;',
				'fa fa-bicycle'              => '&#xf206;',
				'fa fa-binoculars'           => '&#xf1e5;',
				'fa fa-birthday-cake'        => '&#xf1fd;',
				'fa fa-bitbucket'            => '&#xf171;',
				'fa fa-bitbucket-square'     => '&#xf172;',
				'fa fa-bitcoin'              => '&#xf15a;',
				'fa fa-bold'                 => '&#xf032;',
				'fa fa-bolt'                 => '&#xf0e7;',
				'fa fa-bomb'                 => '&#xf1e2;',
				'fa fa-book'                 => '&#xf02d;',
				'fa fa-bookmark'             => '&#xf02e;',
				'fa fa-bookmark-o'           => '&#xf097;',
				'fa fa-briefcase'            => '&#xf0b1;',
				'fa fa-btc'                  => '&#xf15a;',
				'fa fa-bug'                  => '&#xf188;',
				'fa fa-building'             => '&#xf1ad;',
				'fa fa-building-o'           => '&#xf0f7;',
				'fa fa-bullhorn'             => '&#xf0a1;',
				'fa fa-bullseye'             => '&#xf140;',
				'fa fa-bus'                  => '&#xf207;',
				'fa fa-buysellads'           => '&#xf20d;',
				'fa fa-cab'                  => '&#xf1ba;',
				'fa fa-calculator'           => '&#xf1ec;',
				'fa fa-calendar'             => '&#xf073;',
				'fa fa-calendar-o'           => '&#xf133;',
				'fa fa-camera'               => '&#xf030;',
				'fa fa-camera-retro'         => '&#xf083;',
				'fa fa-car'                  => '&#xf1b9;',
				'fa fa-caret-down'           => '&#xf0d7;',
				'fa fa-caret-left'           => '&#xf0d9;',
				'fa fa-caret-right'          => '&#xf0da;',
				'fa fa-caret-square-o-down'  => '&#xf150;',
				'fa fa-caret-square-o-left'  => '&#xf191;',
				'fa fa-caret-square-o-right' => '&#xf152;',
				'fa fa-caret-square-o-up'    => '&#xf151;',
				'fa fa-caret-up'             => '&#xf0d8;',
				'fa fa-cart-arrow-down'      => '&#xf218;',
				'fa fa-cart-plus'            => '&#xf217;',
				'fa fa-cc'                   => '&#xf20a;',
				'fa fa-cc-amex'              => '&#xf1f3;',
				'fa fa-cc-discover'          => '&#xf1f2;',
				'fa fa-cc-mastercard'        => '&#xf1f1;',
				'fa fa-cc-paypal'            => '&#xf1f4;',
				'fa fa-cc-stripe'            => '&#xf1f5;',
				'fa fa-cc-visa'              => '&#xf1f0;',
				'fa fa-certificate'          => '&#xf0a3;',
				'fa fa-chain'                => '&#xf0c1;',
				'fa fa-chain-broken'         => '&#xf127;',
				'fa fa-check'                => '&#xf00c;',
				'fa fa-check-circle'         => '&#xf058;',
				'fa fa-check-circle-o'       => '&#xf05d;',
				'fa fa-check-square'         => '&#xf14a;',
				'fa fa-check-square-o'       => '&#xf046;',
				'fa fa-chevron-circle-down'  => '&#xf13a;',
				'fa fa-chevron-circle-left'  => '&#xf137;',
				'fa fa-chevron-circle-right' => '&#xf138;',
				'fa fa-chevron-circle-up'    => '&#xf139;',
				'fa fa-chevron-down'         => '&#xf078;',
				'fa fa-chevron-left'         => '&#xf053;',
				'fa fa-chevron-right'        => '&#xf054;',
				'fa fa-chevron-up'           => '&#xf077;',
				'fa fa-child'                => '&#xf1ae;',
				'fa fa-circle'               => '&#xf111;',
				'fa fa-circle-o'             => '&#xf10c;',
				'fa fa-circle-o-notch'       => '&#xf1ce;',
				'fa fa-circle-thin'          => '&#xf1db;',
				'fa fa-clipboard'            => '&#xf0ea;',
				'fa fa-clock-o'              => '&#xf017;',
				'fa fa-close'                => '&#xf00d;',
				'fa fa-cloud'                => '&#xf0c2;',
				'fa fa-cloud-download'       => '&#xf0ed;',
				'fa fa-cloud-upload'         => '&#xf0ee;',
				'fa fa-cny'                  => '&#xf157;',
				'fa fa-code'                 => '&#xf121;',
				'fa fa-code-fork'            => '&#xf126;',
				'fa fa-codepen'              => '&#xf1cb;',
				'fa fa-coffee'               => '&#xf0f4;',
				'fa fa-cog'                  => '&#xf013;',
				'fa fa-cogs'                 => '&#xf085;',
				'fa fa-columns'              => '&#xf0db;',
				'fa fa-comment'              => '&#xf075;',
				'fa fa-comment-o'            => '&#xf0e5;',
				'fa fa-comments'             => '&#xf086;',
				'fa fa-comments-o'           => '&#xf0e6;',
				'fa fa-compass'              => '&#xf14e;',
				'fa fa-compress'             => '&#xf066;',
				'fa fa-connectdevelop'       => '&#xf20e;',
				'fa fa-copy'                 => '&#xf0c5;',
				'fa fa-copyright'            => '&#xf1f9;',
				'fa fa-credit-card'          => '&#xf09d;',
				'fa fa-crop'                 => '&#xf125;',
				'fa fa-crosshairs'           => '&#xf05b;',
				'fa fa-css3'                 => '&#xf13c;',
				'fa fa-cube'                 => '&#xf1b2;',
				'fa fa-cubes'                => '&#xf1b3;',
				'fa fa-cut'                  => '&#xf0c4;',
				'fa fa-cutlery'              => '&#xf0f5;',
				'fa fa-dashboard'            => '&#xf0e4;',
				'fa fa-dashcube'             => '&#xf210;',
				'fa fa-database'             => '&#xf1c0;',
				'fa fa-dedent'               => '&#xf03b;',
				'fa fa-delicious'            => '&#xf1a5;',
				'fa fa-desktop'              => '&#xf108;',
				'fa fa-deviantart'           => '&#xf1bd;',
				'fa fa-diamond'              => '&#xf219;',
				'fa fa-digg'                 => '&#xf1a6;',
				'fa fa-dollar'               => '&#xf155;',
				'fa fa-dot-circle-o'         => '&#xf192;',
				'fa fa-download'             => '&#xf019;',
				'fa fa-dribbble'             => '&#xf17d;',
				'fa fa-dropbox'              => '&#xf16b;',
				'fa fa-drupal'               => '&#xf1a9;',
				'fa fa-edit'                 => '&#xf044;',
				'fa fa-eject'                => '&#xf052;',
				'fa fa-ellipsis-h'           => '&#xf141;',
				'fa fa-ellipsis-v'           => '&#xf142;',
				'fa fa-empire'               => '&#xf1d1;',
				'fa fa-envelope'             => '&#xf0e0;',
				'fa fa-envelope-o'           => '&#xf003;',
				'fa fa-envelope-square'      => '&#xf199;',
				'fa fa-eraser'               => '&#xf12d;',
				'fa fa-eur'                  => '&#xf153;',
				'fa fa-euro'                 => '&#xf153;',
				'fa fa-exchange'             => '&#xf0ec;',
				'fa fa-exclamation'          => '&#xf12a;',
				'fa fa-exclamation-circle'   => '&#xf06a;',
				'fa fa-exclamation-triangle' => '&#xf071;',
				'fa fa-expand'               => '&#xf065;',
				'fa fa-external-link'        => '&#xf08e;',
				'fa fa-external-link-square' => '&#xf14c;',
				'fa fa-eye'                  => '&#xf06e;',
				'fa fa-eye-slash'            => '&#xf070;',
				'fa fa-eyedropper'           => '&#xf1fb;',
				'fa fa-facebook'             => '&#xf09a;',
				'fa fa-facebook-f'           => '&#xf09a;',
				'fa fa-facebook-official'    => '&#xf230;',
				'fa fa-facebook-square'      => '&#xf082;',
				'fa fa-fast-backward'        => '&#xf049;',
				'fa fa-fast-forward'         => '&#xf050;',
				'fa fa-fax'                  => '&#xf1ac;',
				'fa fa-female'               => '&#xf182;',
				'fa fa-fighter-jet'          => '&#xf0fb;',
				'fa fa-file'                 => '&#xf15b;',
				'fa fa-file-archive-o'       => '&#xf1c6;',
				'fa fa-file-audio-o'         => '&#xf1c7;',
				'fa fa-file-code-o'          => '&#xf1c9;',
				'fa fa-file-excel-o'         => '&#xf1c3;',
				'fa fa-file-image-o'         => '&#xf1c5;',
				'fa fa-file-movie-o'         => '&#xf1c8;',
				'fa fa-file-o'               => '&#xf016;',
				'fa fa-file-pdf-o'           => '&#xf1c1;',
				'fa fa-file-photo-o'         => '&#xf1c5;',
				'fa fa-file-picture-o'       => '&#xf1c5;',
				'fa fa-file-powerpoint-o'    => '&#xf1c4;',
				'fa fa-file-sound-o'         => '&#xf1c7;',
				'fa fa-file-text'            => '&#xf15c;',
				'fa fa-file-text-o'          => '&#xf0f6;',
				'fa fa-file-video-o'         => '&#xf1c8;',
				'fa fa-file-word-o'          => '&#xf1c2;',
				'fa fa-file-zip-o'           => '&#xf1c6;',
				'fa fa-files-o'              => '&#xf0c5;',
				'fa fa-film'                 => '&#xf008;',
				'fa fa-filter'               => '&#xf0b0;',
				'fa fa-fire'                 => '&#xf06d;',
				'fa fa-fire-extinguisher'    => '&#xf134;',
				'fa fa-flag'                 => '&#xf024;',
				'fa fa-flag-checkered'       => '&#xf11e;',
				'fa fa-flag-o'               => '&#xf11d;',
				'fa fa-flash'                => '&#xf0e7;',
				'fa fa-flask'                => '&#xf0c3;',
				'fa fa-flickr'               => '&#xf16e;',
				'fa fa-floppy-o'             => '&#xf0c7;',
				'fa fa-folder'               => '&#xf07b;',
				'fa fa-folder-o'             => '&#xf114;',
				'fa fa-folder-open'          => '&#xf07c;',
				'fa fa-folder-open-o'        => '&#xf115;',
				'fa fa-font'                 => '&#xf031;',
				'fa fa-forumbee'             => '&#xf211;',
				'fa fa-forward'              => '&#xf04e;',
				'fa fa-foursquare'           => '&#xf180;',
				'fa fa-frown-o'              => '&#xf119;',
				'fa fa-futbol-o'             => '&#xf1e3;',
				'fa fa-gamepad'              => '&#xf11b;',
				'fa fa-gavel'                => '&#xf0e3;',
				'fa fa-gbp'                  => '&#xf154;',
				'fa fa-ge'                   => '&#xf1d1;',
				'fa fa-gear'                 => '&#xf013;',
				'fa fa-gears'                => '&#xf085;',
				'fa fa-genderless'           => '&#xf1db;',
				'fa fa-gift'                 => '&#xf06b;',
				'fa fa-git'                  => '&#xf1d3;',
				'fa fa-git-square'           => '&#xf1d2;',
				'fa fa-github'               => '&#xf09b;',
				'fa fa-github-alt'           => '&#xf113;',
				'fa fa-github-square'        => '&#xf092;',
				'fa fa-gittip'               => '&#xf184;',
				'fa fa-glass'                => '&#xf000;',
				'fa fa-globe'                => '&#xf0ac;',
				'fa fa-google'               => '&#xf1a0;',
				'fa fa-google-plus'          => '&#xf0d5;',
				'fa fa-google-plus-square'   => '&#xf0d4;',
				'fa fa-google-wallet'        => '&#xf1ee;',
				'fa fa-graduation-cap'       => '&#xf19d;',
				'fa fa-gratipay'             => '&#xf184;',
				'fa fa-group'                => '&#xf0c0;',
				'fa fa-h-square'             => '&#xf0fd;',
				'fa fa-hacker-news'          => '&#xf1d4;',
				'fa fa-hand-o-down'          => '&#xf0a7;',
				'fa fa-hand-o-left'          => '&#xf0a5;',
				'fa fa-hand-o-right'         => '&#xf0a4;',
				'fa fa-hand-o-up'            => '&#xf0a6;',
				'fa fa-hdd-o'                => '&#xf0a0;',
				'fa fa-header'               => '&#xf1dc;',
				'fa fa-headphones'           => '&#xf025;',
				'fa fa-heart'                => '&#xf004;',
				'fa fa-heart-o'              => '&#xf08a;',
				'fa fa-heartbeat'            => '&#xf21e;',
				'fa fa-history'              => '&#xf1da;',
				'fa fa-home'                 => '&#xf015;',
				'fa fa-hospital-o'           => '&#xf0f8;',
				'fa fa-hotel'                => '&#xf236;',
				'fa fa-html5'                => '&#xf13b;',
				'fa fa-ils'                  => '&#xf20b;',
				'fa fa-image'                => '&#xf03e;',
				'fa fa-inbox'                => '&#xf01c;',
				'fa fa-indent'               => '&#xf03c;',
				'fa fa-info'                 => '&#xf129;',
				'fa fa-info-circle'          => '&#xf05a;',
				'fa fa-inr'                  => '&#xf156;',
				'fa fa-instagram'            => '&#xf16d;',
				'fa fa-institution'          => '&#xf19c;',
				'fa fa-ioxhost'              => '&#xf208;',
				'fa fa-italic'               => '&#xf033;',
				'fa fa-joomla'               => '&#xf1aa;',
				'fa fa-jpy'                  => '&#xf157;',
				'fa fa-jsfiddle'             => '&#xf1cc;',
				'fa fa-key'                  => '&#xf084;',
				'fa fa-keyboard-o'           => '&#xf11c;',
				'fa fa-krw'                  => '&#xf159;',
				'fa fa-language'             => '&#xf1ab;',
				'fa fa-laptop'               => '&#xf109;',
				'fa fa-lastfm'               => '&#xf202;',
				'fa fa-lastfm-square'        => '&#xf203;',
				'fa fa-leaf'                 => '&#xf06c;',
				'fa fa-leanpub'              => '&#xf212;',
				'fa fa-legal'                => '&#xf0e3;',
				'fa fa-lemon-o'              => '&#xf094;',
				'fa fa-level-down'           => '&#xf149;',
				'fa fa-level-up'             => '&#xf148;',
				'fa fa-life-bouy'            => '&#xf1cd;',
				'fa fa-life-buoy'            => '&#xf1cd;',
				'fa fa-life-ring'            => '&#xf1cd;',
				'fa fa-life-saver'           => '&#xf1cd;',
				'fa fa-lightbulb-o'          => '&#xf0eb;',
				'fa fa-line-chart'           => '&#xf201;',
				'fa fa-link'                 => '&#xf0c1;',
				'fa fa-linkedin'             => '&#xf0e1;',
				'fa fa-linkedin-square'      => '&#xf08c;',
				'fa fa-linux'                => '&#xf17c;',
				'fa fa-list'                 => '&#xf03a;',
				'fa fa-list-alt'             => '&#xf022;',
				'fa fa-list-ol'              => '&#xf0cb;',
				'fa fa-list-ul'              => '&#xf0ca;',
				'fa fa-location-arrow'       => '&#xf124;',
				'fa fa-lock'                 => '&#xf023;',
				'fa fa-long-arrow-down'      => '&#xf175;',
				'fa fa-long-arrow-left'      => '&#xf177;',
				'fa fa-long-arrow-right'     => '&#xf178;',
				'fa fa-long-arrow-up'        => '&#xf176;',
				'fa fa-magic'                => '&#xf0d0;',
				'fa fa-magnet'               => '&#xf076;',
				'fa fa-mail-forward'         => '&#xf064;',
				'fa fa-mail-reply'           => '&#xf112;',
				'fa fa-mail-reply-all'       => '&#xf122;',
				'fa fa-male'                 => '&#xf183;',
				'fa fa-map-marker'           => '&#xf041;',
				'fa fa-mars'                 => '&#xf222;',
				'fa fa-mars-double'          => '&#xf227;',
				'fa fa-mars-stroke'          => '&#xf229;',
				'fa fa-mars-stroke-h'        => '&#xf22b;',
				'fa fa-mars-stroke-v'        => '&#xf22a;',
				'fa fa-maxcdn'               => '&#xf136;',
				'fa fa-meanpath'             => '&#xf20c;',
				'fa fa-medium'               => '&#xf23a;',
				'fa fa-medkit'               => '&#xf0fa;',
				'fa fa-meh-o'                => '&#xf11a;',
				'fa fa-mercury'              => '&#xf223;',
				'fa fa-microphone'           => '&#xf130;',
				'fa fa-microphone-slash'     => '&#xf131;',
				'fa fa-minus'                => '&#xf068;',
				'fa fa-minus-circle'         => '&#xf056;',
				'fa fa-minus-square'         => '&#xf146;',
				'fa fa-minus-square-o'       => '&#xf147;',
				'fa fa-mobile'               => '&#xf10b;',
				'fa fa-mobile-phone'         => '&#xf10b;',
				'fa fa-money'                => '&#xf0d6;',
				'fa fa-moon-o'               => '&#xf186;',
				'fa fa-mortar-board'         => '&#xf19d;',
				'fa fa-motorcycle'           => '&#xf21c;',
				'fa fa-music'                => '&#xf001;',
				'fa fa-navicon'              => '&#xf0c9;',
				'fa fa-neuter'               => '&#xf22c;',
				'fa fa-newspaper-o'          => '&#xf1ea;',
				'fa fa-openid'               => '&#xf19b;',
				'fa fa-outdent'              => '&#xf03b;',
				'fa fa-pagelines'            => '&#xf18c;',
				'fa fa-paint-brush'          => '&#xf1fc;',
				'fa fa-paper-plane'          => '&#xf1d8;',
				'fa fa-paper-plane-o'        => '&#xf1d9;',
				'fa fa-paperclip'            => '&#xf0c6;',
				'fa fa-paragraph'            => '&#xf1dd;',
				'fa fa-paste'                => '&#xf0ea;',
				'fa fa-pause'                => '&#xf04c;',
				'fa fa-paw'                  => '&#xf1b0;',
				'fa fa-paypal'               => '&#xf1ed;',
				'fa fa-pencil'               => '&#xf040;',
				'fa fa-pencil-square'        => '&#xf14b;',
				'fa fa-pencil-square-o'      => '&#xf044;',
				'fa fa-phone'                => '&#xf095;',
				'fa fa-phone-square'         => '&#xf098;',
				'fa fa-photo'                => '&#xf03e;',
				'fa fa-picture-o'            => '&#xf03e;',
				'fa fa-pie-chart'            => '&#xf200;',
				'fa fa-pied-piper'           => '&#xf1a7;',
				'fa fa-pied-piper-alt'       => '&#xf1a8;',
				'fa fa-pinterest'            => '&#xf0d2;',
				'fa fa-pinterest-p'          => '&#xf231;',
				'fa fa-pinterest-square'     => '&#xf0d3;',
				'fa fa-plane'                => '&#xf072;',
				'fa fa-play'                 => '&#xf04b;',
				'fa fa-play-circle'          => '&#xf144;',
				'fa fa-play-circle-o'        => '&#xf01d;',
				'fa fa-plug'                 => '&#xf1e6;',
				'fa fa-plus'                 => '&#xf067;',
				'fa fa-plus-circle'          => '&#xf055;',
				'fa fa-plus-square'          => '&#xf0fe;',
				'fa fa-plus-square-o'        => '&#xf196;',
				'fa fa-power-off'            => '&#xf011;',
				'fa fa-print'                => '&#xf02f;',
				'fa fa-puzzle-piece'         => '&#xf12e;',
				'fa fa-qq'                   => '&#xf1d6;',
				'fa fa-qrcode'               => '&#xf029;',
				'fa fa-question'             => '&#xf128;',
				'fa fa-question-circle'      => '&#xf059;',
				'fa fa-quote-left'           => '&#xf10d;',
				'fa fa-quote-right'          => '&#xf10e;',
				'fa fa-ra'                   => '&#xf1d0;',
				'fa fa-random'               => '&#xf074;',
				'fa fa-rebel'                => '&#xf1d0;',
				'fa fa-recycle'              => '&#xf1b8;',
				'fa fa-reddit'               => '&#xf1a1;',
				'fa fa-reddit-square'        => '&#xf1a2;',
				'fa fa-refresh'              => '&#xf021;',
				'fa fa-remove'               => '&#xf00d;',
				'fa fa-renren'               => '&#xf18b;',
				'fa fa-reorder'              => '&#xf0c9;',
				'fa fa-repeat'               => '&#xf01e;',
				'fa fa-reply'                => '&#xf112;',
				'fa fa-reply-all'            => '&#xf122;',
				'fa fa-retweet'              => '&#xf079;',
				'fa fa-rmb'                  => '&#xf157;',
				'fa fa-road'                 => '&#xf018;',
				'fa fa-rocket'               => '&#xf135;',
				'fa fa-rotate-left'          => '&#xf0e2;',
				'fa fa-rotate-right'         => '&#xf01e;',
				'fa fa-rouble'               => '&#xf158;',
				'fa fa-rss'                  => '&#xf09e;',
				'fa fa-rss-square'           => '&#xf143;',
				'fa fa-rub'                  => '&#xf158;',
				'fa fa-ruble'                => '&#xf158;',
				'fa fa-rupee'                => '&#xf156;',
				'fa fa-save'                 => '&#xf0c7;',
				'fa fa-scissors'             => '&#xf0c4;',
				'fa fa-search'               => '&#xf002;',
				'fa fa-search-minus'         => '&#xf010;',
				'fa fa-search-plus'          => '&#xf00e;',
				'fa fa-sellsy'               => '&#xf213;',
				'fa fa-send'                 => '&#xf1d8;',
				'fa fa-send-o'               => '&#xf1d9;',
				'fa fa-server'               => '&#xf233;',
				'fa fa-share'                => '&#xf064;',
				'fa fa-share-alt'            => '&#xf1e0;',
				'fa fa-share-alt-square'     => '&#xf1e1;',
				'fa fa-share-square'         => '&#xf14d;',
				'fa fa-share-square-o'       => '&#xf045;',
				'fa fa-shekel'               => '&#xf20b;',
				'fa fa-sheqel'               => '&#xf20b;',
				'fa fa-shield'               => '&#xf132;',
				'fa fa-ship'                 => '&#xf21a;',
				'fa fa-shirtsinbulk'         => '&#xf214;',
				'fa fa-shopping-cart'        => '&#xf07a;',
				'fa fa-sign-in'              => '&#xf090;',
				'fa fa-sign-out'             => '&#xf08b;',
				'fa fa-signal'               => '&#xf012;',
				'fa fa-simplybuilt'          => '&#xf215;',
				'fa fa-sitemap'              => '&#xf0e8;',
				'fa fa-skyatlas'             => '&#xf216;',
				'fa fa-skype'                => '&#xf17e;',
				'fa fa-slack'                => '&#xf198;',
				'fa fa-sliders'              => '&#xf1de;',
				'fa fa-slideshare'           => '&#xf1e7;',
				'fa fa-smile-o'              => '&#xf118;',
				'fa fa-soccer-ball-o'        => '&#xf1e3;',
				'fa fa-sort'                 => '&#xf0dc;',
				'fa fa-sort-alpha-asc'       => '&#xf15d;',
				'fa fa-sort-alpha-desc'      => '&#xf15e;',
				'fa fa-sort-amount-asc'      => '&#xf160;',
				'fa fa-sort-amount-desc'     => '&#xf161;',
				'fa fa-sort-asc'             => '&#xf0de;',
				'fa fa-sort-desc'            => '&#xf0dd;',
				'fa fa-sort-down'            => '&#xf0dd;',
				'fa fa-sort-numeric-asc'     => '&#xf162;',
				'fa fa-sort-numeric-desc'    => '&#xf163;',
				'fa fa-sort-up'              => '&#xf0de;',
				'fa fa-soundcloud'           => '&#xf1be;',
				'fa fa-space-shuttle'        => '&#xf197;',
				'fa fa-spinner'              => '&#xf110;',
				'fa fa-spoon'                => '&#xf1b1;',
				'fa fa-spotify'              => '&#xf1bc;',
				'fa fa-square'               => '&#xf0c8;',
				'fa fa-square-o'             => '&#xf096;',
				'fa fa-stack-exchange'       => '&#xf18d;',
				'fa fa-stack-overflow'       => '&#xf16c;',
				'fa fa-star'                 => '&#xf005;',
				'fa fa-star-half'            => '&#xf089;',
				'fa fa-star-half-empty'      => '&#xf123;',
				'fa fa-star-half-full'       => '&#xf123;',
				'fa fa-star-half-o'          => '&#xf123;',
				'fa fa-star-o'               => '&#xf006;',
				'fa fa-steam'                => '&#xf1b6;',
				'fa fa-steam-square'         => '&#xf1b7;',
				'fa fa-step-backward'        => '&#xf048;',
				'fa fa-step-forward'         => '&#xf051;',
				'fa fa-stethoscope'          => '&#xf0f1;',
				'fa fa-stop'                 => '&#xf04d;',
				'fa fa-street-view'          => '&#xf21d;',
				'fa fa-strikethrough'        => '&#xf0cc;',
				'fa fa-stumbleupon'          => '&#xf1a4;',
				'fa fa-stumbleupon-circle'   => '&#xf1a3;',
				'fa fa-subscript'            => '&#xf12c;',
				'fa fa-subway'               => '&#xf239;',
				'fa fa-suitcase'             => '&#xf0f2;',
				'fa fa-sun-o'                => '&#xf185;',
				'fa fa-superscript'          => '&#xf12b;',
				'fa fa-support'              => '&#xf1cd;',
				'fa fa-table'                => '&#xf0ce;',
				'fa fa-tablet'               => '&#xf10a;',
				'fa fa-tachometer'           => '&#xf0e4;',
				'fa fa-tag'                  => '&#xf02b;',
				'fa fa-tags'                 => '&#xf02c;',
				'fa fa-tasks'                => '&#xf0ae;',
				'fa fa-taxi'                 => '&#xf1ba;',
				'fa fa-tencent-weibo'        => '&#xf1d5;',
				'fa fa-terminal'             => '&#xf120;',
				'fa fa-text-height'          => '&#xf034;',
				'fa fa-text-width'           => '&#xf035;',
				'fa fa-th'                   => '&#xf00a;',
				'fa fa-th-large'             => '&#xf009;',
				'fa fa-th-list'              => '&#xf00b;',
				'fa fa-thumb-tack'           => '&#xf08d;',
				'fa fa-thumbs-down'          => '&#xf165;',
				'fa fa-thumbs-o-down'        => '&#xf088;',
				'fa fa-thumbs-o-up'          => '&#xf087;',
				'fa fa-thumbs-up'            => '&#xf164;',
				'fa fa-ticket'               => '&#xf145;',
				'fa fa-times'                => '&#xf00d;',
				'fa fa-times-circle'         => '&#xf057;',
				'fa fa-times-circle-o'       => '&#xf05c;',
				'fa fa-tint'                 => '&#xf043;',
				'fa fa-toggle-down'          => '&#xf150;',
				'fa fa-toggle-left'          => '&#xf191;',
				'fa fa-toggle-off'           => '&#xf204;',
				'fa fa-toggle-on'            => '&#xf205;',
				'fa fa-toggle-right'         => '&#xf152;',
				'fa fa-toggle-up'            => '&#xf151;',
				'fa fa-train'                => '&#xf238;',
				'fa fa-transgender'          => '&#xf224;',
				'fa fa-transgender-alt'      => '&#xf225;',
				'fa fa-trash'                => '&#xf1f8;',
				'fa fa-trash-o'              => '&#xf014;',
				'fa fa-tree'                 => '&#xf1bb;',
				'fa fa-trello'               => '&#xf181;',
				'fa fa-trophy'               => '&#xf091;',
				'fa fa-truck'                => '&#xf0d1;',
				'fa fa-try'                  => '&#xf195;',
				'fa fa-tty'                  => '&#xf1e4;',
				'fa fa-tumblr'               => '&#xf173;',
				'fa fa-tumblr-square'        => '&#xf174;',
				'fa fa-turkish-lira'         => '&#xf195;',
				'fa fa-twitch'               => '&#xf1e8;',
				'fa fa-twitter'              => '&#xf099;',
				'fa fa-twitter-square'       => '&#xf081;',
				'fa fa-umbrella'             => '&#xf0e9;',
				'fa fa-underline'            => '&#xf0cd;',
				'fa fa-undo'                 => '&#xf0e2;',
				'fa fa-university'           => '&#xf19c;',
				'fa fa-unlink'               => '&#xf127;',
				'fa fa-unlock'               => '&#xf09c;',
				'fa fa-unlock-alt'           => '&#xf13e;',
				'fa fa-unsorted'             => '&#xf0dc;',
				'fa fa-upload'               => '&#xf093;',
				'fa fa-usd'                  => '&#xf155;',
				'fa fa-user'                 => '&#xf007;',
				'fa fa-user-md'              => '&#xf0f0;',
				'fa fa-user-plus'            => '&#xf234;',
				'fa fa-user-secret'          => '&#xf21b;',
				'fa fa-user-times'           => '&#xf235;',
				'fa fa-users'                => '&#xf0c0;',
				'fa fa-venus'                => '&#xf221;',
				'fa fa-venus-double'         => '&#xf226;',
				'fa fa-venus-mars'           => '&#xf228;',
				'fa fa-viacoin'              => '&#xf237;',
				'fa fa-video-camera'         => '&#xf03d;',
				'fa fa-vimeo-square'         => '&#xf194;',
				'fa fa-vine'                 => '&#xf1ca;',
				'fa fa-vk'                   => '&#xf189;',
				'fa fa-volume-down'          => '&#xf027;',
				'fa fa-volume-off'           => '&#xf026;',
				'fa fa-volume-up'            => '&#xf028;',
				'fa fa-warning'              => '&#xf071;',
				'fa fa-wechat'               => '&#xf1d7;',
				'fa fa-weibo'                => '&#xf18a;',
				'fa fa-weixin'               => '&#xf1d7;',
				'fa fa-whatsapp'             => '&#xf232;',
				'fa fa-wheelchair'           => '&#xf193;',
				'fa fa-wifi'                 => '&#xf1eb;',
				'fa fa-windows'              => '&#xf17a;',
				'fa fa-won'                  => '&#xf159;',
				'fa fa-wordpress'            => '&#xf19a;',
				'fa fa-wrench'               => '&#xf0ad;',
				'fa fa-xing'                 => '&#xf168;',
				'fa fa-xing-square'          => '&#xf169;',
				'fa fa-yahoo'                => '&#xf19e;',
				'fa fa-yelp'                 => '&#xf1e9;',
				'fa fa-yen'                  => '&#xf157;',
				'fa fa-youtube'              => '&#xf167;',
				'fa fa-youtube-play'         => '&#xf16a;',
				'fa fa-youtube-square'       => '&#xf166;',
				),
			);

		$args = apply_filters( 'tfi_filters_default_args', $args );

		return $args;
	}

	/**
	 * Add new taxonomy.
	 *
	 * @since 1.0
	 */
	public function add_taxonomy_icon( $term ) {

		?>

		<div class="form-field" style="font-family: <?php echo $this->font; ?>;">
			<label for="icons" style="padding-bottom: 10px;">Icon</label>

			<?php foreach ( $this->icons as $key => $value ) : ?>

				<span style="display: inline-block; padding-bottom: 10px; width: 40px;">
					<input style="width:auto; display:inline-block;" type="radio" name="icon" value="<?php echo $key; ?>" /><?php echo $value; ?>
				</span>

			<?php endforeach; ?>

			<p class="description">Select an icon that will be connected to the taxonomy.</p>

		</div>

		<?php
	}

	/**
	 * Edit existing taxonomy.
	 *
	 * @since 1.0
	 */
	public function edit_taxonomy_icon( $term ) {

		// Get the term id
		$term_id = $term->term_id;

		// Get the icons
		$term_meta = get_option( $this->taxonomy_font_icons_option );

		if ( ! empty( $term_meta ) ) {
			// Get the icon of the taxonomy
			$term_icon = ( isset( $term_meta[ $term_id] ) ) ? $term_meta[$term_id] : '';
		}

		?>

		<tr class="form-field">
			<th scope="row">
				<label for="icons">Icon</label>
				<td style="font-family: <?php echo $this->font; ?>;">

				<?php foreach ( $this->icons as $key => $value ) : ?>

					<span style="display: inline-block; padding-bottom: 10px; width: 40px;">
						<input style="width:auto; display:inline-block;" type="radio" name="icon" value="<?php echo $key; ?>" <?php if ( $key == $term_icon ) echo 'checked'; ?> /><?php echo $value; ?>
					</span>

				<?php endforeach; ?>

					<p class="description">Select an icon that will be connected to the taxonomy.</p>

				</td>
			</th>
		</tr>

		<?php
	}

	/**
	 * Save taxonomy icon.
	 *
	 * Saves the taxonomy->icon connection to wp_options.
	 *
	 * @since 1.0
	 */
	public function save_taxonomy_icon( $term_id ) {

		if ( isset( $_POST['icon'] ) ) {

			// Get the selected icon for the taxonomy
			$selected_icon = esc_attr( $_POST['icon'] );

			// Get the icons
			$tfi_icons = get_option( $this->taxonomy_font_icons_option );

			// Update the icons array with the key value pair
			$tfi_icons[ $term_id ] = $selected_icon;

			// Update the option
			update_option( $this->taxonomy_font_icons_option, $tfi_icons );
		}
	}

	/**
	 * Enqueue stylesheets.
	 *
	 * Enqueues the stylesheet which has all the icons.
	 *
	 * @since 1.0
	 */
	public function enqueue_stylesheets() {
		wp_enqueue_style( 'taxonomy-font-icons-stylesheet', $this->stylesheet );
	}
}
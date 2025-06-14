<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Sensei\Internal\Services\Sensei_Pro_Upsell;

/**
 * A settings API (wrapping the WordPress Settings API).
 *
 * @package Core
 * @author Automattic
 *
 * @since 1.0.0
 */
class Sensei_Settings_API {

	/**
	 * Page token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * Legacy page token.
	 *
	 * @var string
	 */
	public $token_legacy;

	/**
	 * Page slug.
	 *
	 * @var string
	 */
	public $page_slug;

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings;

	/**
	 * Settings sections.
	 *
	 * @var array
	 */
	public $sections;

	/**
	 * Settings fields.
	 *
	 * @var array
	 */
	public $fields;

	/**
	 * Errors.
	 *
	 * @var array
	 */
	public $errors;

	/**
	 * Whether the settings page has a range field.
	 *
	 * @var bool
	 */
	public $has_range;

	/**
	 * Whether the settings page has an imageselector field.
	 *
	 * @var bool
	 */
	public $has_imageselector;

	/**
	 * Whether the settings page has tabs.
	 *
	 * @var bool
	 */
	public $has_tabs;

	/**
	 * Settings tabs.
	 *
	 * @var array
	 */
	private $tabs;

	/**
	 * Settings version.
	 *
	 * @var string
	 */
	public $settings_version;

	/**
	 * Array of fields that have not been added to a section.
	 *
	 * @var array|null
	 */
	public $remaining_fields;

	/**
	 * Page's hook suffix.
	 *
	 * @var string|false
	 */
	public $hook = false;

	/**
	 * Constructor.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function __construct() {
		$this->token        = 'sensei-settings';
		$this->token_legacy = 'woothemes-sensei-settings';
		$this->page_slug    = 'sensei-settings-api';

		$this->sections         = array();
		$this->fields           = array();
		$this->remaining_fields = array();
		$this->errors           = array();

		$this->has_range         = false;
		$this->has_imageselector = false;
		$this->has_tabs          = false;
		$this->tabs              = array();
		$this->settings_version  = '';

		// Set default empty values for properties.
		$this->settings = array();
	}

	/**
	 * Graceful fallback for deprecated properties.
	 *
	 * @since 4.24.4
	 *
	 * @param string $key The key to get.
	 *
	 * @return mixed
	 */
	public function __get( $key ) {
		if ( 'name' === $key ) {
			_doing_it_wrong( __CLASS__ . '->name', 'The "name" property is deprecated.', '4.24.5' );

			return $this->get_name();
		}

		if ( 'menu_label' === $key ) {
			_doing_it_wrong( __CLASS__ . '->menu_label', 'The "menu_label" property is deprecated.', '4.24.5' );

			return $this->get_menu_label();
		}
	}

	/**
	 * Get the name of the screen.
	 *
	 * @return string
	 */
	protected function get_name() {
		return ''; // Should be overwritten by extension.
	}

	/**
	 * Get the menu label.
	 *
	 * @return string
	 */
	protected function get_menu_label() {
		return ''; // Should be overwritten by extension.
	}

	/**
	 * Setup the settings screen and necessary functions.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register_hook_listener() {
		add_action( 'admin_init', array( $this, 'settings_fields' ) );
		add_action( 'init', array( $this, 'general_init' ), 5 );
	}

	/**
	 * Initialise settings sections, settings fields and create tabs, if applicable.
	 *
	 * @access  public
	 * @since   1.0.3
	 * @return  void
	 */
	public function general_init() {
		$this->init_sections();
		$this->init_fields();
		$this->get_settings();
		if ( $this->has_tabs == true ) {
			$this->create_tabs();
		}
	}

	/**
	 * Render content drip upgrade settings.
	 *
	 * @since   4.1.0
	 *
	 * @access  private
	 */
	private function render_content_drip_settings() {
		$image_path_desktop = Sensei()->assets->get_image( 'content-drip-promo-desktop.png' );
		$image_path_mobile  = Sensei()->assets->get_image( 'content-drip-promo-mobile.png' );
		$header             = __( 'Get Sensei Pro', 'sensei-lms' );
		$text               = __( 'Keep students engaged and improve knowledge retention by setting a delivery schedule for course content.', 'sensei-lms' );
		$url                = Sensei_Pro_Upsell::get_sensei_pro_upsell_url( 'settings_content_drip' );
		$button_text        = __( 'Upgrade to Sensei Pro', 'sensei-lms' );
		$this->render_promo_banner( $image_path_desktop, $image_path_mobile, $header, $text, $url, $button_text );
	}

	/**
	 * Render woo commerce upgrade settings.
	 *
	 * @since   4.1.0
	 *
	 * @access  private
	 */
	private function render_woocommerce_upgrade_settings() {
		$image_path_desktop = Sensei()->assets->get_image( 'purchase-sensei-pro-desktop.png' );
		$image_path_mobile  = Sensei()->assets->get_image( 'purchase-sensei-pro-mobile.png' );
		$header             = __( 'Get Sensei Pro', 'sensei-lms' );
		$text               = __( 'Sell your courses using the most popular eCommerce platform on the web, WooCommerce.', 'sensei-lms' );
		$url                = Sensei_Pro_Upsell::get_sensei_pro_upsell_url( 'settings_woocommerce' );
		$button_text        = __( 'Upgrade to Sensei Pro', 'sensei-lms' );
		$this->render_promo_banner( $image_path_desktop, $image_path_mobile, $header, $text, $url, $button_text );
	}

	/**
	 * Render promo banner for sensei lms settings.
	 *
	 * @since   4.1.0
	 *
	 * @access  private
	 *
	 * @param string $image_path_desktop Path to image for desktop view.
	 * @param string $image_path_mobile Path to image for mobile view.
	 * @param string $header Banner header text.
	 * @param string $text Banner body text.
	 * @param string $url Redirect url.
	 * @param string $button_text Button text in banner.
	 */
	private function render_promo_banner( $image_path_desktop, $image_path_mobile, $header, $text, $url, $button_text ) {
		?>
		<div id="sensei-promo-banner" class="sensei-promo-banner">
			<div class="sensei-promo-banner__background sensei-promo-banner__background-large sensei-promo-banner__background-medium">
				<span class="sensei-promo-banner__header">
					<?php echo esc_html( $header ); ?>
				</span>
				<span class="sensei-promo-banner__body">
					<?php echo esc_html( $text ); ?>
				</span>
				<a
					class="button button-primary sensei-promo-banner__redirect-button"
					href="<?php echo esc_url( $url ); ?>"
					target="_blank"
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>
			<div class="sensei-promo-banner__side-background">
				<picture>
					<source media="(max-width:780px)" srcset="<?php echo esc_url( $image_path_mobile ); ?>">
					<img class="sensei-promo-banner__background-image" src="<?php echo esc_url( $image_path_desktop ); ?>" alt="sensei-banner">
				</picture>
			</div>
		</div>
		<?php
	}

	/**
	 * Register the settings sections.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function init_sections() {
		// Override this function in your class and assign the array of sections to $this->sections.
		esc_html_e( 'Override init_sections() in your class.', 'sensei-lms' );
	}

	/**
	 * Register the settings fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function init_fields() {
		// Override this function in your class and assign the array of sections to $this->fields.
		esc_html_e( 'Override init_fields() in your class.', 'sensei-lms' );
	}

	/**
	 * Construct and output HTML markup for the settings tabs.
	 *
	 * @access public
	 * @since  1.1.0
	 * @return void
	 */
	public function settings_tabs() {

		if ( ! $this->has_tabs ) {
			return; }

		if ( count( $this->tabs ) > 0 ) {
			$html = '';

			$html .= '<ul id="settings-sections" class="subsubsub hide-if-no-js">' . "\n";

			$sections = array();
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification is not required here.
			$current_tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'default-settings';

			foreach ( $this->tabs as $k => $v ) {
				$classes = 'tab';

				if ( $current_tab === $k ) {
					$classes .= ' current';
				}

				if ( ! empty( $v['external'] ) ) {
					$classes .= ' external';
				}

				$sections[ $k ] = array(
					'href'  => isset( $v['href'] )
						? esc_attr( $v['href'] )
						: admin_url( 'admin.php?page=' . $this->token . '&tab=' . esc_attr( $k ) ),
					'name'  => esc_attr( $v['name'] ),
					'class' => esc_attr( $classes ),
				);

				if ( ! empty( $v['badge'] ) ) {
					$sections[ $k ]['badge'] = esc_html( $v['badge'] );
				}
			}

			$count = 1;
			foreach ( $sections as $k => $v ) {
				$count++;
				$html .= '<li><a href="' . esc_url( $v['href'] ) . '"';
				if ( isset( $v['class'] ) && ( '' !== $v['class'] ) ) {
					$html .= ' class="' . esc_attr( $v['class'] ) . '"'; }
				$html .= '>' . esc_html( $v['name'] );
				if ( ! empty( $v['badge'] ) ) {
					$html .= ' <span class="sensei-settings-tab__badge">' . $v['badge'] . '</span>';
				}
				$html .= '</a>';
				if ( $count <= count( $sections ) ) {
					$html .= ' | '; }
				$html .= '</li>' . "\n";
			}

			$html .= '</ul><div class="clear"></div>' . "\n";

			echo wp_kses_post( $html );
		}
	}

	/**
	 * Create settings tabs based on the settings sections.
	 *
	 * @access private
	 * @since  1.1.0
	 * @return void
	 */
	private function create_tabs() {
		if ( $this->sections ) {
			$tabs = array();
			foreach ( $this->sections as $k => $v ) {
				$tabs[ $k ] = $v;
			}
			$this->tabs = $tabs;
		}
	}

	/**
	 * Create settings sections.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function create_sections() {
		if ( $this->sections ) {
			foreach ( $this->sections as $k => $v ) {
				add_settings_section( $k, $v['name'], array( $this, 'section_description' ), $this->token );
			}
		}
	}

	/**
	 * Create settings fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function create_fields() {
		if ( $this->sections ) {

			foreach ( $this->fields as $k => $v ) {
				$method = $this->determine_method( $v, 'form' );
				$name   = $v['name'];
				if ( $v['type'] == 'info' ) {
					$name = ''; }
				add_settings_field(
					$k,
					$name,
					$method,
					$this->token,
					$v['section'],
					array(
						'key'  => $k,
						'data' => $v,
					)
				);

				// Let the API know that we have a colourpicker field.
				if ( $v['type'] == 'range' && $this->has_range == false ) {
					$this->has_range = true; }
			}
		}
	}

	/**
	 * Determine the method to use for outputting a field, validating a field or checking a field.
	 *
	 * @access protected
	 * @since  1.0.0
	 * @param  array $data
	 * @return callable|array|string
	 */
	protected function determine_method( $data, $type = 'form' ) {
		$method = '';

		if ( ! in_array( $type, array( 'form', 'validate', 'check' ) ) ) {
			return; }

		// Check for custom functions.
		if ( isset( $data[ $type ] ) ) {
			if ( function_exists( $data[ $type ] ) ) {
				$method = $data[ $type ];
			}

			if ( $method == '' && method_exists( $this, $data[ $type ] ) ) {
				if ( $type == 'form' ) {
					$method = array( $this, $data[ $type ] );
				} else {
					$method = $data[ $type ];
				}
			}
		}

		if ( $method == '' && method_exists( $this, $type . '_field_' . $data['type'] ) ) {
			if ( $type == 'form' ) {
				$method = array( $this, $type . '_field_' . $data['type'] );
			} else {
				$method = $type . '_field_' . $data['type'];
			}
		}

		if ( $method == '' && function_exists( $this->token . '_' . $type . '_field_' . $data['type'] ) ) {
			$method = $this->token . '_' . $type . '_field_' . $data['type'];
		}

		if ( $method == '' ) {
			if ( $type == 'form' ) {
				$method = array( $this, $type . '_field_text' );
			} else {
				$method = $type . '_field_text';
			}
		}

		return $method;
	}

	/**
	 * Parse the fields into an array index on the sections property.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $fields
	 * @return void
	 */
	public function parse_fields( $fields ) {
		foreach ( $fields as $k => $v ) {
			if ( isset( $v['section'] ) && ( $v['section'] != '' ) && ( isset( $this->sections[ $v['section'] ] ) ) ) {
				if ( ! isset( $this->sections[ $v['section'] ]['fields'] ) ) {
					$this->sections[ $v['section'] ]['fields'] = array();
				}

				$this->sections[ $v['section'] ]['fields'][ $k ] = $v;
			} else {
				$this->remaining_fields[ $k ] = $v;
			}
		}
	}

	/**
	 * Register the settings screen within the WordPress admin.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function register_settings_screen() {

		if ( current_user_can( 'manage_sensei' ) ) {
			$hook = add_submenu_page( 'sensei', $this->get_name(), $this->get_menu_label(), 'manage_sensei', $this->page_slug, array( $this, 'settings_screen' ) );

			$this->hook = $hook;
		}

		if ( isset( $_GET['page'] ) && ( $_GET['page'] == $this->page_slug ) ) {

			add_action( 'admin_notices', array( $this, 'settings_errors' ) );
			add_action( 'admin_print_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_print_styles', array( $this, 'enqueue_styles' ) );

		}
	}

	/**
	 * The markup for the settings screen.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function settings_screen() {
		?>
		<div id="woothemes-sensei" class="wrap <?php echo esc_attr( $this->token ); ?>">
			<div id="sensei-custom-navigation" class="sensei-custom-navigation">
				<div class="sensei-custom-navigation__heading">
					<div class="sensei-custom-navigation__title">
						<h1>
							<?php
							echo esc_html( $this->get_name() );

							if ( '' != $this->settings_version ) {
								echo ' <span class="version">' . esc_html( $this->settings_version ) . '</span>';
							}
							?>
						</h1>
					</div>
					<div class="sensei-custom-navigation__links">
						<?php $this->settings_tabs(); ?>
					</div>
				</div>
			</div>

			<?php
			/**
			 * Fires before the settings form.
			 *
			 * @hook settings_before_form
			 */
			do_action( 'settings_before_form' );
			?>

			<form id="<?php echo esc_attr( $this->token ); ?>-form" action="options.php" method="post">
				<?php
				settings_fields( $this->token );
				$page = 'sensei-settings';

				foreach ( $this->sections as $section_id => $section ) {
					echo '<section id="' . esc_attr( $section_id ) . '">';

					if ( $section['name'] ) {
						echo '<h2>' . esc_html( $section['name'] ) . '</h2>' . "\n";
					}

					$this->render_additional_section_elements( $section_id );
					echo '<table class="form-table">';
					do_settings_fields( $page, $section_id );
					echo '</table>';
					echo '</section>';
				}

				submit_button();
				?>
			</form>

			<?php
			/**
			 * Fires after the settings form.
			 *
			 * @hook settings_after_form
			 */
			do_action( 'settings_after_form' );
			?>
		</div><!--/#woothemes-sensei-->
		<?php
	}

	/**
	 * Render additional section elements.
	 *
	 * @since  4.1.0
	 *
	 * @access private
	 * @param string $section_id Section id.
	 */
	private function render_additional_section_elements( $section_id ) {
		/**
		 * Filters the woocommerce promo settings section.
		 *
		 * @since 4.1.0
		 *
		 * @hook sensei_settings_woocommerce_hide  Hook used to hide woocommerce promo banner and section.
		 *
		 * @param {bool} $hide_woocommerce_settings Defines if the woocommerce promo banner should be hidden.
		 * @return {bool} Returns a boolean value that defines if the woocommerce promo banner should be hidden.
		 */
		$hide_woocommerce_settings = apply_filters( 'sensei_settings_woocommerce_hide', false );
		if ( 'woocommerce-settings' === $section_id && ! $hide_woocommerce_settings ) {
			$this->render_woocommerce_upgrade_settings();
		}

		/**
		 * Filters the content drip promo settings section.
		 *
		 * @since 4.1.0
		 *
		 * @hook  sensei_settings_content_drip_hide  Hook used to hide content drip promo banner and section.
		 *
		 * @param {bool} $hide_content_drip_settings Defines if the content drip promo banner should be hidden.
		 * @return {bool} Returns a boolean value that defines if the content drip promo banner should be hidden.
		 */
		$hide_content_drip_settings = apply_filters( 'sensei_settings_content_drip_hide', false );
		if ( 'sensei-content-drip-settings' === $section_id && ! $hide_content_drip_settings ) {
			$this->render_content_drip_settings();
		}
	}


	/**
	 * Retrieve the settings from the database.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return array
	 */
	public function get_settings() {

		$this->settings = self::get_settings_raw();

		foreach ( $this->fields as $k => $v ) {

			if ( ! isset( $this->settings[ $k ] ) ) {

				if ( isset( $v['default'] ) ) {
					$this->settings[ $k ] = $v['default'];
				} elseif ( isset( $v['defaults'] ) ) {
					$this->settings[ $k ] = $v['defaults'];
				}
			}

			if ( $v['type'] == 'checkbox' && $this->settings[ $k ] != true ) {
				$this->settings[ $k ] = 0;
			}
		}

		return $this->settings;
	}

	/**
	 * Get the raw settings option.
	 *
	 * @return array
	 */
	protected function get_settings_raw() {
		$settings = get_option( $this->token, false );
		if ( false === $settings && $this->token_legacy ) {
			$settings = get_option( $this->token_legacy, false );

			if ( false !== $settings ) {
				update_option( $this->token, $settings );
			}
		}
		if ( false === $settings ) {
			$settings = array();
		}
		return $settings;
	}

	/**
	 * Register the settings fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function settings_fields() {
		register_setting( $this->token, $this->token, array( $this, 'validate_fields' ) );
		$this->create_sections();
		$this->create_fields();
	}

	/**
	 * Display settings errors.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function settings_errors() {
		settings_errors( $this->token . '-errors' );
	}

	/**
	 * Display the description for a settings section.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function section_description( $section ) {
		if ( isset( $this->sections[ $section['id'] ]['description'] ) ) {
			echo wp_kses_post( wpautop( $this->sections[ $section['id'] ]['description'] ) );
		}
	}

	/**
	 * Generate text input field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_text( $args ) {
		$options = $this->get_settings();

		$type     = in_array( $args['data']['type'] ?? '', [ 'email', 'text' ], true ) ? $args['data']['type'] : 'text';
		$multiple = isset( $args['data']['multiple'] ) ? ' multiple ' : '';

		echo '<input id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" size="40" type="' . esc_attr( $type ) . '" ' . esc_attr( $multiple ) . ' value="' . esc_attr( $options[ $args['key'] ] ) . '" />' . "\n";
		if ( isset( $args['data']['description'] ) ) {
			echo '<span class="description">' . wp_kses_post( $args['data']['description'] ) . '</span>' . "\n";
		}
	}

	/**
	 * Generate color picker field.
	 *
	 * @access public
	 * @since  1.6.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_color( $args ) {
		$options = $this->get_settings();

		echo '<input id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" size="40" type="text" class="color" value="' . esc_attr( $options[ $args['key'] ] ) . '" />' . "\n";
		echo '<div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>';
		if ( isset( $args['data']['description'] ) ) {
			echo '<span class="description">' . wp_kses_post( $args['data']['description'] ) . '</span>' . "\n";
		}
	}

	/**
	 * Generate checkbox field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_checkbox( $args ) {
		$options = $this->get_settings();

		$has_description = false;
		if ( isset( $args['data']['description'] ) ) {
			$has_description = true;
			echo '<label for="' . esc_attr( $args['key'] ) . '">' . "\n";
		}
		echo '<input id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" type="checkbox" value="1"' . checked( esc_attr( $options[ $args['key'] ] ), '1', false ) . ' />' . "\n";
		if ( $has_description ) {
			echo wp_kses(
				$args['data']['description'],
				array(
					'a' => array(
						'href'   => array(),
						'title'  => array(),
						'target' => array(),
					),
				)
			) . '</label>' . "\n";
		}
	}

	/**
	 * Generate textarea field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_textarea( $args ) {
		$options = $this->get_settings();

		echo '<textarea id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" cols="42" rows="5">' . esc_html( $options[ $args['key'] ] ) . '</textarea>' . "\n";
		if ( isset( $args['data']['description'] ) ) {
			echo '<p><span class="description">' . esc_html( $args['data']['description'] ) . '</span></p>' . "\n";
		}
	}

	/**
	 * Generate select box field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_select( $args ) {
		$options = $this->get_settings();

		if ( isset( $args['data']['options'] ) && ( count( (array) $args['data']['options'] ) > 0 ) ) {
			$html  = '';
			$html .= '<select class="" id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']">' . "\n";
			foreach ( $args['data']['options'] as $k => $v ) {
				$html .= '<option value="' . esc_attr( $k ) . '"' . selected( esc_attr( $options[ $args['key'] ] ), $k, false ) . '>' . esc_html( $v ) . '</option>' . "\n";
			}
			$html .= '</select>' . "\n";
			echo wp_kses(
				$html,
				array(
					'select' => array(
						'class' => array(),
						'id'    => array(),
						'name'  => array(),
					),
					'option' => array(
						'selected' => array(),
						'value'    => array(),
					),
				)
			);

			if ( isset( $args['data']['description'] ) ) {
				echo '<p><span class="description">' . wp_kses_post( $args['data']['description'] ) . '</span></p>' . "\n";
			}
		}
	}

	/**
	 * Generate radio button field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_radio( $args ) {
		$options = $this->get_settings();

		if ( isset( $args['data']['options'] ) && ( count( (array) $args['data']['options'] ) > 0 ) ) {
			$html = '';
			foreach ( $args['data']['options'] as $k => $v ) {
				$html .= '<input type="radio" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" value="' . esc_attr( $k ) . '"' . checked( esc_attr( $options[ $args['key'] ] ), $k, false ) . ' /> ' . esc_html( $v ) . '<br />' . "\n";
			}

			echo wp_kses(
				$html,
				array(
					'input' => array(
						'checked' => array(),
						'name'    => array(),
						'type'    => array(),
						'value'   => array(),
					),
					'br'    => array(),
				)
			);

			if ( isset( $args['data']['description'] ) ) {
				echo '<span class="description">' . esc_html( $args['data']['description'] ) . '</span>' . "\n";
			}
		}
	}

	/**
	 * Generate multicheck field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_multicheck( $args ) {
		$options = $this->get_settings();

		if ( isset( $args['data']['options'] ) && ( count( (array) $args['data']['options'] ) > 0 ) ) {
			$html = '<div class="multicheck-container" style="margin-bottom:10px;">' . "\n";
			foreach ( $args['data']['options'] as $k => $v ) {
				$checked = '';

				if ( isset( $options[ $args['key'] ] ) ) {
					if ( in_array( $k, (array) $options[ $args['key'] ] ) ) {
						$checked = ' checked="checked"';
					}
				} else {
					if ( in_array( $k, $args['data']['defaults'] ) ) {
						$checked = ' checked="checked"';
					}
				}
				$html .= '<label for="checkbox-' . esc_attr( $k ) . '">' . "\n";
				$html .= '<input type="checkbox" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . '][]" class="multicheck multicheck-' . esc_attr( $args['key'] ) . '" value="' . esc_attr( $k ) . '" id="checkbox-' . esc_attr( $k ) . '" ' . $checked . ' /> ' . esc_html( $v ) . "\n";
				$html .= '</label><br />' . "\n";
			}
			$html .= '</div>' . "\n";

			echo wp_kses(
				$html,
				array_merge(
					wp_kses_allowed_html( 'post' ),
					array(
						// Explicitly allow label tag for WP.com.
						'label' => array(
							'for' => array(),
						),
						'input' => array(
							'checked' => array(),
							'class'   => array(),
							'id'      => array(),
							'name'    => array(),
							'type'    => array(),
							'value'   => array(),
						),
					)
				)
			);

			if ( isset( $args['data']['description'] ) ) {
				echo '<span class="description">' . esc_html( $args['data']['description'] ) . '</span>' . "\n";
			}
		}
	}

	/**
	 * Generate range field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_range( $args ) {
		$options = $this->get_settings();

		if ( isset( $args['data']['options'] ) && ( count( (array) $args['data']['options'] ) > 0 ) ) {
			$html  = '';
			$html .= '<select id="' . esc_attr( $args['key'] ) . '" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" class="range-input">' . "\n";
			foreach ( $args['data']['options'] as $k => $v ) {
				$html .= '<option value="' . esc_attr( $k ) . '"' . selected( esc_attr( $options[ $args['key'] ] ), $k, false ) . '>' . esc_html( $v ) . '</option>' . "\n";
			}
			$html .= '</select>' . "\n";

			echo wp_kses(
				$html,
				array(
					'option' => array(
						'selected' => array(),
						'value'    => array(),
					),
					'select' => array(
						'class' => array(),
						'id'    => array(),
						'name'  => array(),
					),
				)
			);

			if ( isset( $args['data']['description'] ) ) {
				echo '<p><span class="description">' . esc_html( $args['data']['description'] ) . '</span></p>' . "\n";
			}
		}
	}

	/**
	 * Generate image-based selector form field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_images( $args ) {
		$options = $this->get_settings();

		if ( isset( $args['data']['options'] ) && ( count( (array) $args['data']['options'] ) > 0 ) ) {
			$html = '';
			foreach ( $args['data']['options'] as $k => $v ) {
				$html .= '<input type="radio" name="' . esc_attr( $this->token ) . '[' . esc_attr( $args['key'] ) . ']" value="' . esc_attr( $k ) . '"' . checked( esc_attr( $options[ $args['key'] ] ), $k, false ) . ' /> ' . esc_html( $v ) . '<br />' . "\n";
			}

			echo wp_kses(
				$html,
				array_merge(
					wp_kses_allowed_html( 'post' ),
					array(
						'input' => array(
							'checked' => array(),
							'name'    => array(),
							'type'    => array(),
							'value'   => array(),
						),
					)
				)
			);

			if ( isset( $args['data']['description'] ) ) {
				echo '<span class="description">' . esc_html( $args['data']['description'] ) . '</span>' . "\n";
			}
		}
	}

	/**
	 * Generate information box field.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $args
	 * @return void
	 */
	public function form_field_info( $args ) {
		$class = '';
		if ( isset( $args['data']['class'] ) ) {
			$class = ' ' . esc_attr( $args['data']['class'] );
		}
		$html = '<div id="' . esc_attr( $args['key'] ) . '" class="info-box' . esc_attr( $class ) . '">' . "\n";
		if ( isset( $args['data']['name'] ) && ( $args['data']['name'] != '' ) ) {
			$html .= '<h3 class="title">' . esc_html( $args['data']['name'] ) . '</h3>' . "\n";
		}
		if ( isset( $args['data']['description'] ) && ( $args['data']['description'] != '' ) ) {
			$html .= '<p>' . esc_html( $args['data']['description'] ) . '</p>' . "\n";
		}
		$html .= '</div>' . "\n";

		echo wp_kses_post( $html );
	}


	/**
	 * Generate button field.
	 *
	 * @access public
	 * @since  1.9.0
	 * @param  array $args
	 */
	public function form_field_button( $args ) {
		if ( isset( $args['data']['target'] ) && isset( $args['data']['label'] ) ) {
			printf( '<a href="%s" class="button button-secondary">%s</a> ', esc_url( $args['data']['target'] ), esc_html( $args['data']['label'] ) );

			if ( isset( $args['data']['description'] ) ) {
				echo '<span class="description">' . esc_html( $args['data']['description'] ) . '</span>' . "\n";
			}
		}
	}


	/**
	 * Validate registered settings fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array $input
	 * @uses   $this->parse_errors()
	 * @return array $options
	 */
	public function validate_fields( $input ) {
		$options = $this->get_settings();

		foreach ( $this->fields as $k => $v ) {
			if ( 'color' === $v['type'] ) {
				$input[ $k ] = str_replace( '#', '', $input[ $k ] );
				if ( ! ctype_xdigit( $input[ $k ] ) || strlen( $input[ $k ] ) !== 6 ) {
					$input[ $k ] = false;
				}
			}
			// Make sure checkboxes are present even when false.
			if ( $v['type'] == 'checkbox' && ! isset( $input[ $k ] ) ) {
				$input[ $k ] = false; }
			if ( $v['type'] == 'multicheck' && ! isset( $input[ $k ] ) ) {
				$input[ $k ] = false; }

			if ( isset( $input[ $k ] ) ) {
				// Perform checks on required fields.
				if ( isset( $v['required'] ) && ( $v['required'] == true ) ) {
					if ( in_array( $v['type'], $this->get_array_field_types() ) && ( count( (array) $input[ $k ] ) <= 0 ) ) {
						$this->add_error( $k, $v );
						continue;
					} else {
						if ( $input[ $k ] == '' ) {
							$this->add_error( $k, $v );
							continue;
						}
					}
				}

				$value = $input[ $k ];

				// Check if the field is valid.
				$method = $this->determine_method( $v, 'check' );

				if ( is_string( $method ) && function_exists( $method ) ) {
					$is_valid = $method( $value );
				} elseif ( is_string( $method ) && method_exists( $this, $method ) ) {
					$is_valid = $this->$method( $value );
				}

				if ( ! $is_valid ) {
					$this->add_error( $k, $v );
					continue;
				}

				$method = $this->determine_method( $v, 'validate' );

				if ( is_string( $method ) && function_exists( $method ) ) {
					$options[ $k ] = $method( $value );
				} elseif ( is_string( $method ) && method_exists( $this, $method ) ) {
					$options[ $k ] = $this->$method( $value );
				}
			}
		}

		// Parse error messages into the Settings API.
		$this->parse_errors();
		return $options;
	}

	/**
	 * Validate text fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  string $input
	 * @return string
	 */
	public function validate_field_text( $input ) {
		return trim( esc_attr( $input ) );
	}

	/**
	 * Validate checkbox fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  string $input
	 * @return string
	 */
	public function validate_field_checkbox( $input ) {
		if ( ! isset( $input ) ) {
			return 0;
		} else {
			return (bool) $input;
		}
	}

	/**
	 * Validate multicheck fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  string $input
	 * @return string
	 */
	public function validate_field_multicheck( $input ) {
		$input = (array) $input;

		$input = array_map( 'esc_attr', $input );

		return $input;
	}

	/**
	 * Validate range fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  string $input
	 * @return string
	 */
	public function validate_field_range( $input ) {
		$input = number_format( floatval( $input ), 0 );

		return $input;
	}

	/**
	 * Validate URL fields.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  string $input
	 * @return string
	 */
	public function validate_field_url( $input ) {
		return trim( esc_url( $input ) );
	}

	/**
	 * Check and validate the input from text fields.
	 *
	 * @param  string $input String of the value to be validated.
	 * @since  1.1.0
	 * @return boolean Is the value valid?
	 */
	public function check_field_text( $input ) {
		$is_valid = true;

		return $is_valid;
	}

	/**
	 * Log an error internally, for processing later using $this->parse_errors().
	 *
	 * @access protected
	 * @since  1.0.0
	 * @param  string $key  Field key.
	 * @param  array  $data Field data.
	 * @return void
	 */
	protected function add_error( $key, $data ) {
		if ( isset( $data['error_message'] ) ) {
			$message = $data['error_message'];
		} else {
			// translators: Placeholder is the field name.
			$message = sprintf( __( '%s is a required field', 'sensei-lms' ), $data['name'] );
		}
		$this->errors[ $key ] = $message;
	}

	/**
	 * Parse logged errors.
	 *
	 * @access  protected
	 * @since   1.0.0
	 * @return  void
	 */
	protected function parse_errors() {
		if ( $this->errors ) {
			foreach ( $this->errors as $k => $v ) {
				add_settings_error( $this->token . '-errors', $k, $v, 'error' );
			}
		} else {
			// translators: Placeholder is the name of the settings page.
			$message = sprintf( __( '%s updated', 'sensei-lms' ), $this->get_name() );
			add_settings_error( $this->token . '-errors', $this->token, $message, 'updated' );
		}
	}

	/**
	 * Return an array of field types expecting an array value returned.
	 *
	 * @access protected
	 * @since  1.0.0
	 * @return array
	 */
	protected function get_array_field_types() {
		return array( 'multicheck' );
	}

	/**
	 * Load in JavaScripts where necessary.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_scripts() {

		Sensei()->assets->enqueue( 'sensei-settings', 'js/settings.js', [ 'jquery', 'farbtastic' ] );

		if ( $this->has_range ) {
			Sensei()->assets->enqueue( 'sensei-settings-ranges', 'js/ranges.js', [ 'jquery-ui-slider' ] );
		}

		Sensei()->assets->register( 'sensei-settings-imageselectors', 'js/image-selectors.js', [ 'jquery' ] );

		if ( $this->has_imageselector ) {
			wp_enqueue_script( 'sensei-settings-imageselectors' );
		}

	}

	/**
	 * Load in CSS styles where necessary.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->token . '-admin' );

		wp_enqueue_style( 'farbtastic' );
		Sensei()->assets->enqueue( 'sensei-settings-api', 'css/settings.css', [ 'farbtastic' ] );

		$this->enqueue_field_styles();
	}

	/**
	 * Load in CSS styles for field types where necessary.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_field_styles() {

		if ( $this->has_range ) {
			Sensei()->assets->enqueue( 'sensei-settings-ranges', 'css/ranges.css' );
		}

		Sensei()->assets->register( 'sensei-settings-imageselectors', 'css/image-selectors.css' );

		if ( $this->has_imageselector ) {
			wp_enqueue_style( 'sensei-settings-imageselectors' );
		}
	}
}

/**
 * Class WooThemes_Sensei_Settings_API
 *
 * @ignore only for backward compatibility
 * @since 1.9.0
 */
class WooThemes_Sensei_Settings_API extends Sensei_Settings_API{}

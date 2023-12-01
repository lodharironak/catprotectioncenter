<?php
/**
 * Plugin Name: Inline Stock Quotes
 * Plugin URI: http://elliottbernstein.com/inline-stock-quotes/
 * Description: Inline Stock Quotes uses the [stock] shortcode to insert dynamically updating and easily customized stock  quotes into posts.
 * Version: 0.2
 * Author: Elliott Bernstein
 * Author URI: http://elliotbernstein.com
 *License: GPLv2 or later
 */


//set up the admin area options page
class ISQSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $isq_options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'isq_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'isq_page_init' ) );
    }

    /**
     * Add options page
     */
    public function isq_add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Inline Stock Settings',
            'Inline Quotes',
            'manage_options',
            'inline-stock-setting-admin',
            array( $this, 'isq_create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function isq_create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'inline_stock_options' );
        ?>
        <div class="wrap">
            <h2>Inline Quotes Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'inline_stock_option_group' );
                do_settings_sections( 'inline-stock-setting-admin' );
				submit_button();
            ?>
            </form>
        </div>
        <?php
    }


    /**
     * Register and add settings
     */
    public function isq_page_init()
    {
        register_setting(
            'inline_stock_option_group', // Option group
            'inline_stock_options', // Option name
            array( $this, 'isq_sanitize' ) // isq_sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Custom Colors, Text Styles, & Link Attributes', // Title
            array( $this, 'isq_print_section_info' ), // Callback
            'inline-stock-setting-admin' // Page
        );

        add_settings_field(
            'background_number', // ID
            'Background', // Title
            array( $this, 'isq_background_number_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'text_number', // ID
            'Symbol & Current Price', // Title
            array( $this, 'isq_text_number_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'positive_number', // ID
            'Positive Change', // Title
            array( $this, 'isq_positive_number_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'negavtive_number', // ID
            'Negative Change', // Title
            array( $this, 'isq_negative_number_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'neutral_number', // ID
            'No Change', // Title
            array( $this, 'isq_neutral_number_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'font_family', // ID
            'Font', // Title
            array( $this, 'isq_font_family_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'font_size', // ID
            'Font Size (em, rem, px, or %)', // Title
            array( $this, 'isq_font_size_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

         add_settings_field(
            'bold', // ID
            'Bold', // Title
            array( $this, 'isq_bold_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

  		 add_settings_field(
            'window', // ID
            'Open link in new window', // Title
            array( $this, 'isq_window_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

  		add_settings_field(
            'service', // ID
            'Select service for link', // Title
            array( $this, 'isq_service_callback' ), // Callback
            'inline-stock-setting-admin', // Page
            'setting_section_id' // Section
        );

    }


    /**
     * sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function isq_sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['background_number'] ) )
            $new_input['background_number'] = substr($input['background_number'], 0, 7) ;

        if( isset( $input['text_number'] ) )
            $new_input['text_number'] =  substr($input['text_number'], 0, 7) ;

        if( isset( $input['positive_number'] ) )
            $new_input['positive_number'] = substr($input['positive_number'], 0, 7) ;

        if( isset( $input['negative_number'] ) )
            $new_input['negative_number'] = substr($input['negative_number'], 0, 7) ;

        if( isset( $input['neutral_number'] ) )
            $new_input['neutral_number'] =  substr($input['neutral_number'], 0, 7) ;

        if( isset( $input['font_size'] ) )
            $new_input['font_size'] =  substr($input['font_size'], 0, 5) ;

        if( isset( $input['font_family'] ) )
            $new_input['font_family'] =  substr($input['font_family'], 0, 100) ;

         if( isset( $input['bold'] ) )
            $new_input['bold'] =  substr($input['bold'], 0, 100) ;

        if( isset( $input['window'] ) )
            $new_input['window'] =  substr($input['window'], 0, 100) ;

        if( isset( $input['service'] ) )
            $new_input['service'] =  substr($input['service'], 0, 100) ;

        return $new_input;
    }




    /**
     * Print the Section text
     */
    public function isq_print_section_info()
    {
        print '<i>Hint: To return to default values, remove your custom codes and save.</i>';
    }

    /**
     * Get the settings option array and print one of its values
     */
     public function isq_background_number_callback()
    {
    	if( empty( $this->options['background_number'] ) )
            $this->options['background_number'] = '#000000' ;
        printf(
            '<input type="text" id="background_number" name="inline_stock_options[background_number]" value="%s" />',
            isset( $this->options['background_number'] ) ? esc_attr( $this->options['background_number']) : ''
        );

    }

     public function isq_text_number_callback()
    {
    	if( empty( $this->options['text_number'] ) )
            $this->options['text_number'] = '#ffffff' ;
        printf(
            '<input type="text" id="text_number" name="inline_stock_options[text_number]" value="%s" />',
            isset( $this->options['text_number'] ) ? esc_attr( $this->options['text_number']) : ''
        );
    }

    public function isq_positive_number_callback()
    {
    	if( empty( $this->options['positive_number'] ) )
            $this->options['positive_number'] = '#00ff00' ;
        printf(
            '<input type="text" id="positive_number" name="inline_stock_options[positive_number]" value="%s" />',
            isset( $this->options['positive_number'] ) ? esc_attr( $this->options['positive_number']) : ''
        );
    }

    public function isq_negative_number_callback()
        {
        	if( empty( $this->options['negative_number'] ) )
            $this->options['negative_number'] = '#ff0000' ;
        printf(
            '<input type="text" id="negative_number" name="inline_stock_options[negative_number]" value="%s" />',
            isset( $this->options['negative_number'] ) ? esc_attr( $this->options['negative_number']) : ''
        );
    }

    public function isq_neutral_number_callback()
        {
        	if( empty( $this->options['neutral_number'] ) )
            $this->options['neutral_number'] = '#ffffff' ;
        printf(
            '<input type="text" id="neutral_number" name="inline_stock_options[neutral_number]" value="%s" />',
            isset( $this->options['neutral_number'] ) ? esc_attr( $this->options['neutral_number']) : ''
        );
    }

    public function isq_font_size_callback()
        {
        	if( empty( $this->options['font_size'] ) )
            $this->options['font_size'] = '.8em' ;
        printf(
            '<input type="text" id="font_size" name="inline_stock_options[font_size]" value="%s" />',
            isset( $this->options['font_size'] ) ? esc_attr( $this->options['font_size']) : ''
        );
    }

    public function isq_font_family_callback()
        {
        	if( empty( $this->options['font_family'] ) )
            $this->options['font_family'] = 'calibri, sans-serif' ;
        printf(
            '<input type="text" id="font_family" name="inline_stock_options[font_family]" value="%s" />',
            isset( $this->options['font_family'] ) ? esc_attr( $this->options['font_family']) : ''
        );
    }

    public function isq_bold_callback()
        {
        printf(
            '<input id="%1$s" name="inline_stock_options[%1$s]" type="checkbox" %2$s />',
    		'bold',
    		checked( isset( $this->options['bold'] ), true, false )
        );
    }

    public function isq_window_callback()
        {
        printf(
            '<input id="%1$s" name="inline_stock_options[%1$s]" type="checkbox" %2$s />',
    		'window',
    		checked( isset( $this->options['window'] ), true, false )
        );
    }

    public function isq_service_callback()
        {
        printf(
            '<select name="inline_stock_options[%1$s]" id="%1$s">
                 <option value="0" %2$s >Google</option>
                 <option value="1" %3$s >Yahoo</option>
             </select>',
    		'service', selected( $this->options['service'], 0 , false), selected( $this->options['service'], 1, false )
    		);
    }
}




if( is_admin() )
    $isq_settings_page = new ISQSettingsPage();



//Add the shortcode
add_shortcode( 'stock', 'inline_stocks_func' );

//Execute the shortcode with $atts arguments
function inline_stocks_func( $atts ) {
	//make array of arguments and give these arguments to the shortcode
    $a = shortcode_atts( array(
        "symbol" => '',
    ), $atts );

    //create variables from arguments array
    extract($a);

    //get the string from google
	$quote = file_get_contents("https://finance.google.com/finance?q={$symbol}&output=json");

	//remove random junk from front and end of string
	$quote = substr($quote, 4, -1);

	//remove carriage returns from the string
	$quote = str_replace("\n", "", $quote);


	//turn json string into php variables
	$quote = stripcslashes($quote);
	$quote = json_decode( $quote )[0];


	//get latest price
	$last = $quote->l;

	//get dollar change
	$change_dollar = $quote->c;

  	//assign settings values to $isq_options
  	$isq_options = get_option( 'inline_stock_options' );

  	//build the css style strings
  	$outer_style = $isq_options['background_number'];
  	$text_style = $isq_options['text_number'];
  	$font_family = $isq_options['font_family'];
  	$font_size = $isq_options['font_size'];
  	$bold = $isq_options['bold'];
  	$window = $isq_options['window'];
  	$service = $isq_options['service'];
  	$google_quote_url = 'https://www.google.com/finance?q='."{$symbol}";
    $yahoo_quote_url = 'http://finance.yahoo.com/q?s='."{$symbol}";

  	//get percent change
	$change_price = $quote->cp;

	//check if positive, negative, or neutral, then assign color via options
	if ( strstr($change_dollar, '+')) {
    	$inner_style = $isq_options['positive_number'];
	} elseif ( strstr($change_dollar, '-')) {
   	 	$inner_style = $isq_options['negative_number'];
  	} else {
  		$inner_style = $isq_options['neutral_number'];
  	}

  	//check if bold is selected
  	if ( empty( $bold ) ) {
    	$bold = 'normal';
			} else {
   	 	$bold = 'bold';
   	 }

   	 //check if "open in new window" is selected
   	 if ( empty( $window ) ) {
    	$window = '_self';
			} else {
   	 	$window = '_blank';
   	 }

   	 //check which service was selected for quotes
   	 if ( $service == 0 ) {
    	$service = $google_quote_url;
			} else {
   	 	$service = $yahoo_quote_url;
   	 }


  	//define default css values
  	if (empty( $outer_style))
  		$outer_style = '#000000';

  	if (empty( $text_style))
  		$text_style = '#ffffff';

  	if (empty( $inner_style)) {
  			if ( strstr($change_dollar, '+')) {
    	$inner_style = '#00ff00';
			} elseif ( strstr($change_dollar, '-')) {
   	 	$inner_style = '#ff0000';
  		} else {
  		$inner_style = '#ffffff';
  		}
  	}

  	if (empty( $font_size))
  		$font_size = '.8em';
  	if (empty( $font_family))
  		$font_family = 'calibri, sans-serif';


  	//make main span
  	$output = '<span class="isq-quote-outer" style="display: inline; white-space:nowrap; background-color:'.$outer_style.'; color:'.$text_style.'; padding: 1px 6px 1px 6px; border-radius: 4px; font-family: '.$font_family.'; font-size: '.$font_size.'; font-weight: '.$bold.'">';

  	//make build html string and make span with appropriate class
  	$output .= '<a class="isq-quote-text" target="'.$window.'" style=" border-bottom: 0; text-decoration: none!important; color:'.$text_style.';" href="'.$service.'">'. strtoupper($symbol).': '.$last.'<span style="color:'.$inner_style.';"> '.$change_dollar.' ('.$change_price.'%)</span></a></span>';


  	//return completed string
  	return $output;

}

?>

<?php

/**
 * Sanitization Function - Multiple Categories
 * 
 * @param $input, $setting
 * @return $input
 */
if( !function_exists( 'cream_magazine_sanitize_multiple_cat_select' ) ) {

    function cream_magazine_sanitize_multiple_cat_select( $input, $setting ) {

        if(!empty($input)){

            $input = array_map('sanitize_text_field', $input);
        }

        return $input;
    } 
}


/**
 * Sanitization Function - Select
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */
if ( !function_exists('cream_magazine_sanitize_select') ) {

    function cream_magazine_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
}

/**
 * Sanitization Function - Number
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */
if ( !function_exists('cream_magazine_sanitize_number') ) {

    function cream_magazine_sanitize_number( $input, $setting ) {
        
        $number = absint( $input );
        // If the input is a positibe number, return it; otherwise, return the default.
        return ( $number ? $number : $setting->default );
    }
}
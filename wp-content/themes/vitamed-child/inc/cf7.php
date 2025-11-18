<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


add_action( 'wpcf7_mail_sent', 'vitamed_send_cf7_data_to_remote_site' );

function vitamed_send_cf7_data_to_remote_site( $contact_form ) {
    $submission  = WPCF7_Submission::get_instance();
// ID поточної форми
    $form_id = $contact_form->id();

    $mysecretkey = 'fGIABV7vRt2fF3FYjve0fusPWoWiAYYqxsItc4vS1Vuj12FMKMGh1PkxrzO7rymsNRSwMaZq8vHC+rq0foH+gQ==';

    if ( $submission && $form_id == 201 ) {
        $posted_data  = $submission->get_posted_data();
        $phone        = isset( $posted_data['your-phone'] ) ? $posted_data['your-phone'] : '';
        $name         = isset( $posted_data['your-name'] ) ? $posted_data['your-name'] : '';
        $doctor_id    = isset( $posted_data['doctor-id'] ) ? $posted_data['doctor-id'] : '';
        $booking_date = isset( $posted_data['booking-date'] ) ? $posted_data['booking-date'] : '';

        $data = array(
            'child_site_slug'  => get_option( 'site_slug' ),
            'original_post_id' => sanitize_text_field( $doctor_id ),
            'phone'            => sanitize_text_field( $phone ),
            'name'             => sanitize_text_field( $name ),
            'date'             => sanitize_text_field( $booking_date ),

        );

        $response = wp_remote_post( 'https://wordpress-1210358-5722812.cloudwaysapps.com/wp-json/vitamed/SetData', array(
            'method'  => 'POST',
            'timeout' => 15,
            'headers' => array(
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $mysecretkey,
            ),
            'body'    => wp_json_encode( $data ),
        ) );
        error_log( 'CF7 Data: ' . json_encode( $data ) );
        // Логування для відладки
        if ( is_wp_error( $response ) ) {
            error_log( 'CF7 API error: ' . $response->get_error_message() );
        } else {
            error_log( 'CF7 API response: ' . wp_remote_retrieve_body( $response ) );
        }
    }
}
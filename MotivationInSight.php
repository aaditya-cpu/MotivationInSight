<?php
/*
Plugin Name: Motivation InSight
Plugin URI: https://example.com/motivational-quotes
Description: Display a motivational quote in the admin bar
Version: 1.0
Author: Aaditya Goenka
Author URI: https://bit.ly/ghprau
License: GPLv2 or later
Text Domain: motivational-quotes
*/



add_action( 'admin_bar_menu', 'display_qod_in_admin_bar', 999 );

function display_qod_in_admin_bar( $wp_admin_bar ) {
    $response = wp_remote_get( 'https://quotes.rest/qod?language=en' );
    if ( is_wp_error( $response ) ) {
        return;
    }
    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! empty( $data['contents']['quotes'][0]['quote'] ) ) {
        $quote = $data['contents']['quotes'][0]['quote'];
        $wp_admin_bar->add_node( array(
            'id'    => 'qod',
            'title' => $quote,
            'href'  => '#',
            'meta'  => array( 'class' => 'qod' ),
        ) );
    }
}

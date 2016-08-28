<?php
/**
* The template for displaying the WP Job Manager no found message
*
* @package Listable
*/

if ( defined( 'DOING_AJAX' ) ) : ?>
	<li class="no_job_listings_found"><?php esc_html_e( '검색 결과가 없습니다.', 'listable' ); ?></li>
<?php else : ?>
	<p class="no_job_listings_found"><?php esc_html_e( '검색 결과가 없습니다.', 'listable' ); ?></p>
<?php endif; ?>
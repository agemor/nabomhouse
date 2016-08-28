<?php

$labels_settings = array(
	'type'    => 'postbox',
	'label'   => esc_html__( 'Labels', 'comments-ratings' ),
	'options' => array(
		'review_rating_label'      => array(
			'label'   => esc_html__( 'Review Rating Label: ', 'comments-ratings' ),
			'default' => esc_html__( '이 하숙에 대한 평가점수', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
		'review_title_label'       => array(
			'label'   => esc_html__( 'Review Title Label: ', 'comments-ratings' ),
			'default' => esc_html__( '리뷰 제목:', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
		'review_title_placeholder' => array(
			'label'   => esc_html__( 'Review Title Placeholder: ', 'comments-ratings' ),
			'default' => esc_html__( '간단하게 리뷰의 내용을 요약해 주세요', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
		'review_label'             => array(
			'label'   => esc_html__( 'Review Label: ', 'comments-ratings' ),
			'default' => esc_html__( '상세 리뷰', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
		'review_placeholder'       => array(
			'label'   => esc_html__( 'Review Placeholder: ', 'comments-ratings' ),
			'default' => esc_html__( '이 하숙에 대한 여러분의 전반적인 평가를 요약해 주세요', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
		'review_submit_button'     => array(
			'label'   => esc_html__( 'Review Submit Button: ', 'comments-ratings' ),
			'default' => esc_html__( '리뷰 제출', 'comments-ratings' ),
			'type'    => 'text',
			'size'    => "80"
		),
	)
); # config

return $labels_settings;

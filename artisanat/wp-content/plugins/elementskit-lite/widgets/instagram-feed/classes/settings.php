<?php

Class Ekit_instagram_settings{

	/**
	* Access token secret key
	*/
	private $ekit_ins_app_userId = '';

	/**
	* Access token secret key
	*/
	private $ekit_fb_app_access_token = '';

	private $user_id;
	private $user_access_token;

	// setup
	public function setup(array $config){
		$this->user_id = strlen($config['user_id']) > 3 ? $config['user_id'] : $this->ekit_ins_app_userId;
		$this->user_access_token = strlen($config['token']) > 3 ? $config['token'] : $this->ekit_fb_app_access_token;
	}

	// get user information
	public function get_user($userName = 'xpeeder'){
		$tag = 'wordcamprussia2015';

		$user_url = "https://api.instagram.com/v1/users/search?q=" . $userName . "&access_token=" . $this->user_access_token;
		$response = wp_remote_post( $user_url, [
						'method' => 'GET',
						'timeout' => 45,
						'headers' => [
									'Content-Type' => 'application/json; charset=utf-8'
								],
						]
					);
		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
			return $error_message;
		} else {
			$bodyResponse =  json_decode($response['body']);
			return $bodyResponse;
		}
	}

	// get feed data of instragram
	public function get_feed( $limit = 5){
		$json_link="https://api.instagram.com/v1/users/{$this->user_id}/media/recent/?access_token={$this->user_access_token}&count={$limit}";

		$response = wp_remote_post( $json_link, [
						'method' => 'GET',
						'timeout' => 45,
						'headers' => [
									'Content-Type' => 'application/json; charset=utf-8'
								],
						]
					);
		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
			return $error_message;
		} else {
			$bodyResponse =  json_decode($response['body']);
			return $bodyResponse;
		}
	}

	public function get_time_ago( $time )
	{
		$time_difference = time() - $time;

		if( $time_difference < 1 ) { return '1 sec'; }
		$condition = array( 12 * 30 * 24 * 60 * 60 =>  'y',
					30 * 24 * 60 * 60       =>  'mth',
					24 * 60 * 60            =>  'd',
					60 * 60                 =>  'hrs.',
					60                      =>  'min',
					1                       =>  'sec'
		);

		foreach( $condition as $secs => $str )
		{
			$d = $time_difference / $secs;

			if( $d >= 1 )
			{
				$t = round( $d );
				return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ';
			}
		}
	}
}
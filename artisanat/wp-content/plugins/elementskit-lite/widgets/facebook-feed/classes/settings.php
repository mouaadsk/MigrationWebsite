<?php

Class Ekit_facebook_settings{

	public $ekit_fb_account_id = '';
	/**
	* Access token app id
	*/
	public $ekit_fb_app_id = '';

	/**
	* Access token secret key
	*/
	public $ekit_fb_app_secret = '';

	/**
	* Access token secret key
	*/

	public $ekit_fb_app_access_token = '';

	private $user_app_id;
	private $user_app_key;
	private $user_id;
	private $access_key;


	private $fileds = ['id', 'message', 'form', 'story_tags', 'message_tags', 'source', 'picture', 'full_picture', 'link', 'name', 'caption', 'description', 'type', 'status_type', 'icon', 'created_time', 'updated_time', 'from{name,id,link,username,picture}', 'object_id', 'permalink_url', 'likes.limit(0).summary(true)', 'shares', 'comments.limit(0).summary(true)', 'reactions.limit(0).summary(true)', 'with_tags', 'is_published'];

	// setup
	public function setup(array $config){

		$this->user_id = strlen($config['page_id']) > 2 ? $config['page_id'] : $this->ekit_fb_account_id;

		$this->access_key = strlen($config['access']) > 5 ? $config['access'] : $this->ekit_fb_app_access_token;

	}

	// get fb access token
	public function getAccessToken(){
		$url = 'https://graph.facebook.com/v3.0/oauth/access_token?client_id='.$this->ekit_fb_app_id.'&client_secret='.$this->ekit_fb_app_secret.'&grant_type=client_credentials';

		$response = wp_remote_post( $url, [
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
			return isset($bodyResponse->access_token) ? $bodyResponse->access_token : '';
		}
	}

	public function getToken(){
		return $this->access_key;

	}

	// get feed data of facebook
	public function get_feed($fields = [], $limit = 5){

		/* Fileds data*/
		if(is_array($fields) && sizeof($fields) > 0){
			$filedData = implode(',', $fields);
		}else{
			$filedData = implode(',', $this->fileds);
		}

		$json_link = "https://graph.facebook.com/v3.0/{$this->user_id}/feed?access_token={$this->getToken()}&fields={$filedData}&limit={$limit}";

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



}
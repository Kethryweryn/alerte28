<?php
require_once "API/TwitterAPIExchange.php";

class TwitterConnect
{
	protected $settings = array();
	
	public function __construct()
	{
		 $this->settings = array(
    		'oauth_access_token' => "714450438096097280-WOAWOQ0m4QHXzUYqStHXLlH9ozJNkwV",
    		'oauth_access_token_secret' => "wDv7lR6DyvcAzshSqElXH1ayY7Ed99eNuz6Gmf5dlgAey",
    		'consumer_key' => "ChA37VBYdm4omNgyVNdh9rW5P",
    		'consumer_secret' => "GqB2dwD7xYMT9dPuGpkyuXlQDo4pOXUkdMwced1OSPxV0JPFsu"
			);
	}
	
	public function postTweet($msg = "")
	{
		$url = "https://api.twitter.com/1.1/statuses/update.json";
		$requestMethod = "POST";
		$postfields = array(
    			'status' => $msg ); 
    	$twitter = new TwitterAPIExchange($this->settings);
    	$twitter->setPostfields($postfields)
            ->buildOauth($url, $requestMethod)
            ->performRequest();
	}
	
	
}
?>

<?php
require_once "TwitterConnect.php";
/*
 * Created on 28 mars 2016
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $twitter = new TwitterConnect();
 $twitter->postTweet("CIUB is alive ! ");
?>

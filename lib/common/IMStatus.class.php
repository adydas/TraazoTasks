<?php

class IMStatus {
	public static function getaim($screenname) {
		$ch		= curl_init();
		$url	= "http://big.oscar.aol.com/$screenname?on_url=true&off_url=false";
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		// added to fix php 5.1.6 issue:
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$result	= curl_exec($ch);
		curl_close($ch);

		if(eregi("true",$result)) {
			return true;
		} else {
			return false;
		}
	}

	public static function getGTalk(){
		
	}

}

?>
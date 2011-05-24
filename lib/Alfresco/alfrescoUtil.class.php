<?php

require_once("java.inc");

/**
 * Alfresco helper class
 *
 */
class AlfrescoUtil{
	
	
	public static function getFileDesc($id) {
		$filez = Doctrine::getTable("Files")->find($id);
		return $filez;
	}
	

	public static function getAlfLocation (){
		return sfConfig::get('app_alfresco_location');	
	}
	
	public static function destroySession(){
		if (isset($_SESSION["alf_ticket"])){
			unset($_SESSION["alf_ticket"]);
		}
	}
	
	public static function versionLoc(){
		
		return sfConfig::get('app_alfresco_versionurl');
	}
	
	public static function createSession($token=false){
		
		

		$ALF_API_URL = sfConfig::get('app_alfresco_url');
		$ALF_API_USER = sfConfig::get('app_alfresco_username');
		$ALF_API_PASS = sfConfig::get('app_alfresco_password');
		
		
		$repository = new Repository($ALF_API_URL); 
		$ticket = null;

		if (isset($_SESSION["alf_ticket"]) == false){
			$ticket = $repository->authenticate($ALF_API_USER, $ALF_API_PASS);
			$_SESSION["alf_ticket"] = $ticket;
			
		}else{
			$ticket = $_SESSION["alf_ticket"];
		}
		
		//create the session
		//check that the session is valid and does not throw a security exception
		$session = $repository->createSession($ticket);
		
		try{
			$store=new SpacesStore($session);
			$nodes = $session->query($store, "PATH:\"".self::getAlfLocation()."\"");
		}catch(Exception $e){
			//if an exception is caught nullify the session
			$session = null;
		}
		
		
		//if the ticket has expired create it
		if (!$session){
			$ticket = $repository->authenticate($ALF_API_USER, $ALF_API_PASS);
			$_SESSION["alf_ticket"] = $ticket;
			$session = $repository->createSession($ticket);
		}
		
		

		//return the $ticket value if required
		if ($token){
			return $ticket;
		}
		
		//return the session object
		return $session;
	}

	public static function spaceExists($searchParam=null){

		$alf_session = self::createSession();
		

		$store=new SpacesStore($alf_session);
		if (!is_null($searchParam)){
//			
//			$searchParam =  Java("org.alfresco.util.ISO9075")->encode($searchParam);
//			echo $searchParam;
			
			$lucenePath = "PATH:\"".self::getAlfLocation().$searchParam."\"";
			
		}
		else
			$lucenePath = "PATH:\"".self::getAlfLocation();

		$nodes = $alf_session->query($store, $lucenePath);

		if(isset($nodes[0]))
			$contentNode = $nodes[0];
		else
			return false;

		if ($contentNode){
			return $contentNode->id;
		}
		return false;

		//echo $contentNode->getId();

	}
	
	public static function browseSpace($searchParam=null){
		
		
		
		$alf_session = self::createSession();
		
		

		$store=new SpacesStore($alf_session);
		if (!is_null($searchParam))
			$lucenePath = "PATH:\"".$searchParam."\"";
		else
			$lucenePath = "PATH:\"".self::getAlfLocation();

		$nodes = $alf_session->query($store, $lucenePath);
		
		
		return $nodes;
		
//		foreach ($nodes as $node)
//   		{
//      		echo($node->cm_name. ' - ' . $node->type . "<br>");
//      		foreach($node->children as $c){
//      			echo($c->cm_name);
//      		}
//
//      		echo '<hr/>';
//   		}
		
	}


	public static function createFolder($currentNode,$session,$name)
	{
		
		$alfUtil = new Java("com.nutshell.content.alfresco.client.ContentUtil", sfConfig::get('app_alfresco_url'));
		
		$new_child_store = $currentNode->createChild(
                                                  'cm_folder',
                                                  'cm_contains',
                                                  'app_'.$name
		);

		$new_child_store->addAspect("cm_titled");
		$new_child_store->addAspect("cm_versionable");
		$new_child_store->cm_name = $name;
		$new_child_store->cm_title = "Project space for $name";
		$new_child_store->cm_description = "This space contains files for $name";

		$session->save();

		return $new_child_store->id;

	}


	public static function kodaziLocation(){
		return sfConfig::get('app_alfresco_location');
	}

	public static function deleteNode($uuid){
		$alfUtil = new Java("com.nutshell.content.alfresco.client.ContentUtil", sfConfig::get('app_alfresco_url'));
		$alfUtil->authenticate(sfConfig::get('app_alfresco_username'), sfConfig::get('app_alfresco_password'));
		$alfUtil->deleteNode($uuid);
	}

	/** JAVA CALLS TO ALFRESCO **/
	public static function createAlfUser($accountName, $location, $folderPath){
		$alfUtil = new Java("com.nutshell.content.alfresco.client.ContentUtil", sfConfig::get('app_alfresco_url'));
		$alfUtil->authenticate(sfConfig::get('app_alfresco_username'), sfConfig::get('app_alfresco_password'));
		$alfUtil->createUser($accountName, $accountName, $location);
		
	}
	

}
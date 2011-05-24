<?php

class deleteFileAction extends kodaziAction{

	public function execute($request) {
		
		$uuid = $request->getParameter('uuid');
		
		AlfrescoUtil::deleteNode($uuid);
		
		$this->redirect('@file_upload');
		
	}


}
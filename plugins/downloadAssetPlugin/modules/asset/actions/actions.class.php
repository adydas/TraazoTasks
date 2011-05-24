<?php

class assetActions extends sfActions
{
	public function executeDownloadAsset ($req)
	{
		$file_id = $req->getParameter ('fid');

		$file = Doctrine::getTable ('File')->find ($file_id);
		
		if (! is_object ($file))
			$this->forward404 ();

			
			
		$this->path = sfConfig::get('app_account-files_location').'/'.$file->getLatestVersion()->path.'/'.$file->getLatestVersion()->name;
		
		if (! is_file ($this->path))
			$this->forward404 ();

		/**
		$ugc_song = $asset->UGCSong;

		if (! is_object ($ugc_song))
			$this->forward404 ();

		$status = $ugc_song->getStatusName ();

		switch ($status) {
			case 'approved':
			case 'playtest':
			case 'review':
				break;

			default:
				$session = $this->getUser ();

				if (! $session->isAuthenticated ())
					$this->forward404 ();

				$ugc_user = $session->getRockbandUser ()->UGCUser;

				if ($ugc_user->id != $ugc_song->submitter_user_id)
					$this->forward404 ();

				break;
		}
		*/
			
		$resp = $this->getResponse ();
		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$contentType =  finfo_file($finfo, $this->path);
		
		$resp->setContentType ($contentType);
		$resp->setHttpHeader  ('Content-Length', filesize ($this->path));
	}

}
?>
<?php

class kodaziFileUpload {

	public static function createFile($projectId, $account, $uid, $file, $isNewVersion, $con){

		$accountDir = sfConfig::get('app_account-files_location').'/'.$account->getId();
		$saveDir = $account->getId().'/'.$dir;
		$userDir = $accountDir.'/'.$dir;


		if (!$isNewVersion){
			//does file exist if so version
			$fi = Doctrine_Query::create()
			->select('fi.*')
			->from('FileInfo fi')
			->where('fi.path = ? and fi.name = ?', array($saveDir, $file->getOriginalName ()))
			->fetchOne();
		}



		$ext = pathinfo($file->getOriginalName(), PATHINFO_EXTENSION);
		$fname = pathinfo($file->getOriginalName(), PATHINFO_FILENAME);

		if ($fi){
			$f = $fi->getFile();
			$latestVersion = $f->getLatestVersionNum();
		}


		if (($f && $latestVersion >= 1) || $isNewVersion){

			$vv = $latestVersion;
			$extVal = $ext?'.'.$ext:'';

			//make new version
			if (is_file ($userDir.'/'.$file->getOriginalName ())){
				rename($userDir.'/'.$file->getOriginalName (),
				$userDir. "/". $fname."_v". $vv.$extVal);
			}

		}else{
			Util::mk_dir($userDir);
		}

		if(!move_uploaded_file($file->getTempName() , $userDir.'/'.$file->getOriginalName ())){
			throw new Exception ("Error during upload - Move " . $file->getTempName()  . ' to '. $accountDir.'/'.$file->getOriginalName ());
		}else{
			//dir
			//chmod (sfConfig::get('app_samba_location').'/'.$song->getId().'/', 0777);
		}


		if ($latestVersion < 1){
			$filez = new File();
			$filez->setProjectId($projectId);
			$filez->setCreated(date("Y-m-d H:i:s"));
			$filez->save($con);
		}else{
			$filez = $f;
		}

		$version = $latestVersion + 1;

		$fileVersion = new FileVersion();
		$fileVersion->setFileId($filez->file_id);
		$fileVersion->setVersion($version);
		$fileVersion->setCreated(date("Y-m-d H:i:s"));
		$fileVersion->save($con);

		$fileInfo = new FileInfo();
		$fileInfo->setFileId($filez->file_id);
		$fileInfo->setVersionId($fileVersion->getVersionId());
		$fileInfo->setVersion($version);
		$fileInfo->setName($file->getOriginalName());
		$fileInfo->setPath($saveDir);
		$fileInfo->setDescription($description);
		$fileInfo->setCreatorId ($uid);
		$fileInfo->save($con);
			
			
		return $filez;
	}
}

?>
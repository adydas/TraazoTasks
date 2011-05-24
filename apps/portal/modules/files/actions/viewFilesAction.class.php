<?php

class viewFilesAction extends kodaziAction{

	public function execute($request) {
		$this->pid = $request->getParameter ('pid');
		$filez = Doctrine::getTable('File')->getProjectFiles($this->pid);
		$this->files = $filez;
	}


}
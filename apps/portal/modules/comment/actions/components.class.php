<?php

class commentComponents extends sfComponents {


	public function executeAddComment(sfWebRequest $request){
		 
		$accountId = $this->getUser()->getAttribute('aid');
		if ($accountId){
			
			$this->id = $this->getRequestParameter( 'id' );
			$this->mode = $this->getRequestParameter('mode');
			
			//get comments
			if ($this->mode == 'p' && $this->id){
				$this->comments = Doctrine::getTable('Comment')->findByProjectId($this->id);
			}else if ($this->mode == 'm' && $this->id){
				$this->comments = Doctrine::getTable('Comment')->findByMilestoneId($this->id);
			}else if ($this->mode == 't' && $this->id){
				$this->comments = Doctrine::getTable('Comment')->findByTaskId($this->id);
			}else if ($this->mode == 'f' && $this->id){
				$this->comments = Doctrine::getTable('Comment')->findByFileId($this->id);
			}else {
				$this->comments = Doctrine::getTable('Comment')->findByAccountId($accountId);
			}
		}

	}


}

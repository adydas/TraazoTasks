<?php

/**
 * comment actions.
 *
 * @package    protoglue_sym12
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class commentActions extends kodaziActions
{
	
	
	
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAdd(sfWebRequest $request)
  {

		//get project Id
		

		//from super class
		$accountId = $this->accountId;

		if (!$this->getRequest()->isMethod('post')){

			return $this->renderComponent('comment', 'addComment');
			
		}else {
			
			$commentText = $this->getRequestParameter('comment');
			$id = $this->getRequestParameter( 'id' );
			$mode = $this->getRequestParameter('mode');
			
			
			if (strlen(trim($commentText))){

				$comment = new Comment();

				if ($mode == 'p'){
					$comment->setProjectId($id);
				}else if ($mode == 'm' ){
					$comment->setMilestoneId($id);
				}else if ($mode == 't'){
					$comment->setTaskId($id);
				}else if ($mode == 'f'){
					$comment->setFileId($id);
				}
					
				$comment->setAccountId($accountId);
				$comment->setCommentText($commentText);
				$comment->setStatus(1);
				$comment->setSubmittedBy($this->userId);
				$comment->setCreated(date("Y-m-d H:i:s"));
				$comment->save();

			}

		}
  
  		$this->renderText("Update process successful");
  		return sfView::NONE;
  }
  
}

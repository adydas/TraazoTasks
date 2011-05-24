<?php
class newMessageAction extends kodaziAction
{

	public function execute($request) {

		$accountId = $this->accountId;
		$pid = $request->getParameter( 'pid' );
		$mgid = $request->getParameter( 'mgid' );
		
		$this->mgid = $mgid;
		$this->pid = $pid;
		
		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else {
			
			$messageBody = $request->getParameter('body');
			$messageSubject = $request->getParameter('subject');
			$messageTags = $request->getParameter('tags');
				
			$users = $request->getParameter( 'user' );
				
				
			$conn = Doctrine_Manager::connection();
			$conn->beginTransaction();


			try{


				$m = new Message();
				$mgid?$m->setMessgSubId($mgid):null;
				$pid?$m->setProjectId($pid):null;
				$m->setAccountId($accountId);
				$m->setBody($messageBody);
				$m->setSubject($messageSubject);
				$m->setSubmittedBy($this->userId);
				$m->setCreated(date("Y-m-d H:i:s"));
				$m->save($conn);


				foreach ($users as $user){
					$ms = new MessageSubs();
					$ms->setMessgId($m->getMessgId());
					$ms->setSubscriberId($user);
					$ms->save($conn);
				}

					
				$conn->commit();
					
					
			}catch (Exception $e)
			{
				$conn->rollBack();
				throw $e;
			}





		}

		$this->renderText("Update process successful");
		return sfView::NONE;
	}

}
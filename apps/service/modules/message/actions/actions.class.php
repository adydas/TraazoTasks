<?php

/**
 * message actions.
 *
 * @package    protoglue_sym12
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class messageActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{

		$messages = Doctrine::getTable('Message')->getUnsentMessages();
		foreach ($messages as $message){

			$conn = Doctrine_Manager::connection();
			$conn->beginTransaction();

			try{
				
				$recipients = $message->getMessageSubs();
				$toArray = array();
				$c = 0;
				foreach ($recipients as $recipient){
					$toArray[$c++] = $recipient->getUser();
				}
				
				KodaziEmail::sendEmail($message->getSubject(), $message->getBody(), $toArray);

				$message->setStatus(2);
				$message->save();

				$conn->commit();

			} catch (Doctrine_Exception $e) {
				$conn->rollback();
				error_log ($e->getMessage());
				return sfView::NONE;
			}
		}
			
		return sfView::NONE;
	}
}

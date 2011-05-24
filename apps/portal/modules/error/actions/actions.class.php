<?php

/**
 * error actions.
 *
 * @package    protoglue_sym12
 * @subpackage error
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class errorActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUnauthorized(sfWebRequest $request)
  {
    return sfView::SUCCESS;
  }
}

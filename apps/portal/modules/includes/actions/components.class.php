<?php

/**
 * Include components.
 *
 * @subpackage global includes
 * @author     Kodazi Inc.
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */


class includesComponents extends kodaziComponents {
  public function executeNavAccountBar(){

  }
  
  public function executeNavProjectBar(sfWebRequest $request){
  	

  }
  
  
   public function executeNavSidebar(sfWebRequest $request){
  		$pid = $request->getParameter('pid');
		$this->pid = $pid;
		$project = Doctrine::getTable('Project')->find(array($this->getAccountId(), $pid));
		
		$this->module  = $this->getContext()->getModuleName();
		$this->action  = $this->getContext()->getActionName();
  }
  
  public function executeAjaxLoader(){
  	

  }
  
  
}

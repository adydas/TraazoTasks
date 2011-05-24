<?php

class viewFilter extends sfFilter
{
	public function execute ($filterChain)
	{

		// Execute next filter in the chain
		$filterChain->execute();

		// Code to execute after the action execution, before the rendering
		$request = $this->getContext()->getRequest();
		$user    = $this->getContext()->getUser();

		$acctId = $this->getContext()->getUser()->getAttribute('aid');
		 
		// Code to execute before the action execution
		if ($acctId){
			//get account
			$account = Doctrine::getTable('Account')->find($acctId);
			
			//get user and match up to account
			
		}



	}
}
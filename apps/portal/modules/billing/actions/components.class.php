<?php

/**
 * Common ccount components
 *
 */
class billingComponents extends sfComponents
{
	public function executeViewPlans(sfWebRequest $request)
	{
		$q = Doctrine_Query::create()
    			->from('PlanFeature pf');
		$this->planFeatures = $q->execute();
		
		return sfView::SUCCESS;
	}
	
	public function executePayViewForm(sfWebRequest $request)
	{
		return sfView::SUCCESS;
	}
    
}
?>
	<?
		if ($sf_user->getAttribute('aid')){
			$acct = kodaziActions::getAccount($sf_user->getAttribute('aid'));
			echo  link_to($acct->getName(), "@account_hub?aid=".$acct->getId());
	
		}
	?>
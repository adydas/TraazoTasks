<? foreach ($accountUsers as $accountUser): ?>
 			
	<? 	
 				
 		$profile = $accountUser->getUser()->getProfile();
 		echo '<input type="checkbox" name="user[]" value="' . $profile->getUserId() . '">' . $profile->getFirstName() . ' '.$profile->getLastName() . '<br/>';
 					
 				
 	?>

<? endforeach; ?>
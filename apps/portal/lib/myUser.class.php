<?php

class myUser extends sfGuardSecurityUser
{
	
	
	public function getGuardUser()
	{
		if ( !@$this->user && $id = $this->getAttribute( 'user_id', null, 'sfGuardSecurityUser' ) )
		{
			$q = new Doctrine_Query();
			$q->select('s.*, p.*');
			$q->from('sfGuardUser s');
			$q->leftJoin('s.Profile p on s.id = p.user_id');
			$q->where('s.id = ?', $id);

			$this->user = $q->fetchOne();
			
			

			if ( !$this->user )
			{
				// the user does not exist anymore in the database
				$this->signOut();
				throw new sfException( 'The user does exist anymore in the database.' );
			}
		}
		
		return $this->user;
	}
	
	public function getProfile(){
		
		if ( !@$this->user && $id = $this->getAttribute( 'user_id', null, 'sfGuardSecurityUser' ) )
		{
			$q = new Doctrine_Query();
			$q->select('s.*, p.*');
			$q->from('sfGuardUser s');
			$q->leftJoin('s.Profile p on s.id = p.user_id');
			$q->where('s.id = ?', $id);

			$this->user = $q->fetchOne();
			
			

			if ( !$this->user )
			{
				// the user does not exist anymore in the database
				$this->signOut();
				throw new sfException( 'The user does exist anymore in the database.' );
			}
		}
		
		
		return $this->user->getProfile();
	}

}

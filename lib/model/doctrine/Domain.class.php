<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Domain extends BaseDomain
{
	
	public static function getNameForId($id){
		$domain = Doctrine::getTable('Domain')->find($id);
		return $domain->getName();
	}

}
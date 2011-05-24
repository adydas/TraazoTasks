<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MilestoneTable extends Doctrine_Table
{

	static public function getLuceneIndex($accountId)
	{
		ProjectConfiguration::registerZend();
        if (file_exists($index = self::getLuceneIndexFile($accountId)))
		{
			return Zend_Search_Lucene::open($index);
		}
		else
		{
			return Zend_Search_Lucene::create($index);
		}
	}

	static public function getLuceneIndexFile($accountId)
	{
		return sfConfig::get('sf_data_dir').'/Milestone.'.$accountId.'.'.sfConfig::get('sf_environment').'.index';
	}

	static public function getForLuceneQuery($accountId, $query)
	{

		$hits = self::getLuceneIndex($accountId)->find($query);
        $pks = array();
        foreach ($hits as $hit)
		{
			$pks[] = $hit->pk;
		}
        return $pks;
	}


}
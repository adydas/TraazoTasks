<?php

require_once '/usr/share/symfony/symfony12/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

	static protected $zendLoaded = false;

	static public function registerZend()
	{
		if (self::$zendLoaded)
		{
			return;
		}

		set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
		require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader.php';
		Zend_Loader::registerAutoload();
		self::$zendLoaded = true;
	}

	public function setup()
	{
		// for compatibility / remove and enable only the plugins you want
//		$this->enablePlugins(array('sfDoctrinePlugin'));
//		$this->disablePlugins(array('sfPropelPlugin'));
		$this->enableAllPluginsExcept();
	}
}

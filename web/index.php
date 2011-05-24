<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

// get the domain's parts
list($tld, $domain, $subdomain, $subdomain2) = array_reverse(explode('.', $_SERVER['HTTP_HOST']));
$account = (empty($subdomain) || $subdomain == 'www' ) ? 'ALL' : $subdomain;

$configuration = ProjectConfiguration::getApplicationConfiguration('portal', 'prod', false);
$sfc = sfContext::createInstance($configuration);

$sf_user = $sfc->getUser();
$sf_user->setAttribute('account_name', strtolower($account));

$sfc->dispatch();
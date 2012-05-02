<?php
/**
 * Copyright (c) 2011, 2012 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
 

OC_JSON::checkLoggedIn();
OC_JSON::checkAppEnabled('calendar');

$l = OC_L10N::get('calendar');

$lat = $_GET['lat'];
$lng = $_GET['long'];

$timezone =  OC_Geo::timezone($lat, $lng);

if($timezone == OCP\Config::getUserValue(OCP\USER::getUser(), 'calendar', 'timezone')){
	OC_JSON::success();
	exit;
}
OCP\Config::setUserValue(OCP\USER::getUser(), 'calendar', 'timezone', $timezone);
$message = array('message'=> $l->t('New Timezone:') . $timezone);
OC_JSON::success($message);
?>
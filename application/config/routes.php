<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['dalumni'] = 'alumni/dataalumni';
$route['logout'] = 'user/logout';

$route['default_controller'] = 'home';

$route['pendidikan_alumni'] = 'pendidikan';
$route['cv_alumni'] = 'cv';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

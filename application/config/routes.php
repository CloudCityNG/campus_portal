<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "index/index";
$route['404_override'] = '';

//Admin
$route['login'] = "authenticate/index";
$route['validate'] = "authenticate/validateUser";
$route['logout'] = "authenticate/logout";

//Admission
$route['admission'] = "admission/dashboard/index";
$route['admission/forms'] = "admission/forms/index";
$route['admission/list_forms_json'] = "admission/forms/getListJson";
$route['admission/forms/add_ug'] = "admission/forms/addUGNewForm";
$route['admission/forms/save_ug'] = "admission/forms/saveUGNewForm";
$route['admission/forms/edit_ug/(:num)/(:any)'] = "admission/forms/editUGForm/$1/$2";
$route['admission/forms/edit_ug_status/(:num)'] = "admission/forms/editUGStudentStatus/$1";
$route['admission/forms/update_ug_status/(:num)'] = "admission/forms/updateUGStudentStatus/$1";
$route['admission/forms/update_ug_basic/(:num)'] = "admission/forms/updateUGBasicForm/$1";
$route['admission/forms/update_ug_education/(:num)'] = "admission/forms/updateUGEduForm/$1";
$route['admission/forms/update_ug_language/(:num)'] = "admission/forms/updateUGLanguagesForm/$1";
$route['admission/forms/update_ug_foreign/(:num)'] = "admission/forms/updateUGForeignForm/$1";
$route['admission/forms/update_ug_images/(:num)'] = "admission/forms/updateUGImagesForm/$1";
$route['admission/forms/view_image/(:num)/(:any)'] = "admission/forms/viewStudentImages/$1/$2";

//Entrance Exam Test
$route['admission/eet'] = "admission/eet/index";
$route['admission/eet/json'] = "admission/eet/getJsonList";
$route['admission/eet/edit_marks/(:num)'] = "admission/eet/editMarks/$1";
$route['admission/eet/update_marks/(:num)'] = "admission/eet/UpdateMarks/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
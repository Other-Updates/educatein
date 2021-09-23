<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;
////pages
//$route['about-us'] = 'about';
////search
//$route['schools-list'] = 'search';
//$route['list-of-best-schools-in-'] = 'search';



// Routes from the database
$route['default_controller'] = 'welcome/index'; 
$route['admin'] = "admin_users/index";
$route['admin/login'] = "admin_users/login";
$route['admin/change_password'] = "admin_users/change_password";
$route['admin/edit_profile'] = "admin_users/edit_profile";
$route['admin/logout'] = "admin_users/logout";
$route['admin/forgot_password'] = "admin_users/forgot_password";
$route['admin/reset_password/(:any)'] = "admin_users/reset_password/$1";
$route['admin/([a-zA-Z_-]+)/(.+)'] = '$1/admin/$2';
$route['admin/([a-zA-Z_-]+)'] = '$1/admin/index';
require_once (BASEPATH .'database/DB.php');
$db =& DB();

// slug will be something like
// 'this-is-a-post'
// 'this-is-another-post'
$sql = 'SELECT * FROM cities';
$query = $db->query($sql);

$result = $query->result();
foreach( $result as $cities )
{
    // first is if multiple pages
    $urlcity = strtolower($cities->city_name);
//Index Page
    $route['list-of-best-schools-in-'.$urlcity] = 'welcome';

//School affiliation Index page
    $route['list-of-best-cbse-schools-in-'.$urlcity] = 'schools/index/cbse';
	$route['list-of-best-international-schools-in-'.$urlcity] = 'schools/index/international';
	$route['list-of-best-matriculation-schools-in-'.$urlcity] = 'schools/index/matriculation';
	$route['list-of-best-special-schools-in-'.$urlcity] = 'schools/index/stateboard';
	$route['list-of-best-kindergarten-schools-in-'.$urlcity] = 'schools/index/kindergarten';
//Enquiry Page
	$route['list-of-best-cbse-schools-in-'.$urlcity.'/enquiry'] = 'schooldetail/enquiry';
	$route['list-of-best-international-schools-in-'.$urlcity.'/enquiry'] = 'schooldetail/enquiry';
	$route['list-of-best-matriculation-schools-in-'.$urlcity.'/enquiry'] = 'schooldetail/enquiry';
	$route['list-of-best-special-schools-in-'.$urlcity.'/enquiry'] = 'schooldetail/enquiry';
	$route['list-of-best-kindergarten-schools-in-'.$urlcity.'/enquiry'] = 'schooldetail/enquiry';

//OTP page
	$route['list-of-best-cbse-schools-in-'.$urlcity.'/otp'] = 'schooldetail/otp';
	$route['list-of-best-international-schools-in-'.$urlcity.'/otp'] = 'schooldetail/otp';
	$route['list-of-best-matriculation-schools-in-'.$urlcity.'/otp'] = 'schooldetail/otp';
	$route['list-of-best-special-schools-in-'.$urlcity.'/otp'] = 'schooldetail/otp';
	$route['list-of-best-kindergarten-schools-in-'.$urlcity.'/otp'] = 'schooldetail/otp';

//Summer Camp
	$route['list-of-best-summer-camp-in-'.$urlcity] = 'summercamp/index';

//SchoolDetails Index page
	$route['list-of-best-cbse-schools-in-'.$urlcity.'/(:any)'] = 'schooldetail/index';
	$route['list-of-best-international-schools-in-'.$urlcity.'/(:any)'] = 'schooldetail/index';
	$route['list-of-best-matriculation-schools-in-'.$urlcity.'/(:any)'] = 'schooldetail/index';
	$route['list-of-best-special-schools-in-'.$urlcity.'/(:any)'] = 'schooldetail/index';
	$route['list-of-best-kindergarten-schools-in-'.$urlcity.'/(:any)'] = 'schooldetail/index';

//Activity Class Index Page
	$route['list-of-best-dance-class-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-music-class-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-coaching-centres-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-school-kits-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-fitness-centre-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-sports-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-martial-arts-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-event-managements-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-costume-designers-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-arts-in-'.$urlcity] = 'activityclass/index';
	$route['list-of-best-transports-in-'.$urlcity] = 'activityclass/index';

//Trainers Page
	$route['list-of-best-dance-class-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-music-class-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-coaching-centres-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-school-kits-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-sports-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-martial-arts-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-event-managements-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-costume-designers-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-arts-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-transports-trainers-in-'.$urlcity] = 'trainer/index';
	$route['list-of-best-fitness-centre-trainers-in-'.$urlcity] = 'trainer/index';

//ClassDetails Index Page
	$route['list-of-best-dance-class-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-music-class-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-coaching-centres-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-school-kits-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-fitness-centre-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-sports-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-martial-arts-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-event-managements-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-costume-designers-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-arts-in-'.$urlcity.'/(:any)'] = 'classdetails/index';
	$route['list-of-best-transports-in-'.$urlcity.'/(:any)'] = 'classdetails/index';

}

//Nav Bar
$route['about-us'] = 'about';
$route['schools-nearby'] = 'nearby/index';
$route['schools-nearby/All'] = 'nearby/index';
$route['schools-nearby/cbse-schools'] = 'nearby/index';
$route['schools-nearby/international-schools'] = 'nearby/index';
$route['schools-nearby/matriculation-schools'] = 'nearby/index';
$route['schools-nearby/special-schools'] = 'nearby/index';
$route['schools-nearby/kindergarten-schools'] = 'nearby/index';
$route['schools-list'] = 'search/index';
$route['schools-list/enquiry'] = 'search/enquiry';
$route['schools-list/otp'] = 'search/otp';
$route['schools-list/newsletter'] = 'search/newsletter';

//SummerCamp pages
$route['camp-search'] = 'campsearch/index';
$route['camp-search/enquiry'] = 'campsearch/enquiry';
$route['camp-search/newsletter'] = 'campsearch/newsletter';

//Navigation bar
$route['contact-us'] = 'contacts/index';
$route['privacy-policy'] = 'Privacy/index';
$route['terms-and-conditions'] = 'terms';
$route['enquiry'] = 'Welcome/enquiry';
$route['otp'] = 'Welcome/otp';
$route['schools/enquiry'] = 'schools/enquiry';
$route['schools/otp'] = 'schools/otp';
$route['classes/enquiry'] = 'activityclass/enquiry';
$route['classes/otp'] = 'activityclass/otp';
$route['about-us/enquiry'] = 'about/enquiry';
$route['about-us/otp'] = 'abouts/otp';


$route['blog'] = 'blog/index';
$route['blog/(:num)'] = 'blog/index';
$route['blogdetails'] = 'blogdetails/index';
$route['blogdetails/(:any)'] = 'blogdetails/index';

$route['404_override'] = 'error/index';
$route['translate_uri_dashes'] = FALSE;

$route['schools-list/(:num)'] = 'search';




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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['logout'] = 'welcome/logout';
$route['schoolfirst'] = 'add_listing_platinum';
$route['schoolsecond'] = 'add_listing_premium';
$route['schoolthird'] = 'add_listing_spectrum';

$route['schoolfirst/(:any)'] = 'add_listing_platinum';
$route['schoolsecond/(:any)'] = 'add_listing_premium';
$route['schoolthird/(:any)'] = 'add_listing_spectrum';

$route['schools-nearby/enquiry'] = 'nearby/enquiry';
$route['schools-nearby/otp'] = 'nearby/otp';
$route['user-analys'] = 'useranalys/index';
$route['school-template'] = 'schooltemplate/index';


$route['institutefirst'] = 'institute_listing_first';
$route['institutesecond'] = 'institute_listing_second';
$route['institutethird'] = 'institute_listing_third';

$route['institutefirst/(:any)'] = 'institute_listing_first';
$route['institutesecond/(:any)'] = 'institute_listing_second';
$route['institutethird/(:any)'] = 'institute_listing_third';




$route['my-account'] = 'myaccount';
$route['my-account/changepassword'] = 'myaccount/changepassword';
$route['my-account/update'] = 'myaccount/update';
$route['my-account/packageview'] = 'myaccount/packageview';
// $route['my-account/(:any)'] = 'My_Account/index';


$route['package'] = 'package_details';
$route['package/(:any)'] = 'package_details';

$route['school-free-trail'] = 'Schoolfreetrail/index';
$route['institute-free-trail'] = 'institutefreetrail/index';

$route['add-listing'] = 'add_listing_spectrum/index';
$route['settings'] = 'Settings/index';

$route['exams/how-to-get-your-exam-results-online'] = 'results/index';
$route['results-information'] = 'resultsinfo/index';
$route['exams/how-to-get-your-exam-results-online/(:any)'] = 'resultsinfo/index';
$route['exams/how-to-get-your-exam-results-online/enquiry'] = 'results/enquiry';
$route['exams/how-to-get-your-exam-results-online/otp'] = 'results/otp';
$route['resultsinfo/enquiry'] = 'results/enquiry';
$route['resultsinfo/otp'] = 'results/otp';
$route['resultsinfo/newsletter'] = 'results/newsletter';

$route['signup'] = 'signup/index';
$route['signup/insert'] = 'signup/insert';
$route['signup/otp'] = 'signup/otp';

$route['signin'] = 'signin/index';
$route['signin/my-account'] = 'signin/check';

$route['checkout'] = 'checkout/index';

$route['register'] = 'signup1/index';
$route['register/my-account'] = 'signup1/insert';



$route['forget-password'] = 'Forget_Password/index';
$route['forget-password/emailcheck'] = 'Forget_Password/emailcheck';
$route['payment-result'] = 'Payment_Result/index';
$route['reset-password'] = 'Reset_Password/index';
$route['payment-failure'] = 'Payment_Failure/index';

$route['schools-signup'] = 'signupschool/index';

//New pages 04/06/2019
$route['notification'] = 'notification';
$route['online-test'] = 'online_test/index';
$route['online-test-conduct'] = 'online_test_conduct/index';
$route['online-test-conduct/calculate'] = 'online_test_conduct/calculate';
$route['online-test-result'] = 'Online_test_result/index';
$route['previous'] = 'previous/index';
$route['question-answer'] = 'question_answer/index';

$route['signin-parent'] = 'signin_parent/index';
$route['signin-student'] = 'signin_student';
$route['signin-student/check'] = 'signin_student/check';
$route['signin-parent/check'] = 'signin_parent/check';

$route['signup-student'] = 'sign_up_student/index';
$route['signup-student/insert'] = 'sign_up_student/insert';
$route['signup-student/otp'] = 'sign_up_student/otp';

$route['signup-parent'] = 'sign_up_parent/index';
$route['signup-parent/insert'] = 'sign_up_parent/insert';
$route['signup-parent/otp'] = 'sign_up_parent/otp';


$route['student-account'] = 'student_settings';
$route['student-account/update'] = 'student_settings/update';

$route['syllabus'] = 'syllabus/index';
$route['careers'] = 'career';
$route['plan-details'] = 'plandetail';
$route['plan-details/(:any)'] = 'plandetail';
$route['plan-details/gallery'] = 'plandetail/gallery';

$route['plandetail_view'] = 'plandetail/plandetail_view';
$route['upgrade-package'] = 'Upgrade_Package/index';
$route['upgrade-package/update_package'] = 'Upgrade_Package/update_package';
$route['upgrade-package/update_package/(:any)/(:any)'] = 'Upgrade_Package/update_package/$1/$2';

$route['spectrumschool'] = 'spectrumschool/index';


$route['smtp'] = 'Smtp/index';

// payment gateway routes

$route['razorpay'] = 'payment/index';
$route['payment/razorPaySuccess'] = 'payment/razorPaySuccess';



$route['cart'] = 'cart/index';
















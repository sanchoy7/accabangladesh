<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
'full_name' => array
    (
        'required' 	=> 'The name cannot be blank! !!',
        //'alpha' 	=> 'Only alphabetic characters are allowed.',
        //'length' 	=> 'The name must be between three and twenty letters.',
		'xss_clean' => 'Invalid malicious input not allowed! !!',
        'default' 	=> '',
    ),
'course_name' => array
    (
        'required' 	=> 'The course name cannot be blank! !!',
        //'alpha' 	=> 'Only alphabetic characters are allowed.',
        //'length' 	=> 'The name must be between three and twenty letters.',
		'xss_clean' => 'Invalid malicious input not allowed! !!',
        'default' 	=> '',
    ),
'contact_no' => array
    (
        'required' 	=> 'The contact number cannot be blank! !!',
        'numeric' 	=> 'Only numbers are allowed! !!',
        'length' 	=> 'The number must be between 7 and 11 numerals! !!',
        'default' 	=> '',
    ),
'email' => array
    (
        'required' 	=> 'The email address cannot be blank! !!',
        //'length' 	=> 'The code must be exactly three numerals.',
        'email' 	=> 'Invalid email address! !!',
        'default' 	=> '',
    ),
'age' => array
    (
        'required' 	=> 'Age cannot be blank! !!',
        'numeric' 	=> 'Only numbers are allowed! !!',
        'length' 	=> 'Please insert valid age! !!',
        'default' 	=> '',
    ),
'education' => array
    (
        'required' 	=> 'Your academic education cannot be blank! !!',
        //'pwd_check' => 'The password is not correct.',
        'default' 	=> '',
    ),
'extra_course' => array
    (
        'required' 	=> 'Write NA if your have no training exprience! !!',
        //'pwd_check' => 'The password is not correct.',
        'default' 	=> '',
    ),
'mailing_address' => array
    (
        'required' 	=> 'Your mailing  address cannot be blank! !!',
        //'pwd_check' => 'The password is not correct.',
        'default' 	=> '',
    ),
);
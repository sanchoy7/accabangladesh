<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
'full_name' => array
    (
        'required' 	=> 'The name cannot be blank',
        //'alpha' 	=> 'Only alphabetic characters are allowed.',
        //'length' 	=> 'The name must be between three and twenty letters.',
		'xss_clean' => 'Invalid malicious input not allowed',
        'default' 	=> '',
    ),
'phone' => array
    (
        'required' 	=> 'The contact number cannot be blank',
        'numeric' 	=> 'Only numbers are allowed',
        'length' 	=> 'The number must be between 7 and 11 numerals',
        'default' 	=> '',
    ),
'email' => array
    (
        'required' 	=> 'The email address cannot be blank',
        //'length' 	=> 'The code must be exactly three numerals.',
        'email' 	=> 'Invalid email address',
        'default' 	=> '',
    ),
'subject' => array
    (
        'required' 	=> 'You must supply a subject',
        //'pwd_check' => 'The password is not correct.',
        'default' 	=> '',
    ),
'message' => array
    (
        'required' 	=> 'The message cannot be blank',
        //'pwd_check' => 'The password is not correct.',
        'default' 	=> '',
    ),
);
<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
'username' => array
    (
        'required' 		=> 'The username cannot be blank',
        'alpha' 		=> 'Only alphabetic characters are allowed.',
        'length' 		=> 'The username must be between 4 and 12 letters.',
        'user_exists' 	=> 'Username already exists',
		'xss_clean' 	=> 'Invalid malicious input not allowed',
        'default' 		=> '',
    ),
'email' => array
    (
        'required' 		=> 'The email address cannot be blank',
        'email' 		=> 'Invalid email address',
        'email_exists' 	=> 'Email address already exists',
        'default' 		=> '',
    ),
'password' => array
    (
        'required' 		=> 'The password cannot be blank',
        'alpha_numeric' => 'Only alpha-numeric characters are allowed.',
        'length' 		=> 'The password must be between 6 and 12 letters.',
        'default' 		=> '',
    ),
'password_confirm' => array
    (
        'required' 		=> 'You must confirm the password',
        'alpha_numeric' => 'Only alpha-numeric characters are allowed.',
        'length' 		=> 'The confirm password must be between 6 and 12 letters.',
        'matches' 		=> 'The passwords doesn\'t match',
        'default' 		=> '',
    ),
'captcha_response' => array
    (
        'required' 	=> 'The captcha code cannot be blank',
        //'length' 	=> 'The code must be exactly three numerals.',
        'valid' 	=> 'Invalid captcha code',
        'default' 	=> '',
    ),
);
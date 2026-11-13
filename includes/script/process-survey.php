<?php

session_start();

// Use 'require_once' instead of 'require' to enforce that a file is only imported one time.
// When in doubt, use require_once
require_once 'includes/functions.php';

$errors = [];

// Accept POST requests to this page.
// Block all request that are not post requests.

$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType !== 'POST') {
    http_response_code(500);
    exit('Must be a POST request!');
}

$formInput = $_POST;

// Store the submitted ($_POST) data in the session, in order to refer to the last
// submission on the survey form page.
$_SESSION['form_input'] = $formInput;


/**
* Validates first name.
*/
if (
    !validateText(
        $_POST['firstName'],
        2,
        50
    )
)
{
    $errors['firstName'] =
        'First name must be between 2 and 50 characters.';
}


/**
* Validates last name.
*/
if (
    !validateText(
        $_POST['lastName'],
        2,
        50
    )
)
{
    $errors['lastName'] =
        'Last name must be between 2 and 50 characters.';
}


/**
* Validates phone number.
*/
if (
    !validatePhone(
        $_POST['phone_number']
    )
)
{
    $errors['phone_number'] =
        'Please enter a valid phone number.';
}


/**
* If validation fails,
* it returns the user to the form.
*/
if (!empty($errors))
{
    $_SESSION['errors'] = $errors;

    // header() sets a header in the response
    // the "Location:" header causes the browser to redirect
    header('Location: Esta_Keisha_PHP_Survey/index.php');

    exit;
}


/**
* Build email.
*/
$message = "

Student Technology Survey

First Name: " . $_POST['firstName'] . "
Last Name: " . $_POST['lastName'] . "
Phone: " . $_POST['phone_number'] . "
Color: " . $_POST['color'] . "
Hobby: " . $_POST['hobby'] . "

";


/**
* Send email.
*/
mail(
    'your@email.com',
    'Survey Submission',
    $message
);


/**
* Redirect on success.
*/
header('Location: Esta_Keisha_PHP_Survey/index.php');

exit;
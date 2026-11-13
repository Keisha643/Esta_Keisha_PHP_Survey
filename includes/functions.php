<?php

declare(strict_types=1);


// declare a file full of helper functions so that we can keep our code DRY:
//
// D: DO NOT
// R: REPEAT
// Y: YOURSELF

/**
 * Validates a text field using length requirements.
 *
 * Centralizing text validation prevents duplicated code
 * throughout the survey while processing file and ensures
 * all text-based questions follow the rules.
 *
 * @param string $value User submitted value.
 * @param int $min Minimum accepted length.
 * @param int $max Maximum accepted length.
 * @return bool
 */
function validateText(
    string $value,
    int $min,
    int $max
): bool
{
    $length = strlen(trim($value));

    return $length >= $min
        && $length <= $max;
}

/**
 * Validates email addresses.
 *
 * Uses PHP's built-in email validation filter
 * to ensure the submitted value resembles a
 * proper formatted email address.
 *
 * @param string $email
 * @return bool
 */
function validateEmail(string $email): bool
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
}


/**
 * Validates phone number format.
 * 
 * Accepts common Canadian phone number layouts 
 * while rejecting unsupported symbols.
 *
 * @param string $phone
 * @return bool
 */
function validatePhone(string $phone): bool
{
    return preg_match(
       "/^[0-9+\-\s()]{7,20}$/",
       $phone
    );
}


/**
 * Validates date value.
 *
 * This survey asks users about past
 * experiences so the future dates are
 * considered invalid.
 *
 * @param string $date
 * @return bool
 */
function validatePastDate(string $date): bool{
    return strtotime($date) <= time();
}


/**
 * Checks that submitted values belong to
 * an approved list of options.
 *
 * Server validation is required because
 * users can edit HTML and submit
 * values that are not shown in the survey form.
 *
 * @param array $submitted
 * @param array $allowed
 * @return bool
 */
function validateSelections(
    array $submitted,
    array $allowed
): bool
{
    foreach ($submitted as $value)
    {
       if (!in_array($value, $allowed))
       {
            return false;
       }
    }
    return true;
}
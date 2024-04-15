<?php
function isTextValid($text, $minLength, $maxLength) {
    $length = strlen($text);
    return ($length >= $minLength && $length <= $maxLength);
}

function isNumberValid($number, $min, $max) {
    return (is_numeric($number) && $number >= $min && $number <= $max);
}

function isOptionValid($option, $allowedOptions) {
    return in_array($option, $allowedOptions);
}
?>
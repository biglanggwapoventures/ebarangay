<?php

if (!function_exists('preset')) {

    function preset($arr, $key, $default = FALSE) {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }

}


if (!function_exists('role_dropdown')) {

    function role_dropdown($name, $default, $attrs = '') {
        $options = ['' => '', 'su' => 'Superuser', 'a' => 'Administrator', 's' => 'Standard user'];
        return form_dropdown($name, $options, $default, $attrs);
    }

}

if (!function_exists('gender_dropdown')) {

    function gender_dropdown($name, $default, $attrs = '') {
        $options = ['' => '', 'm' => 'Male', 'f' => 'Female'];
        return form_dropdown($name, $options, $default, $attrs);
    }

}

if (!function_exists('acqm_dropdown')) {

    function acqm_dropdown($name, $default, $attrs = '') {
        $options = ['' => '', 'b' => 'Bought', 'd' => 'Donated'];
        return form_dropdown($name, $options, $default, $attrs);
    }

}

if (!function_exists('acqs_dropdown')) {

    function acqs_dropdown($name, $default, $attrs = '') {
        $options = ['' => '', 'o' => 'Old', 'n' => 'New'];
        return form_dropdown($name, $options, $default, $attrs);
    }

}
if (!function_exists('itemclass_dropdown')) {

    function itemclass_dropdown($name, $default, $attrs = '') {
        $options = ['' => '', 'c' => 'Countable', 'uc' => 'Uncountable'];
        return form_dropdown($name, $options, $default, $attrs);
    }

}

if (!function_exists('checked')) {

    function checked($value, $input) {
        return $value === $input ? 'checked="checked"' : '';
    }

}









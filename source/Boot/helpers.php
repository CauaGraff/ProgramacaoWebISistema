<?php

/**
 * ####################
 * ## SHARED HELPERS ##
 * ####################
 */

function shared($path)
{
    return CONF_SITE_URL . "/shared/{$path}";
}

function shared_css($filename)
{
    return shared('css/' . $filename);
}

function shared_js($filename)
{
    return shared('js/' . $filename);
}

function shared_img($filename)
{
    return shared('img/' . $filename);
}

function shared_plugins($filename)
{
    return shared('plugins/' . $filename);
}

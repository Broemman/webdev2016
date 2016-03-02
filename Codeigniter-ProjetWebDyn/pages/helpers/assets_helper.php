<?php

if (! function_exists('img')){

function img($nom, $alt = '')
{
 return'<img src="'. base_url() . 'assets/images/' . $nom . '"alt="' . $alt .'" />';
 }
}

if (! function_exists('js_url')){

function js_url($nom)
{
 return base_url() . 'assets/js/' . $nom .'.js';
 }
}

if (! function_exists('css_url')){

function css_url($nom)
{
 return base_url() . 'assets/css/' . $nom .'.css';
 }
}


if (! function_exists('js')){

function js($nom)
{
 return '<script src="'.js_url($nom).'"></script>' . "\n";
 }
}

if (! function_exists('css')){

function css($nom)
{
 return '<link rel="stylesheet" type="text/css" href="'.css_url($nom).'" />' . "\n";
 }
}


?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//source: http://www.the-art-of-web.com/php/sortarray/#.UMnWn959Emd
function alfabetize_courses($a, $b)
{
    return strnatcmp($a['title'], $b['title']);
}


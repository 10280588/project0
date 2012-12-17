<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function if_not_logged_in_redirect()
{
    if(!isset($_COOKIE['uid']))
    { 
        redirect('users/login');
        return FALSE; 
    }
    else
    { 
         return TRUE;
}

}

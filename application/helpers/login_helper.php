<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_logged_in()
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

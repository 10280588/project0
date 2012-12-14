<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//source: http://www.the-art-of-web.com/php/sortarray/#.UMnWn959Emd
function alfabetize_courses($a, $b)
{
    return strnatcmp($a['title'], $b['title']);
}

function merge_courses_xor($totalArray, $addArray)
{
    foreach($addArray as $add)
    {
        $i = FALSE;
        
        foreach($totalArray as $total)
        {
            if($add['course_unique'] == $total['course_unique'])
            {
                $i=TRUE;
            }
        }
        
        if($i === FALSE)
        {
            array_push($totalArray, $add);
        }                
    }

    return $totalArray;		
}

function merge_courses_and($totalArray, $addArray)
{
    $totalAndArray = array();
    
    foreach($addArray as $add)
    {
        $i = FALSE;
        
        foreach($totalArray as $total)
        {
            if($add['course_unique'] == $total['course_unique'])
            {
                $i=TRUE;
            }
        }
        
        if($i === TRUE)
        {
            array_push($totalAndArray, $add);
        }                
    }

    return $totalAndArray;		
}

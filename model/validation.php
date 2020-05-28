<?php

/**
 * contains the validation methods for my dating app
 * @author Chunhai Yang
 * @version 1.0
 */


   function validName($firstName,$lastName){
       $firstName = str_replace(" ","",$firstName);
       $lastName = str_replace(" ","",$lastName);

       return !empty($firstName) && ctype_alpha($firstName) && !empty($lastName) && ctype_alpha($lastName);
   }

   function validAge($age){

        return is_numeric($age) && ($age >= 18 && $age <=118);
   }

   function validPhone($phone){

    return is_numeric($phone) && (strlen($phone)>=0 && strlen($phone) <= 11);
  }

  function validEmail($email){

     return(filter_var($email, FILTER_VALIDATE_EMAIL));

 }

 function validIndoor($indoor)
 {
     $indoors = getIndoor();
     return in_array($indoor,$indoors);
 }

function validOutdoor($outdoor)
{
    $outdoors = getOutdoor();
    return in_array($outdoor,$outdoors);
}








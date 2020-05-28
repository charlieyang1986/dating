<?php

/**
 * contains the validation methods for my dating app
 * @author Chunhai Yang
 * @version 1.0
 */

   // validate name string to make sure the input is alphabetic and not empty
   function validName($firstName,$lastName){
       $firstName = str_replace(" ","",$firstName);
       $lastName = str_replace(" ","",$lastName);

       return !empty($firstName) && ctype_alpha($firstName) && !empty($lastName) && ctype_alpha($lastName);
   }
   // ensure the age input is between 18 and 118
   function validAge($age){

        return is_numeric($age) && ($age >= 18 && $age <=118);
   }
   // ensure the phone number input length is between 0 and 11
   function validPhone($phone){

    return is_numeric($phone) && (strlen($phone)>=0 && strlen($phone) <= 11);
  }
  // ensure the email format is correct
  function validEmail($email){

     return(filter_var($email, FILTER_VALIDATE_EMAIL));

 }
 // this function prevents spoofing
 function validIndoor($indoor){

$indoors = getIndoor();
    foreach($indoor as $ind){
        if(!in_array($ind,$indoors)){
            return false;
        }
    }
    return true;

}
// this function prevents spoofing
function validOutdoor($outdoor){

    $outdoors = getOutdoor();
    foreach($outdoor as $outd){
        if(!in_array($outd,$outdoors)){
            return false;
        }
    }
    return true;

}








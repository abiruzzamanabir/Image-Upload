<?php


function checkAge($birthYear){
    $currentYear=date("Y");
    $age=$currentYear-$birthYear;
    return "Your birth year {$birthYear} & now you're {$age} years old.";
}

?>
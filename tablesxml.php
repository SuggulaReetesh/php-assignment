<?php
include 'connect.php';


$query = "select * from users";

$usersArray = array();
$result = mysqli_query($con,$query);

if ($result = mysqli_query($con,$query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
       array_push($usersArray, $row);
    }
  
    if(count($usersArray)){

         createXMLfile($usersArray);

     }

    /* free result set */
    $result->free();
}


function createXMLfile($usersArray){
  
   $filePath = 'user.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('Users'); 

   for($i=0; $i<count($usersArray); $i++){
     
     $userId        =  $usersArray[$i]['id'];  

     $firstName      =  htmlspecialchars($usersArray[$i]['firstname']); 

     $lastname    =  $usersArray[$i]['lastname']; 

     $pssword     =  $usersArray[$i]['pssword']; 

     $university      =  $usersArray[$i]['university']; 

     $address  =  $usersArray[$i]['addressses'];	

     $user = $dom->createElement('User');

     $user->setAttribute('id', $userId);

     $firstname     = $dom->createElement('firstname', $firstName); 

     $user->appendChild($firstname); 

     $lastName   = $dom->createElement('lastname', $lastname); 

     $user->appendChild($lastName); 

     $password    = $dom->createElement('password', $pssword); 

     $user->appendChild($password); 

     $University     = $dom->createElement('university', $university); 

     $user->appendChild($University); 
     
     $addresses = $dom->createElement('category', $address); 

     $user->appendChild($addresses);
 
     $root->appendChild($user);

   }

   $dom->appendChild($root); 

   $dom->save($filePath); 

 } 
 ?>
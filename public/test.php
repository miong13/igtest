<?php
  
// Store the string into variable
$password = 'pa55w0rd!';
  
// Use password_hash() function to
// create a password hash
$hash_default_salt = password_hash($password,
                            PASSWORD_DEFAULT);

$hash_variable_salt = password_hash($password,
                            PASSWORD_DEFAULT, array('cost' => 10));
echo $hash_default_salt;
echo '<br>';
echo $hash_variable_salt;
echo '<br>';
  

  
// Use password_verify() function to
// verify the password matches
echo password_verify('Password',
            $hash_default_salt ) . "<br>";
  
echo password_verify('Password',
            $hash_variable_salt ) . "<br>";
  
echo password_verify('Password123',
            $hash_default_salt );
  
?>
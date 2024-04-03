<?php
   $username = null;	
   $password = null; 	
   $username_error = null;  
   $password_error = null; 
   $success = null;
   $username_register = null;
   $email = null;
   $password_register = null;
   $confirm_password = null;
   $username_register_error = null;
   $email_error = null;
   $password_register_error = null;
   $confirm_password_error = null;
   $success_register = null;
 
   if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
 
      if(empty(trim($username))) {
         $username_error = "Incorrect username!";
      }else{
         if(empty(trim($password))) {
            $password_error = "Incorrect password!";
         }else{
            $success = "Login successful";
         }
      }
   }

   if(isset($_POST['register'])) {
      $username_register = $_POST['username-register'];
      $email = $_POST['email'];
      $password_register = $_POST['password-register'];
      $confirm_password = $_POST['confirm-password'];
 
      if(empty(trim($username_register))) {
         $username_error = "Invalid username!";
      }
      if(empty(trim($email))) {
            $email_error = "Invalid email!";
      }
      if(empty(trim($password_register))) {
         $password_error = "Invalid password!";
      }
      if($confirm_password != $password_register) {
         $confirm_password_error = "Password doesn't match!";
      }
      if(!isset($_POST['terms'])) {
         echo "You must agree on the terms and conditions";
      }
      else{
          $success_register = "Registration complete";
      }
   }
<?php
session_start();
////ERROR ARRAY;
$errors= array();

//Error Variables///////
// $first_nameErr=""; $genderErr=""; $last_nameErr=""; $emailErr="";
// $designationErr=""; $departmentErr=""; $passwordErr="";

//input variable///////
 $email=""; $password="";

///checking validation/////////

if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Validation for Email field//////////
  //Validation for Email field//////////
  if(empty($_POST['email'])){
     $errors['email']='';
    $_SESSION['email']='email is required';
   header('location: login.php');
  }else{
    $email=$_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){$errors['email1']=''; $_SESSION['email1']='Email is invalid';  header('location: login.php');}

    if(strlen($email) <= 5){$errors['email2']=''; $_SESSION['email2']='Email must not be less than 5';  header('location: login.php');}

    if(!strpos($email, '.')){$errors['email3']=''; $_SESSION['email3']='Email must contain ' . ". " . 'symbol';  header('location: login.php');}
      }// End Validation for Email field//////////



      //Validation for Password field//////////
        if(empty($_POST['password'])){
         $errors['password']='';
        $_SESSION['password']='password is required';
       header('location: login.php');
      }else{
        $password=$_POST['password'];
        if(strlen($password) <= 7){$errors['password1']=''."<br>"; $_SESSION['password1']='paasword must atleast be 8 characters';  header('location: login.php');}

      }// End Validation for Password field//////////



  if (count($errors) > 0) {
    //  header('location: login.php'); redirect to login page
    echo 'you have  errors';
  }else{

    $data=[
         'email' =>$email,
         'password' =>$password,
     ];
    //  echo 'success'. "<br>"; ///redirect to dashboard

      $all_users= scandir("db/user/");
      $count_users = count($all_users);

      // echo $count_users;
      // $accurate_user = $count_users-1;


      for ($counter=0; $counter < $count_users ; $counter++) {
         $current_user = $all_users[$counter];

        if($current_user){
          //  echo 'there are users';
            //checking user password from the jason content in the get_included_files
            $usercontent= file_get_contents("db/user/".$current_user."json");
            echo $usercontent;
            // $decode_user_content= json_decode($usercontent);
            // $user_content_password =$decode_user_content->password;
            // $user_password = password_verify($data['password'] , $user_content_password);


           //  if($current_user==$email.".json" && $user_content_password == $user_password){
           //    //   echo 'welcome to dashboard'; ///redirect to dashbo
           //       header('location: dashboard.php');
           //
           //       die();
           //
           //   }
           //   }else{
           //
           //    header('location: register.php');
           //
           //
           // }
           }
         }
       }
     }

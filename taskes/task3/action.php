<?php 



  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name     = $_POST['name'];
      $email    = $_POST['email'];
      $websit= $_POST['websit'];
     
      $errors = []; 

      if(empty($name)){    
            $errors['name'] = 'Field is Required';
      } elseif(strlen($name) < 3){
        $errors['name'] = 'short name';

      }elseif(strlen($name) > 10){
        $errors['name'] = 'long name';

      }elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
        $errors['name'] = 'not string';

      }  
      
      }

    
        if(empty($email)){
            $errors['email'] = 'Field is Required';
        }

        if(empty($websit)){
            $errors['websit'] = 'Field is Required';
        }elseif (strpos($websit, 'http') !== false) { 
            $errors['websit'] = $websit;

        }else{
            $errors['websit'] = 'not url';

        }

        

        
     

         if(count($errors) > 0){

             foreach ($errors as $key => $value) {
                 echo $key.' : '.$value.'<br>';
             }
         }else{
    echo $name.' || '.$email.' || '.$websit; 
}


?>
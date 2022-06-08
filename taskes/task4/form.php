<?php


function clean($input){
    
    $input = trim($input); 
    $input = stripslashes($input); 
    $input = strip_tags($input); 
    return $input;
    

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name     = clean($_POST['name']);
    $email    = clean($_POST['email']);
    $password = clean($_POST['password']);
    $address = clean($_POST['address']);
    $url = clean($_POST['url']);
    $gender = clean($_POST['gender']); 

    $errors = [];


    if (empty($name)) {    
        $errors['name'] = 'Field is Required';
    }elseif (!ctype_alpha(str_replace(' ', '', $name))) {
        $errors['name'] = 'Name must be only letters';
    }



   
    if (empty($email)) {
        $errors['email'] = 'Field is Required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid Email';
    }


  
    if (empty($password)) {
        $errors['password'] = 'Field is Required';
    } elseif (strlen($password) > 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }



    
     if (empty($address)) {
        $errors['address'] = 'Field is Required';
    } elseif (strlen($address)!==10) {
        $errors['address'] = 'address must be 10 characters';
    }





if (empty($url)) {
    $errors['url'] = 'Field is Required';
} elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
    $errors['url'] = 'Invalid url';
}


if (empty($gender)) {
    $errors['gender'] = 'Field is Required';
} elseif ($gender == 'male' || $gender == 'female') {
    $errors['gender'] = $gender;
}





//Array ( [cv] => Array ( [name] => HTML v4.pdf [type] => application/pdf [tmp_name] => C:\xampp\tmp\phpFD93.tmp [error] => 0 [size] => 3860297 ) )
if (!empty($_FILES['cv']['name'])) {

$tempName  = $_FILES['cv']['tmp_name'];
$imageName = $_FILES['cv']['name'];
$imageType = $_FILES['cv']['type'];


$extensionArray = explode('/', $imageType);
$extension =  strtoupper( end($extensionArray));

$allowedExtensions = ['PDF'];    




if (in_array($extension, $allowedExtensions)) {

    $finalName = uniqid() . time() . '.' . $extension;

    $disPath = 'uploads/' . $finalName;

    if (move_uploaded_file($tempName, $disPath)) {
        echo 'File Uploaded Successfully';
    } else {
        echo 'File Uploaded Failed';
    }
} else {
    echo 'File Type Not Allowed';
}
} else {
echo 'Please Select File';
}










    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            echo $key . ' : ' . $value . '<br>';
        }
    } 
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>
        <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" >
            </div>
           

            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" name="email">
            </div>
           

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" name="password">       
             </div>

             <div class="form-group">
                <label for="exampleInputName">Address</label>
                <input type="text" name="address" >
            </div>

            <div class="form-group">
                <label for="exampleInputURL">Linkedin URL</label>
                <input type="text" name="url" >
            </div>

            <div class="form-group">
                <label for="exampleInputGENDER">Gender</label>
                <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select>           
             </div>

             <div class="form-group">
                <label for="exampleInputCV">CV</label>
                <input type="file" name="cv" >
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
<?php

require 'database.php';

function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title     = clean($_POST['title']);
    $content    = clean($_POST['content']);
    $image = clean($_POST['image']);


    $errors = [];

    if (empty($title)) {   
        $errors['title'] = 'Field is Required';
    }elseif (!ctype_alpha(str_replace(' ', '', $title))) {
        $errors['title'] = 'title must be only letters';
    }


   
    if (empty($content)) {
        $errors['content'] = 'Field is Required';
    } elseif (strlen($content) < 50) {
        $errors['content'] = 'content must be at least 50 characters';
    }


    


    if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Field Required";
    } else {

        $imageType = $_FILES['image']['type'];
        $extensionArray = explode('/', $imageType);
        $extension =  strtolower(end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (!in_array($extension, $allowedExtensions)) {

            $errors['image'] = "File Type Not Allowed";
        }
    }



    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        # Upload Image . . .
        $finalName = uniqid() . time() . '.' . $extension;
        $disPath = 'uploades/' . $finalName;
        # Get Temp Path . . .
        $tempName  = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($tempName, $disPath)) {

        $sql = "insert into input (title,content,image) values ('$title','$content','$finalName')";

        $op =  mysqli_query($con, $sql);

        if ($op) {
            echo "Success , Your Account Created";
        } else {
            echo "Failed , " . mysqli_error($con);
        }
       } else {
        echo 'Error In Saving Data  , Try Again';
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" name="content" id="exampleInputContent" aria-describedby="" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>


           

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>
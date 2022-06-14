<?php

require 'database.php';


##################################################################################################################
 
$id = $_GET['id'];
$sql = "select id,title,content,image from input where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);

##################################################################################################################







# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = clean($_POST['title']);
    $content    = clean($_POST['content']);
    $image = clean($_POST['image']);


    # Validate ...... 
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

    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

      # Upload Image . . .
      $finalName = uniqid() . time() . '.' . $extension;
      $disPath = 'uploades/' . $finalName;
      # Get Temp Path . . .
      $tempName  = $_FILES['image']['tmp_name'];
      if (move_uploaded_file($tempName, $disPath)) {


        $sql = "update input set title = '$title', content = '$content', image = '$finalName' where id = $id";

        $op =  mysqli_query($con, $sql);

        if ($op) {
            $message =  "Success , Your Account Updated";

            $_SESSION['message'] = $message;
            
            header('Location: index.php');
            exit(); 

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
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" placeholder="Enter Name" value = "<?php echo $data['title'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" name="content" id="exampleInputContent" aria-describedby="" placeholder="Enter content" value = "<?php echo $data['content'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image" value = "<?php echo $data['image'];?>">
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>
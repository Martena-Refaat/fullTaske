<?php

require 'dbconnection.php';
 
$id = $_GET['id'];
$sql = "select * from data where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);


function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $project     = Clean($_POST['project']);
    $article = Clean($_POST['article']);
    $granularity    = Clean($_POST['granularity']);
    $timestamp     = Clean($_POST['timestamp']);
    $access = Clean($_POST['access']);
    $agent    = Clean($_POST['agent']);
    $views    = Clean($_POST['views']);


    $errors = [];

    if (empty($project)) {
        $errors['project'] = "Field Required";
    }
    if (empty($article)) {
        $errors['article'] = "Field Required";
    }
    if (empty($granularity)) {
        $errors['granularity'] = "Field Required";
    }
    if (empty($timestamp)) {
        $errors['timestamp'] = "Field Required";
    }
    if (empty($access)) {
        $errors['access'] = "Field Required";
    }
    if (empty($agent)) {
        $errors['agent'] = "Field Required";
    }
    if (empty($views)) {
        $errors['views'] = "Field Required";
    }


    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        foreach ($items as $key => $item) {  
            $project= $item['project'];    
            $article= $item['article'];    
            $granularity= $item['granularity'];    
            $timestamp= $item['timestamp'];    
            $access= $item['access'];    
            $agent= $item['agent'];    
            $views= $item['views'];    
       
        $sql = "update data set project = '$project', article = '$article' , granularity = '$granularity', timestamp = '$timestamp', access = '$access', agent = '$agent', views = '$views'  where id = $id";
        $op =  mysqli_query($con, $sql);
        if ($op) {
            $message =  "Success , Your Account Updated";
            $_SESSION['message'] = $message;
            header('Location: index.php');
            exit(); 
        } else {
            echo "Failed , " . mysqli_error($con);
        }
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
                <label for="exampleInputName">project</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="project"   value = "<?php echo $data['project'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">article</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="article"   value = "<?php echo $data['article'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">granularity</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="granularity"   value = "<?php echo $data['granularity'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">timestamp</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="timestamp"   value = "<?php echo $data['timestamp'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">access</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="access"   value = "<?php echo $data['access'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">agent</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="agent"   value = "<?php echo $data['agent'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputName">views</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="views"   value = "<?php echo $data['views'];?>">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>
<?php 
require 'close.php';

?>
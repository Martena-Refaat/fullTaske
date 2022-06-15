<?php

require 'dbconnection.php';

$link = "https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930";

$jsonObj = file_get_contents($link);
$data =    json_decode($jsonObj,true);
$items=$data['items'];


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
      
      
          $sql = "insert into data(project, article, granularity, timestamp, access, agent, views)
          values('$project', '$article', '$granularity', '$timestamp', '$access', '$agent', '$views')";
          $op =  mysqli_query($con, $sql);
      
          if ($op) {
              echo "Success , Your Account Created";
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
    <title>json data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>json data</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">project</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="project" >
            </div>

            <div class="form-group">
                <label for="exampleInputName">article</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="article" >
            </div>

            <div class="form-group">
                <label for="exampleInputName">granularity</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="granularity" >
            </div>

            <div class="form-group">
                <label for="exampleInputName">timestamp</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="timestamp" >
            </div>

            <div class="form-group">
                <label for="exampleInputName">access</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="access" >
            </div>

            <div class="form-group">
                <label for="exampleInputName">agent</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="agent">
            </div>

            <div class="form-group">
                <label for="exampleInputName">views</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="views" >
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>
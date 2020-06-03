<style media="screen">

body{
  font-family:lato;

}
.whoiam{
   padding:15px;
   box-shadow:0 0 8px #ccc;
   margin: 15px;
   width: 45vw;
   word-wrap: break-word;
   border-radius:20px 6px 20px 6px;
   transition: all 0.5s ease-in 0.1s;
   background-color: #e91e63c9;
   color: #fff;
}

.whoiam:nth-of-type(odd){
  border-radius:20px 6px 20px 6px;
  background-color: #03a9f4d1;
}

.whoiam:nth-of-type(odd):hover{
  background-color: #03a9f4;
}
.error-div{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

}
.error, .error-num{
  color: #ccc;
}
.error{
  display: inline-block;
  margin-top: -200px;
  font-size: 1.5rem;
}
.error-num{
  font-size: 10.5rem;
  font-weight: 700;
}

.whoiam:hover{
  background-color: #e91e63;
  box-shadow:0 5px 15px #ccc;
}
</style>
<?php
  $dir = "./scripts/";

  $files = scandir($dir);
  $filesLength = count($files);

  $index = 2;

  $titans = array();

  $error = "Query is not valid";
  $error_num = "404";

  while($index < $filesLength){

    $array = explode('.', $dir.$files[$index]);
    $extension = end($array);

    switch ($extension) {
      case 'js':
      $output = exec('node '.$dir.$files[$index]);
        break;

      case 'php':
      $output = exec('php '.$dir.$files[$index]);
      break;

      case 'py':
      $output = exec('python '.$dir.$files[$index]);
      break;

      default:
        $output = "nothing do you jare";
        break;
    }

    preg_match_all("/\[(.*?)\]/",$output,$split);

    $jsonForm = array("Full Name"=>$split[1][0], "ID"=>$split[1][1], "Language"=>$split[1][2]);
    array_push($titans, $jsonForm);

    $queries = $_SERVER['QUERY_STRING'];
    // print_r($queries);
    if($queries === "" || $queries === "html"){
      echo '<p class="whoiam">'. $output .'</p>';
      // echo "<br/>";
    }

    $index++;

  }


  // function findOut(){
  //
  // }

  if($queries === "json"){

    $fineJson = json_encode($titans, JSON_PRETTY_PRINT);
    echo '<pre>'.$fineJson.'</pre>';
    return false;
  }elseif($queries !== ""){
    echo '<div class="error-div">';
    echo '<p class="error-num">'.$error_num.'</p>';
    echo '<span class="error">'.$error.'</span>';
    echo '</div>';
    return false;

  }

 ?>

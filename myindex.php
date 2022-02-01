<?php

$id = rand(1, 493);
$character = file_get_contents("https://rickandmortyapi.com/api/character/$id");
//$character = file_get_contents("https://rickandmortyapi.com/api/character/3");

//$url = 'https://jsonplaceholder.typicode.com/posts/1';
//$url = 'https://rickandmortyapi.com/api';
//$url = 'https://rickandmortyapi.com/api/character/'.$id;
$url = 'https://rickandmortyapi.com/api/character?page=1';
$url = 'https://rickandmortyapi.com/api/character';
//$url = 'https://rickandmortyapi.com/api';
//$url = 'https://rickandmortyapi.com/api/character/?page=2';
$json = file_get_contents($url);
$jo = json_decode($json, true);
//$jo = json_decode($json);
$data = json_decode($json, true);
//echo $jo->title;
//echo $jo->info;
//echo 'Name is '.$jo['name'].'';
//var_dump($jo);


//***************************************TRANSANCTION ON LOCATION**********************************************
        //*******************GET INFO LOCATION **********************************************
        $getUrl = 'https://rickandmortyapi.com/api/character/';
        $getContentFromJsonFile = file_get_contents($getUrl);
        $decodeJsonContent = json_decode($getContentFromJsonFile, true);
        $count = $decodeJsonContent['info']['count'];
        //$allContentIds = '1,2'; // Defining a string of all content's ids
        foreach($decodeJsonContent['info'] as $keyContent=>$valueContent){
            echo 'Key: '.$keyContent. '</br>';
            echo 'Value: '.$valueContent. '</br>';
            if(is_array($valueContent)){
        //$valueContent
                
            }
            if($keyContent=='count'){
                if($count>1) {
                    for ($id = 1; $id <= $valueContent; $id++) {
                        $allContentIds .= $id.",";
                    }
                }
                else {
                    $allCharacterIds = 1;
                }
            }
        }
        echo 'Count: '.$count. '</br>';
        echo 'Number of id: '.$allContentIds. '</br>';
       // exit;
        //END GET INFO*********************************/
        //*******************************************INSERTING LOCATIONS************************************
        $getUrl = 'https://rickandmortyapi.com/api/location/'.$allContentIds;
        $getContentFromJsonFile = file_get_contents($getUrl); // Get Json file content from URL
        $decodeJsonContent = json_decode($getContentFromJsonFile, true); // Decoding Json content into Array
        $character_id = 0;// Initialisation of character_id
        $location_id = 0;// Initialisation of location_id
        $associatedCharacter_id = 0;// 
        if($count > 1) {
            foreach($decodeJsonContent as $valueContent){
                // Inserting Location into Table locations linked to the model Location
                /*if(is_int((int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT))){
                        $character_id = (int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT); //Extracting the location id from the url
                    }
                */
                // Inserting Location into Table locations linked to the model Location
                /*
                 Location::create([
                    'id' => $valueContent['id'],
                    'name' => $valueContent['name'],
                    'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                    'type' => $valueContent['type'],
                    'dimension' => $valueContent['dimension'],
                    'url' => $valueContent['url'],
                    'created' => $valueContent['created'],
                ]);
                */
                echo 'IDs: '.$valueContent['id']. '</br>';
                echo 'TYPEs: '.$valueContent['type']. '</br>';
                //exit;
                // Insert the  characters that located at the location
                /*
                foreach($valueContent['residents'] as $keyContentAssociated=>$valueContentAssociated){
                    $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
                    if(is_int($associatedId)){
                        $associatedCharacter_id = $associatedId;
                    }
                    // Inserting now....
                     Resident::create([
                            'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                            'location_id' => $valueContent['id'],
                            'character_id' => $associatedCharacter_id,
                    ]);
                }
                */
               
            }
             exit;
        }
        elseif($count == 1) { // In case we have only one location in the COUNT (like https://rickandmortyapi.com/api/location/1) 
             if(is_int((int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT))){
                        $character_id = (int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT); //Extracting the location id from the url
                    }
           // Inserting a single character into Table characters linked to the model Character
            Character::create([
                    'id' => $valueContent['id'],
                    'name' => $valueContent['name'],
                    'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                    'type' => $valueContent['type'],
                    'dimension' => $valueContent['dimension'],
                    'url' => $valueContent['url'],
                    'created' => $valueContent['created'],
            ]);
            // Insert the  characters that located at the location
                
                foreach($valueContent['residents'] as $keyContentAssociated=>$valueContentAssociated){
                    $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
                    if(is_int($associatedId)){
                        $associatedCharacter_id = $associatedId;
                    }
                    // Inserting now....
                     Resident::create([
                            'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                            'location_id' => $valueContent['id'],
                            'character_id' => $associatedCharacter_id,
                    ]);
                }
        }
//*******************************************INSERTING LOCATIONS************************************
    //***************************************END TRANSANCTION ON LOCATION**********************************************











//echo $jo;
//foreach($data['results'] as $key=>$val) { // this can be ommited if only 0 index is there after 
//foreach($data as $key=>$val) { // this can be ommited if only 0 index is there after 
//league and $data['league'][0]['events'] can be used in below foreach instead of $val['events'].
      //foreach($val['results'] as $keys=>$value){
      //foreach($key['results'] as $keys=>$value){
        //echo $value['home'].' v '.$value['away'].'<br>;
        //echo $key.'<br>';
        //foreach($key as $keys=>$value){
        //    echo $keys.'<br>';
    //}  
//}

//*******************GET INFO**********************************************
$getUrl = 'https://rickandmortyapi.com/api/character/';
//$getUrl = 'https://rickandmortyapi.com/api/episode';
$getContentFromJsonFile = file_get_contents($getUrl);
$decodeJsonContent = json_decode($getContentFromJsonFile, true);
$count = $decodeJsonContent['info']['count'];
foreach($decodeJsonContent['info'] as $keyContent=>$valueContent){
  if($keyContent=='count'){
    echo $keyContent.': '.$valueContent.'</br>';
    if($valueContent>1) {
      for ($id = 1; $id <= $valueContent; $id++) {
        $allContentIds .= $id.",";
        }  
    }
    else {
        $allCharacterIds = 1;
    }
  }
}
echo $allContentIds. '</br>';
//exit;
//END GET INFO*********************************/

/*******************************************INSERTING CHARACTERS************************************
$getUrl = 'https://rickandmortyapi.com/api/character/'.$allContentIds;
$getUrl = 'https://rickandmortyapi.com/api/episode/'.$allContentIds;

$getContentFromJsonFile = file_get_contents($getUrl);
$decodeJsonContent = json_decode($getContentFromJsonFile, true);

if($count > 1) {
    foreach($decodeJsonContent as $valueContent){
        echo '</br>';
        echo 'Id:' .$valueContent['id'].'</br>';
        echo 'Name:' .$valueContent['name'].'</br>';
        echo 'Yes </br>';
    }
}
else {
    //echo '</br>';
    echo 'Id:' .$decodeJsonContent['id'].'</br>';
    echo 'Name:' .$decodeJsonContent['name'].'</br>';
}
//echo '</br>'.$baseUrl;
exit;
//********************************************END INSERTING CHARACTERS************************************/

/*******************EXTRACT IDs FROM URLs*******************************************************
$str = 'In My Cart : 11 12 items';
$getUrl = "https://rickandmortyapi.com/api/character/144";
preg_match_all('!\d+!', $getUrl, $matches);
//$associatedId = (int)filter_var($getUrl, FILTER_SANITIZE_NUMBER_INT);
$associatedId = (int)filter_var($getUrl, FILTER_SANITIZE_NUMBER_INT); // Here we assume that the url has only one associated id. So from the string, we extract the integer value

//print_r($matches);

// OUTPUT *******************
//Array
//(
//    [0] => Array
//        (
//            [0] => id
//            [1] => 4
//        )

//)

//$associatedId = $matches[0][0]; // Here we assume that the url has only one associated id. So from the 2D of the array, we extract the value [0][0]
echo $associatedId;
exit;
//*******************END EXTRACT IDs FROM URLs*******************************************************/


//********************* INSERT CONTENT WITH ASSOCIATED IDs**********************************************

$getUrl = 'https://rickandmortyapi.com/api/character/'.$allContentIds;
//$getUrl = 'https://rickandmortyapi.com/api/episode/'.$allContentIds;

$getContentFromJsonFile = file_get_contents($getUrl);
$decodeJsonContent = json_decode($getContentFromJsonFile, true);

if($count > 1) {
    foreach($decodeJsonContent as $keyContent=>$valueContent){
        echo '</br>';
        echo 'Id:' .$valueContent['id'].'</br>';
        echo 'Name:' .$valueContent['name'].'</br>';
        echo 'Gender: '.$valueContent['gender'].'</br>';
        //
        if(is_int((int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT))){
            $origin_id = (int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT);
        }
        else {
            $origin_id = 0;
        }
        echo 'Origin: '.$valueContent['origin']['url'].' Id: '.$origin_id.'</br>';
        
        if(is_int((int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT))){
            $location_id = (int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT);
        }
        else {
            $location_id = 0;
        }
        echo 'Location: '.$valueContent['location']['url'].' Id= '.$location_id.'</br>';

        //echo 'Location: '.$valueContent['location'][[0][0]].'</br>';
        //echo 'Air date: '.$valueContent['air_date'].'</br>';
        //echo 'Character: '.$valueContent['characters'].'</br>';
        if(is_array($valueContent['episode'])){
            foreach($valueContent['episode'] as $keyContentAssociated=>$valueContentAssociated){
              $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
              echo '==========================>'.$keyContentAssociated.': '.$valueContentAssociated. ' Id: '.$associatedId.'</br>';  
            }
        }
        
        
        if(is_array($valueContent['characters'])){
            foreach($valueContent['characters'] as $keyContentAssociated=>$valueContentAssociated){
              $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
              echo '==========================>'.$keyContentAssociated.': '.$valueContentAssociated. ' Id: '.$associatedId.'</br>';  
            }
        }
        //*/
        //echo 'Characters: '.$valueContent['characters'].'</br>';
        //echo $keyContent.'</br>';
        
    }
}
else {
    //echo '</br>';
    //echo 'Id:' .$decodeJsonContent['id'].'</br>';
    //echo 'Name:' .$decodeJsonContent['name'].'</br>';
}
//echo '</br>'.$baseUrl;
exit;
//********************* INSERT CONTENT WITH ASSOCIATED IDs**********************************************/

$baseUrl = 'https://rickandmortyapi.com/api/character/'.$allCharacterIds;
$getContentFromJsonFile = file_get_contents($baseUrl);
$decodeJsonContent = json_decode($getContentFromJsonFile, true);


//foreach($data['results'] as $keyCharacter=>$valueCharacher){
foreach($data as $keyCharacter=>$valueCharacher){
  if(is_array($valueCharacher)){
      foreach($valueCharacher as $keyCharacterPositionTwo=>$valueCharacherPositionTwo){
          if(!(is_array($valueCharacherPositionTwo))){
             //echo $keyCharacterPositionTwo.': '.$valueCharacherPositionTwo.'</br>';
             echo $valueCharacherPositionTwo['name'].'</br>';
          }
        }
  }
}
exit;
//*/
foreach($data as $keyCharacter=>$valueCharacher) {
        if(is_array($valueCharacher)){
            //echo $keyCharacter. ': '.$valueCharacher.'</br>';
            echo $keyCharacter.'</br>';
            //
            foreach($valueCharacher as $keyCharacterPositionTwo=>$valueCharacherPositionTwo){
                //echo $valueCharacherPositionTwo.'</br>';
                if(is_array($valueCharacherPositionTwo)){
                    //echo $keys.'</br>';
                    foreach($valueCharacherPositionTwo as $keyCharacterPositionThree=>$valueCharacherPositionThree){
                        if(is_array($valueCharacherPositionThree)) {
                          echo '||=============>  '.$keyCharacterPositionThree.'</br>';
                          //exit;
                          foreach($valueCharacherPositionThree as $keyCharacterPositionFour=>$valueCharacherPositionFour) {
                             //echo $valueCharacher.'</br>';
                             echo '||========================>  ' .$keyCharacterPositionFour. ': '.$valueCharacherPositionFour.'</br>'; 
                          }  
                        
                            exit;
                        }
                        
                        else {
                        echo '||=============>  ' .$keyCharacterPositionThree. ': '.$valueCharacherPositionThree.'</br>';
                        }
                        //exit;
                    }
                }
                else {
                echo $keyCharacterPositionTwo. ': '.$valueCharacherPositionTwo.'</br>';
                }
            }
        }
        else {
            //echo $keyCharacter. ': '.$valueCharacher.'</br>';
        }
}
exit;





foreach($data as $keyCharacter=>$valueCharacher) {
  //  foreach($keys['results'] as $keys=>$value) {
        //echo $keyCharacter. ': '.$valueCharacher.'</br>';
        if(is_array($valueCharacher)){
            //echo $keyCharacter. ': '.$valueCharacher.'</br>';
            echo $keyCharacter.'</br>';
            foreach($valueCharacher as $keyCharacterPositionTwo=>$valueCharacherPositionTwo){
                //echo $valueCharacherPositionTwo.'</br>';
                if(is_array($valueCharacherPositionTwo)){
                    //echo $keys.'</br>';
                    foreach($valueCharacherPositionTwo as $keyCharacterPositionThree=>$valueCharacherPositionThree){
                        if(is_array($valueCharacherPositionThree)) {
                          echo '||=============>  '.$keyCharacterPositionThree.'</br>';
                          foreach($valueCharacherPositionThree as $keyCharacterPositionFour=>$valueCharacherPositionFour) {
                             //echo $valueCharacher.'</br>';
                             echo '||========================>  ' .$keyCharacterPositionFour. ': '.$valueCharacherPositionFour.'</br>'; 
                          }  
                        }
                        else {
                        echo '||=============>  ' .$keyCharacterPositionThree. ': '.$valueCharacherPositionThree.'</br>';
                        }
                    }
                }
                else {
                echo $keyCharacterPositionTwo. ': '.$valueCharacherPositionTwo.'</br>';
                }
            }
        }
        else {
            //echo $keyCharacter. ': '.$valueCharacher.'</br>';
        }
}


//echo $data['results']->name;
//exit;
/*
foreach ( $jo as $data) {
    echo $data;
}

*/
//foreach($jo as $idx=>$values) {
   //echo ''.$values.'</br>';
   //echo ''.$values->results['name'].'</br>';
//}

//echo 'The info of the character is '. $jo->name;

//echo 'The selected character is '. $jo['name'];
//

$parsed_character = json_decode($character, true);
?>

<html>
<head>
    <title>Rick and Morty Characters</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>

        .card {
            
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
           
            background-color: #03132b;
            color: white;
            font-family: 'Montserrat', sans-serif;
            padding: 1rem;
            
        }

        /* Add rounded corners to the top left and the top right corner of the image */
        img {
            border-radius: 5px 5px 0 0;
            width:100%;
            max-width: 500px;
        }
    </style>
</head>


<div class="card">
    <h1><b><?=$parsed_character['name'];?></b></h1>
    <img src="<?=$parsed_character['image']?>" alt="Avatar" style="">
    <div class="container">
    <p>Status: <?=$parsed_character['status'];?></p>
    <p>Gender: <?=$parsed_character['gender'];?></p>
    <p>Location: <?=$parsed_character['origin']['name'];?></p>
</div>
</html>
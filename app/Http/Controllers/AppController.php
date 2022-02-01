<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Character;
use App\Models\Episode;
use App\Models\Location;
use App\Models\Resident;
use App\Models\AppearEpisode;
use http\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function crapCharacter(Request $request)
    {
        
    $usedCharacter = Character::where('user_id', Auth::user()->id)->count();
    $usedEpisode = Episode::where('user_id', Auth::user()->id)->count();
    $usedLocation = Location::where('user_id', Auth::user()->id)->count();
    $usedAppearEpisode = AppearEpisode::where('user_id', Auth::user()->id)->count();
    $usedResident = Resident::where('user_id', Auth::user()->id)->count();
    
        //***************************************TRANSANCTION ON CHARACTER**********************************************
        //*******************GET INFO**********************************************
        $getUrl = 'https://rickandmortyapi.com/api/character/';
        $getContentFromJsonFile = file_get_contents($getUrl);
        $decodeJsonContent = json_decode($getContentFromJsonFile, true);
        $count = $decodeJsonContent['info']['count'];
        $allContentIds = '1,2'; // Defining a string of all content's ids
        foreach($decodeJsonContent['info'] as $keyContent=>$valueContent){
            if($keyContent=='count'){
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
        //END GET INFO*********************************/
        //*******************************************INSERTING CHARACTERS************************************
        $getUrl = 'https://rickandmortyapi.com/api/character/'.$allContentIds;
        $getContentFromJsonFile = file_get_contents($getUrl); // Get Json file content from URL
        $decodeJsonContent = json_decode($getContentFromJsonFile, true); // Decoding Json content into Array
        $origin_id = 0;// Initialisation of origin_id
        $location_id = 0;// Initialisation of location_id
        $associatedEpisode_id = 0;// Initialisation of location_id
        if($count > 1) {
            foreach($decodeJsonContent as $valueContent){
                // Inserting Characters into Table characters linked to the model Character
                if(is_int((int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT))){
                        $origin_id = (int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT); //Extracting the origin id from the url
                    }
                if(is_int((int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT))){
                        $location_id = (int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT); // Extracting the location id from the url
                    }
                
                // Inserting Characters into Table characters linked to the model Character
                if(!$usedCharacter){ // Preventing multi-insertion
                 Character::create([
                    'id' => $valueContent['id'],
                    'name' => $valueContent['name'],
                    'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                    'status' => $valueContent['status'],
                    'species' => $valueContent['species'],
                    'type' => $valueContent['type'],
                    'gender' => $valueContent['gender'],
                    'image' => $valueContent['image'],
                    'origin' => $origin_id,
                    'location' => $location_id,
                    'url' => $valueContent['url'],
                    'created' => $valueContent['created'],
                ]);
                }
                // Insert the Episodes that the character appeared in
                
                foreach($valueContent['episode'] as $keyContentAssociated=>$valueContentAssociated){
                    $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
                    if(is_int($associatedId)){
                        $associatedEpisode_id = $associatedId;
                    }
                    // Inserting now....
                    if(!$usedAppearEpisode){ // Preventing multi-insertion
                     AppearEpisode::create([
                                'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                                'character_id' => $valueContent['id'],
                                'episode_id' => $associatedEpisode_id,
                    ]);
                    }
                }
                
                
            }
        }
        elseif($count == 1) { // In case we have only one character in the COUNT (like https://rickandmortyapi.com/api/character/1) 
            if(is_int((int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT))){
                        $origin_id = (int)filter_var($valueContent['origin']['url'], FILTER_SANITIZE_NUMBER_INT); //Extracting the origin id from the url
                    }
                if(is_int((int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT))){
                        $location_id = (int)filter_var($valueContent['location']['url'], FILTER_SANITIZE_NUMBER_INT); // Extracting the location id from the url
                    }
           // Inserting a single character into Table characters linked to the model Character
           if(!$usedCharacter){ // Preventing multi-insertion
            Character::create([
                'id' => $valueContent['id'],
                'name' => $valueContent['name'],
                'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                'status' => $valueContent['status'],
                'species' => $valueContent['species'],
                'type' => $valueContent['type'],
                'gender' => $valueContent['gender'],
                'image' => $valueContent['image'],
                'origin' => $origin_id,
                'location' => $location_id,
                'url' => $valueContent['url'],
                'created' => $valueContent['created'],
            ]);
           }
        }
    //***************************************END TRANSANCTION ON CHARACTER**********************************************

        //return redirect()->route('dashboard')->with('success', 'Post '.$post->post_title. ' created successfully! ');
       
//***************************************TRANSANCTION ON EPISODES **********************************************
         //*******************GET INFO EPISODES **********************************************
        $getUrl = 'https://rickandmortyapi.com/api/episode/';
        $getContentFromJsonFile = file_get_contents($getUrl);
        $decodeJsonContent = json_decode($getContentFromJsonFile, true);
        $count = $decodeJsonContent['info']['count'];
        $allContentIds = '1,2'; // Defining a string of all content's ids
        foreach($decodeJsonContent['info'] as $keyContent=>$valueContent){
            if($keyContent=='count'){
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
        //END GET INFO EPISODES *********************************/
        //*******************************************INSERTING EPISODES ************************************
        $getUrl = 'https://rickandmortyapi.com/api/episode/'.$allContentIds;
        $getContentFromJsonFile = file_get_contents($getUrl); // Get Json file content from URL
        $decodeJsonContent = json_decode($getContentFromJsonFile, true); // Decoding Json content into Array
        if($count > 1) {
            foreach($decodeJsonContent as $valueContent){
                // Inserting episodes into Table episodes linked to the model Episode
                if(!$usedEpisode){ // Preventing multi-insertion
                 Episode::create([
                    'id' => $valueContent['id'],
                    'name' => $valueContent['name'],
                    'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                    'episode' => $valueContent['episode'],
                    'url' => $valueContent['url'],
                    'air_date' => $valueContent['air_date'],
                    'created' => $valueContent['created'],
                ]);
                }
            }
        }
        elseif($count == 1) { // In case we have only one episode in the COUNT (like https://rickandmortyapi.com/api/episode/1)
            if(!$usedEpisode){ // Preventing multi-insertion
            Episode::create([
                'id' => $valueContent['id'],
                'name' => $valueContent['name'],
                'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                'episode' => $valueContent['episode'],
                'url' => $valueContent['url'],
                'air_date' => $valueContent['air_date'],
                'created' => $valueContent['created'],
            ]);
            }
        }
//*******************************************END INSERTING EPISODES ************************************
//***************************************END TRANSANCTION ON EPISODES **********************************************

//***************************************TRANSANCTION ON LOCATION**********************************************
        //*******************GET INFO LOCATION **********************************************
        $getUrl = 'https://rickandmortyapi.com/api/location/';
        $getContentFromJsonFile = file_get_contents($getUrl);
        $decodeJsonContent = json_decode($getContentFromJsonFile, true);
        $count = $decodeJsonContent['info']['count'];
        $allContentIds = '1,2'; // Defining a string of all content's ids
        foreach($decodeJsonContent['info'] as $keyContent=>$valueContent){
            if($keyContent=='count'){
                //if($valueContent>1) {
                if($count>1) {
                    for ($id = 1; $id <= $valueContent; $id++) {
                        $allContentIds .= $id.",";
                    }
                }
                else {
                    $allContentIds = 1;
                }
            }
        }
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
                if($valueContent['id']>0){
                 if(!$usedLocation){ // Preventing multi-insertion
                    Location::create([
                            'id' => $valueContent['id'],
                            'name' => $valueContent['name'],
                            'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                            'type' => $valueContent['type'],
                            'dimension' => $valueContent['dimension'],
                            'url' => $valueContent['url'],
                            'created' => $valueContent['created'],
                        ]);
                    }
                }
                // Insert the  characters that located at the location
                
                foreach($valueContent['residents'] as $keyContentAssociated=>$valueContentAssociated){
                    $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
                    if(is_int($associatedId)){
                        $associatedCharacter_id = $associatedId;
                    }
                    // Inserting now....
                    if(!$usedResident){ // Preventing multi-insertion
                        Resident::create([
                            'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                            'location_id' => $valueContent['id'],
                            'character_id' => $associatedCharacter_id,
                        ]);
                    }
                }
                
                
            }
        }
        elseif($count == 1) { // In case we have only one location in the COUNT (like https://rickandmortyapi.com/api/location/1) 
             if(is_int((int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT))){
                        $character_id = (int)filter_var($valueContent['residents'][0], FILTER_SANITIZE_NUMBER_INT); //Extracting the location id from the url
                    }
           // Inserting a single location linked to the model Location
            if(!$usedLocation){ // Preventing multi-insertion
                    Location::create([
                        'id' => $valueContent['id'],
                        'name' => $valueContent['name'],
                        'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                        'type' => $valueContent['type'],
                        'dimension' => $valueContent['dimension'],
                        'url' => $valueContent['url'],
                        'created' => $valueContent['created'],
                    ]);
                }
            // Insert the  characters that located at the location
                
                foreach($valueContent['residents'] as $keyContentAssociated=>$valueContentAssociated){
                    $associatedId = (int)filter_var($valueContentAssociated, FILTER_SANITIZE_NUMBER_INT);
                    if(is_int($associatedId)){
                        $associatedCharacter_id = $associatedId;
                    }
                    // Inserting now....
                    if(!$usedResident){ // Preventing multi-insertion
                     Resident::create([
                            'user_id' => Auth::user()->id, // Here we've added user_id attribute to allow many users to use this Demo, so that everyone can use their own data.
                            'location_id' => $valueContent['id'],
                            'character_id' => $associatedCharacter_id,
                        ]);
                    }
                }
        }
//*******************************************INSERTING LOCATIONS************************************
    //***************************************END TRANSANCTION ON LOCATION**********************************************
        
        return redirect()->route('dashboard');
        
        
        
        
    }
   
   
public function showCharacter()
    {
        if(!(Character::where('user_id', Auth::user()->id)->count())){ // Check if the App have already crapped the characters from Rick and Morty API. If False then redirect to crapping.
            return redirect()->route('crapCharacter');
            exit;
        }//;
        //$characters = Character::latest()->orderBy('id','asc')->paginate(20);
        $characters = Character::orderBy('id','asc')->paginate(20);
        /*
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'article')
            ->get();
*/
        return view('view_admin.character_index', compact('characters'))
            ->with('i', (request()->input('page', 1) -1) *20);
    }
   
public function showEpisode()
    {
        if(!(Episode::where('user_id', Auth::user()->id)->count())){ // Check if the App have already crapped the episodes from Rick and Morty API. If False then redirect to crapping.
            return redirect()->route('crapCharacter');
            exit;
        }
        // Show episodes function
        $episodes = Episode::orderBy('id','asc')->paginate(20);
        return view('view_admin.episode', compact('episodes'))
            ->with('i', (request()->input('page', 1) -1) *20);
    }
public function showLocation()
    {
        if(!(Location::where('user_id', Auth::user()->id)->count())){ // Check if the App have already crapped the locations from Rick and Morty API. If False then redirect to crapping.
            return redirect()->route('crapCharacter');
            exit;
        }
        // Show locations function
        $locations = Location::orderBy('id','asc')->paginate(20);
        return view('view_admin.location', compact('locations'))
            ->with('i', (request()->input('page', 1) -1) *20);
    }    
     
}

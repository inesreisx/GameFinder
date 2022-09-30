<?php
header('Content-type: application/json');

require 'plataforms.php';

$myGames = array();

function processSearch($text){
    global $plataforms;
    foreach (array_keys($plataforms) as $key){
        if($plataforms[$key]['enabled'] == false) continue;
        if($plataforms[$key]['post'] != true){
            $json = getJSON($text, $key);
        }else{
            $json = getPostJSON($text, $key);
        }

        if($json != null){
            processJSON($json, $key);
        }
    }
}

function getPostJSON($searchText, $plataform){
    global $plataforms;
    $url = $plataforms[$plataform]['url'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array("content-type: application/json");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = array(
        "operationName" => "results",
        "query" => "query results(\$search: String, \$offset: Int, \$limit: Int) { results(search: \$search, offset: \$offset, limit: \$limit) { title link displayLink description id __typename}}",
        "variables" => array(
            "search" => "$searchText",
            "offset" => 0,
            "limit" => 100
        )
    );
    $data_string = json_encode($data);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $resp = curl_exec($curl);
    curl_close($curl);
    return json_decode($resp, TRUE);
}


function getJSON($searchText, $plataform){
    global $plataforms;
    $url = str_replace('{input}', $searchText, $plataforms[$plataform]['url']);
    $str = @file_get_contents($url);
    if($str === false){
        return null;
    }
    $json = json_decode($str, TRUE);
    return $json;
}

function processJSON($json, $plataform) {
    global $plataforms, $myGames;
    $gameList = $json;
    $plataformData = $plataforms[$plataform];
    foreach ($plataformData['gamesFolder'] as $folder){
        $gameList = $gameList[$folder];
    }
    foreach($gameList as $game){
        $name = $game[$plataformData['name']];
        $img = $game;
        $url = $game;
        foreach ($plataformData['img'] as $folder){
            $img =  (isset($img[$folder])) ? $img[$folder] : 'Error';
        }
        foreach ($plataformData['urlPart'] as $folder){
            $url = (isset($url[$folder])) ? $url[$folder] : 'Error';
        }
        if($plataformData['urlPartSplit'][0] == true){
            $urlPieces = explode($plataformData['urlPartSplit'][1], $url);
            if(count($urlPieces) >= $plataformData['urlPartSplit'][2]){
                $url = $urlPieces[$plataformData['urlPartSplit'][2]];
            }
        }
        $imgUrl = (is_string($img)) ? @str_replace('{img}', $img, $plataformData['imgUrl']) : 'Error';
        $gameUrl = (is_string($url)) ? @str_replace('{name}', $url, $plataformData['gameUrl']) : 'Error';
        $obj = new stdClass;
        $obj-> name = $name;
        $obj-> plataform = $plataform;
        $obj-> img = $imgUrl;
        $obj-> url = $gameUrl;
        array_push($myGames, $obj);
    }
}

if (isset($_GET['text'])){	
    $text = preg_replace('/[^A-Za-z0-9 ]/', '', $_GET['text']);
    $text = str_replace(' ', '%20', $text);
    processSearch($text);
}

echo json_encode($myGames);
?>

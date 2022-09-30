<?php
$plataformsStr = '{
    "crazygames": {
        "enabled": false,
        "id": 0,
        "post":false,
        "url": "https://www.crazygames.com/api/v3/en_US/search?q={input}&limit=100&includeTopGames=true",
        "iframeURL": "https://games.crazygames.com/en_US/{name}/index.html",
        "gamesFolder": ["result"],
        "name": "name",
        "img": ["cover"],
        "imgUrl": "https://images.crazygames.com/{img}",
        "urlPart":["slug"],
        "gameUrl":"./play.php?p=0&g={name}",
        "gameUrl2":"https://www.crazygames.com/game/{name}"
    },
    "agame": {
        "enabled": false,
        "id": 1,
        "url": "https://www.agame.com/search.json?term={input}",
        "gamesFolder": ["games"],
        "name": "title",
        "img": ["image"],
        "imgUrl": "{img}",
        "urlPart":["url"],
        "gameUrl":"{name}"
    },
    "poki": {
        "enabled": false,
        "id": 2,
        "url": "https://api.poki.com/search/query/3?q={input}",
        "gamesFolder": ["games"],
        "name": "title",
        "img": ["image","path"],
        "imgUrl": "{img}",
        "urlPart":["slug"],
        "gameUrl":"https://poki.com/en/g/{name}"
    },
    "kizi": {
        "enabled": false,
        "id": 3,
        "url": "https://kizi.com/search.json?term={input}",
        "gamesFolder": ["games"],
        "name": "title",
        "img": ["image"],
        "imgUrl": "{img}",
        "urlPart":["url"],
        "gameUrl":"{name}"
    },
    "ufreegames": {
        "enabled": false,
        "id": 4,
        "url": "https://searchv7.expertrec.com/v6/search/a8c4ef7c-cb1e-11ea-b6b3-0242ac130002/?user=0&q={input}&page=0&size=200&sort=score",
        "gamesFolder": ["results"],
        "name": "title",
        "img": ["image","0"],
        "imgUrl": "{img}",
        "urlPart":["url"],
        "gameUrl":"{name}"
    },
    "gamedistribution": {
        "enabled": true,
        "id": 5,
        "post":true,
        "url": "https://api.search.project.huz.byorbit.com/graphql",
        "iframeURL": "https://html5.gamedistribution.com/{name}/",
        "gamesFolder": ["data","results"],
        "name": "title",
        "img": ["cover"],
        "imgUrl": "https://images.crazygames.com/{img}",
        "urlPartSplit":[true,"/",3],
        "urlPart":["link"],
        "gameUrl":"./play.php?p=5&g={name}"
    }
}';

$idToNameStr = '{
    "0":"crazygames",
    "1":"agame",
    "2":"poki",
    "3":"kizi",
    "4":"ufreegames",
    "5":"gamedistribution"
}'; 

$plataformids = json_decode($idToNameStr, TRUE);
$plataforms = json_decode($plataformsStr, TRUE);
?>

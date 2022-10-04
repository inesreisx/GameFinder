<?php 
    require 'plataforms.php';
?>
<img src="ads.jpg" style="position:fixed; top: 1em; right: 1em; z-index: 999999999;" onclick="this.remove()">
<body style="background-color: black;">
<?php
if (isset($_GET['p'])){	
    if (isset($_GET['g'])){	
        if(isset($plataformids[$_GET['p']])){
            $plataformName = $plataformids[$_GET['p']];
            $iframeURL = str_replace('{name}', $_GET['g'], $plataforms[$plataformName]["iframeURL"]);
            echo "<iframe style='position:absolute; top:0; left:0;' width='100%' height='100%' src='$iframeURL'></iframe>";
        }
       
    }
}
?>
</body>

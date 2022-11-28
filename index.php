<style type="text/css">

    * { margin: 0; padding: 0; font-size: 14px; line-height: 17px; font-family: Georgia; }
    #text { border: 1px solid black; outline: 0; padding: 3px; width: 25%; }
    #button { border: 1px solid black; outline: 0; padding: 3px; width: 10%; border-left: 0; background-color: #ddd; color: black; cursor: pointer; min-width: 70px; }
    #button:hover { background-color: gray; }
    a { color: blue; text-decoration: underline; }
    a:hover { text-decoration: none; cursor: pointer; }
 
</style>

<title>Spath.Link</title>

<?php

$dsn = 'mysql:host=localhost;dbname=deneme';
$user = 'root';
$password = '123456';
 
try {
    $db = new PDO($dsn, $user, $password);

    ?>

<center style="margin-top: 10%; margin-bottom: 10px;">
    <b>EasyPath.Link</b><br><br>
    <form action="" method="get">
        <input type="text" name="url" id="text" value="<?php echo $_GET['url']; ?>"><input type="submit" value="Shorten" id="button">
    </form>
</center>



    <?php
    error_reporting(0);
    $redirect = $_GET['short'];
error_reporting(1);
if ($sorgu = $db->query("SELECT * FROM url WHERE short = '{$redirect}'")->fetch(PDO::FETCH_ASSOC)){
    
    header("Location: http://www.".$sorgu['url']);
    
    
} else {
    
}
    
    error_reporting(0);
    $url = $_GET['url'];
    error_reporting(1);
    
    if (empty($url)){
        
        echo "<br><center>Enter the address which you want to shorten.</center>";
        
    } else {
        
        $n = 7;
        function getRandomString($n)
        {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $randomString = '';

          for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
          }

          return $randomString;
        }

        $a = getRandomString($n);
        
        $array = array("http://", "https://", "http://www.", "https://www.", "www.");
        
        $url = str_replace($array, "", $url);
        
        
        $query = $db->prepare("INSERT INTO url SET url = ?, short = ?");
        $insert = $query->execute(array($url, $a));
        if ($insert){
            print "<center>";
        } else {
            
            echo 1;
        }
        
        $bizim = "localhost/deneme.php";
        echo "<br>Shorten address: <a href='?short=".$a."'>easypath.link/".$a."</a></center>";
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$sorgu = $db->prepare("SELECT COUNT(*) FROM url");
$sorgu->execute();
$say = $sorgu->fetchColumn();

?> <center>
        
        
        
        <br><br><div style="width: 400px; height: 100px; background-color: black; color: white;"> <img src="https://businessbeyondlimits.com/wp-content/uploads/2015/02/400x100.gif"> </div><br><br>
        
        
        
        
        <br>All rights reserved. &copy; <?php echo date("Y"); ?><br>We shortened <u style="color: gray;">[<?php echo $say; ?>]</u> web addresses until now.</center>
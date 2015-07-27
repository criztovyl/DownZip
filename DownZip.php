<?php //DLUnzip Version from 06.09.2014 ?>
<!--
    This script downloads a ZIP file and extracts it.
    Copyright (C) 2014 Christoph 'criztovyl' Schulz

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

-->
<!DOCTYPE html>
<html> 
<head>
<title>Download ZIP and extract</title>
<meta charset="UTF-8">
</head>
<body>
<?php
//error_reporting(E_ALL);
$zip_err = array("0"=>"No error ", "1"=>"Multi-disk zip archives not supported ", "2"=>"Renaming temporary file failed ", "3"=>"Closing zip archive failed ", "4"=>"Seek error ", "5"=>"Read error ", "6"=>"Write error ", "7"=>"CRC error ", "8"=>"Containing zip archive was closed ", "9"=>"No such file ", "10"=>"File already exists ", "11"=>"Can't open file ", "12"=>"Failure to create temporary file ", "13"=>"Zlib error ", "14"=>"Malloc failure ", "15"=>"Entry has been changed ", "16"=>"Compression method not supported ", "17"=>"Premature EOF ", "18"=>"Invalid argument ", "19"=>"Not a zip archive ", "20"=>"Internal error ", "21"=>"Zip archive inconsistent ", "22"=>"Can't remove file ", "23"=>"Entry has been deleted ");
if(isset($_POST['url'])):
?>
<div>
<h1>Status</h1>
<?php
    $url = $_POST['url'];
    $name = array_pop(explode("/" , $url));
    if(file_exists($name)):
        $name .= "." . time();
        ?><p>File exists, now downloading to <?php echo $name; ?></p><?php	
    endif;
    $ch = curl_init($url);
    $fp = fopen($name, "w");
    
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if(isset($_POST['dlunzip_cookies']))
        curl_setopt($ch, CURLOPT_COOKIE, $_POST['dlunzip_cookies']);

    curl_exec($ch);
    $curlerr = curl_error($ch);
    if($curlerr != ''):
        ?>
        <p>cURL has thrown an Error!<br>
        cURL says: <?php echo $curlerr; ?></p>
        <?php		
    endif;
    curl_close($ch);
    fclose($fp);
    
    $zip = new ZipArchive();
    
    $target = "./" . array_shift(explode(".", $name));
    
    if(is_file($target))
        $target .= "." . time();
    ?>
    <p>Extracting Archive to <?php echo $target; ?></p>
    <?php	
    if(!is_dir($target))
        mkdir($target);
    
    $x = $zip->open($name);
    if ($x === true):
        $zip->extractTo($target);
        $zip->close();
        ?>
        </p> Your archive was extracted successfully.</p>
        <?php
    else:
        ?>
        <p>There was ZIP Error <?php echo $x; ?>.<br></p>
        <?php
        if(array_key_exists($x, $zip_err)):
            ?>That means: <?php echo $zip_err[$x];
        else:
            ?>The Error is unknown.<?php
        endif;
    endif;
else:
?>
<form method="POST" style="height: 200px; width: 50%; margin: 10% auto; text-align: center;">
<label for="url">URL</label><br>
<input type="text" name="url" style="width: 100%"><br>
<label for="dlunzip_cookies">Cookies</label><br>
<input type="text" name="dlunzip_cookies" style="with: 33%"><br>
<input type="submit" value="Submit" style="margin-right: 30%; margin-top: 30px;">
</form>
<?php endif;?>
</body>
</html>

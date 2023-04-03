<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload a Picture</title>
        <link rel="shortcut icon" href="img/favicon.png">
        <style>
            legend{
                padding: 4px 10px;
                color:gold;
                background-color:black;
                text-align: left;
            }
            label{
                display: inline-block;
                text-align: center;
                width: 50px;
            }
            fieldset{
                background-color: grey;
                width: fit-content;
                height: fit-content;
                margin:  300px auto;
                text-align: center;
            }
            body{
        background-color: royalblue;
        color:gold;
        }
        </style>
    </head>
    <body>
        <fieldset>
            <legend>Add A Picture :</legend>
        <form enctype="multipart/form-data" method="post" action="upload_img.php">
            <input type="file" name="upload" id="upload" >
            <button type="submit" name ="submit" > Save</button>
        </form>
        </fieldset>
    </body>
</html>
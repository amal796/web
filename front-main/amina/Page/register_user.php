<?php
    include_once 'C:\xampp\htdocs\amina\Controller\UserC.php';
    include_once 'C:\xampp\htdocs\amina\Controller\EtudiantC.php';
    include_once 'C:\xampp\htdocs\amina\Controller\FormateurC.php';

    $userC = new UserC();
    $formaC = new FormateurC();
    $etudC = new EtudiantC();
    $error= "Hello";
    if(isset($_POST["cin"]) && isset($_POST["name"]) && isset($_POST["lname"]) && isset($_POST["date"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["sexe"]) && isset($_POST["username"]) && isset($_POST["passw"]) && isset($_POST["choix"]))
    {
        if(!empty($_POST["cin"]) && !empty($_POST["name"]) && !empty($_POST["lname"]) && !empty($_POST["date"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["sexe"]) && !empty($_POST["username"]) && !empty($_POST["passw"]) && !empty($_POST["choix"]))
        {
            $user = new User($_POST['cin'],$_POST['name'] ,$_POST['lname'] ,$_POST['email'],$_POST['phone'],$_POST['sexe'] ,$_POST['date'] ,$_POST['username'] ,$_POST['passw'] ,$_POST['choix']);
            if(($_POST['checkbox2'] == "t") && !empty($_POST['checkbox3']))
            {
                $forma = new Formateur($_POST['cin'],'0',$_POST['checkbox3'],'0');
                $formaC->ajouter_formateur($forma);
            }
            else if($_POST['checkbox2'] == "s")
            {
                $etud = new Etudiant($_POST['cin'],'0','0');
                $etudC->ajouter_etudiant($etud);
            }
            $userC->ajouter_user($user);
            header('Location:page-login.html');
            $error= "create error";
        }
        else 
        {
        $error= "Missing information";
        }
    }
    $error= "isset error";

?>
    <html>
        <head>
    
        </head>
        <body>
        <div id="error">
        <?php echo $error; ?>
         </div>
        </body>
    </html>
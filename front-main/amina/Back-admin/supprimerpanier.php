<?PHP
include "../../Core/paniercore.php";
$paniercore=new paniercore();
if (isset($_POST["id_Panier"])){
	$paniercore->supprimerpanier($_POST["id_Panier"]);
	header('Location: index.php');
}

?>
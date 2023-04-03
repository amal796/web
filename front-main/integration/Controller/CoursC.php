<?php
	include_once 'C:\xampp\htdocs\mycruds\config.php';
	include_once 'C:\xampp\htdocs\mycruds\Model\Cours.php';
class CoursC {

		function afficherCours()
		{
			$sql="SELECT * FROM cours";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerCours($idCours)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                DELETE FROM cours WHERE idCours =:idCours
                ');
                $querry->execute([
                    'idCours'=>$idCours
                ]);
                
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
		function ajouterCours($cours)
		{
			$sql="INSERT INTO cours (nomCours,idFormation ,nbrPage, dateCreation, dateModification) 
			VALUES ( :nomCours,:idFormation ,:nbrPage, :dateCreation, :dateModification)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomCours' => $cours->getNomCours(),
					'idFormation' => $cours->get_idformation(),
					'nbrPage' => $cours->getNbrPage(),
					'dateCreation' => $cours->getDateCreation(),
					'dateModification' => $cours->getDateModification()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererCours($idCours)
		{
			$sql="SELECT * from cours where idCours=$idCours";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();
				
				$count=$query->rowCount();
		    	if ($count > 0) {
            	$row = $query->fetch();
            	return $row;
            	}
           		else return FALSE;
				}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierCours($cours, $idCours){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE cours SET 
		                nomCours= :nomCours,
						idFormation= :idFormation,
		                nbrPage= :nbrPage,
						dateCreation= :dateCreation,
		                dateModification= :dateModification
					WHERE idCours= :idCours'
				);
				$query->execute([
                    'nomCours'=> $cours->getNomCours(),
					'idFormation'=> $cours->get_idformation(),
                    'nbrPage'=> $cours->getNbrPage(),
					'dateCreation'=> $cours->getDateCreation(),
                    'dateModification'=> $cours->getDateModification(),
                    'idCours'=> $idCours
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
// Pagination

// Pagination

function AffichercoursPaginer($page, $perPage)
{
	$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
	$sql = "SELECT * FROM cours LIMIT {$start},{$perPage}";
	$db = config::getConnexion();
	try 
	{
		$liste = $db->prepare($sql);
		$liste->execute();
		$liste = $liste->fetchAll(PDO::FETCH_ASSOC);
		return $liste;
	} 
	catch (Exception $e) 
	{
		die('Erreur: ' . $e->getMessage());
	}
}



function calcTotalRows($perPage)
{
	$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM cours";
	$db = config::getConnexion();
	try {

		$liste = $db->query($sql);
		$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
		$pages = ceil($total / $perPage);
		return $pages;
	} catch (Exception $e) {
		die('Erreur: ' . $e->getMessage());
	}
}


?>
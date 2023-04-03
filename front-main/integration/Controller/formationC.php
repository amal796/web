<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\formation.php';
    class FormationC{
        public function afficher_formation()
        {
            $sql="SELECT * FROM formations";
			$db = config::getConnexion();
			try{
				$liste_f = $db->query($sql);
				return $liste_f;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_formation($formation)
        {
            $sql="insert into formations (nom,categorie,nb_cour,temp,prix,taux,date_creation) values (:nom,:categorie,:nb_cour,:temp,:prix,:taux,:date_creation)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $nom=$formation->get_nom();
                    $categorie=$formation->get_categorie();
                    $nb_cour=$formation->get_nb_cour();
                    $temp=$formation->get_temp();
                    $prix=$formation->get_prix();
                    $taux=$formation->get_taux();
                    $date_creation=$formation->get_date_creation();
                    $req->bindValue(':nom',$nom);
                    $req->bindValue(':categorie',$categorie);
                    $req->bindValue(':nb_cour',$nb_cour);
                    $req->bindValue(':temp',$temp);
                    $req->bindValue(':prix',$prix);
                    $req->bindValue(':taux',$taux);
                    $req->bindValue(':date_creation',$date_creation);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_formation($id_formation)
        {
            $sql="DELETE FROM formations where id_formation= :id_formation";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_formation',$id_formation);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_formation($id_formation,$formation)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE formations SET 
						nom= :nom,
						categorie= :categorie,
                        nb_cour= :nb_cour,
                        temp= :temp,
                        prix= :prix,
                        taux= :taux
					    WHERE id_formation= :id_formation'
				);
				$query->execute([
					'nom' => $formation->get_nom(),
					'categorie' => $formation->get_categorie(),
                    'nb_cour' => $formation->get_nb_cour(),
                    'temp' => $formation->get_temp(),
                    'prix' => $formation->get_prix(),
                    'taux' => $formation->get_taux(),
					'id_formation' => $id_formation
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }

        public function chercher_formation($id_formation)
        {
            $sql="SELECT * FROM formations where id_formation = :id_formation";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_formation',$id_formation);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }

        public function select_lastest_formation()
        {
            $sql="SELECT * FROM (SELECT * FROM formations ORDER BY id_formation DESC LIMIT 3 ) as r ORDER BY id_formation";
            $db = config::getConnexion();
            try{
                $liste_a = $db->query($sql);
                $row=$liste_a->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMeesage());
            }
        }
        //**** PARTIE IMAGE FORMATION :

        public function upload_img($id_formation,$imgName,$imgPath,$img_type)
        {
            $sql="insert into formation_image (id_imgf,name_img,type,img) values (:id_imgf,:name_img,:type,:img)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $req->bindValue(':id_imgf',$id_formation);
                    $req->bindValue(':name_img',$imgName);
                    $req->bindValue(':type',$img_type);
                    $req->bindValue(':img',$imgPath);

                    $req->execute();
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        
        public function display_img($imgID)
        {
            $sql="SELECT * FROM formation_image where id_imgf = :id_imgf";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_imgf',$imgID);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }

        public function supprimer_img($imgID)
        {
            $sql="DELETE FROM formation_image where id_imgf=:id_imgf";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_imgf',$imgID);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }
    }
?>
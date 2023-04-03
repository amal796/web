<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\User.php';
    class UserC{

        public function afficher_user()
        {
            $sql="SELECT * FROM users";
			$db = config::getConnexion();
			try{
				$liste_u = $db->query($sql);
				return $liste_u;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
        }

        public function ajouter_user($user)
        {
            $sql="insert into users (
            cin,
            nom,
            prenom,
            email,
            telephone,
            sexe,
            date_n,
            username,
            pass_word,
            choix) 
            values (
            :cin,
            :nom,
            :prenom,
            :email,
            :telephone,
            :sexe,
            :date_n,
            :username,
            :pass_word,
            :choix)";
            $db = config::getConnexion();
            try{
            $req=$db->prepare($sql);
    
            $cin=$user->get_cin();
            $nom=$user->get_nom();
            $prenom=$user->get_prenom();
            $email=$user->get_email();
            $telephone=$user->get_telephone();
            $sexe=$user->get_sexe();
            $date_n=$user->get_date_n();
            $username=$user->get_username();
            $pass_word=$user->get_password();
            $choix=$user->get_choix();
            $req->bindValue(':cin',$cin);
            $req->bindValue(':nom',$nom);
            $req->bindValue(':prenom',$prenom);
            $req->bindValue(':email',$email);
            $req->bindValue(':telephone',$telephone);
            $req->bindValue(':sexe',$sexe);
            $req->bindValue(':date_n',$date_n);
            $req->bindValue(':username',$username);
            $req->bindValue(':pass_word',$pass_word);
            $req->bindValue(':choix',$choix);
    
                $req->execute();
               
            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }
            
        }

        public function supprimer_user($id_user)
        {
            $sql="DELETE FROM users where id_user=:id_user";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_user',$id_user);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_user($id_user,$user)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE users SET 
                        cin= :cin, 
						nom= :nom, 
						prenom= :prenom, 
						email= :email, 
						telephone= :telephone, 
                        sexe= :sexe, 
                        date_n= :date_n, 
                        username= :username, 
                        pass_word= :pass_word
					    WHERE id_user= :id_user'
				);
				$query->execute([
					'cin' => $user->get_cin(),
					'nom' => $user->get_nom(),
					'prenom' => $user->get_prenom(),
					'email' => $user->get_email(),
					'telephone' => $user->get_telephone(),
                    'sexe' => $user->get_sexe(),
                    'date_n' => $user->get_date_n(),
                    'username' => $user->get_username(),
                    'pass_word' => $user->get_password(),
					'id_user' => $id_user
				]);
				
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }


        public function chercher_user($id_user)
        {
            $sql="SELECT * FROM users where id_user = :id_user";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_user',$id_user);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }

        public function select_first_teacher()
        {
            $sql="SELECT * FROM users WHERE choix = 't' LIMIT 4";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMeesage());
            }
        }
        public function select_all_teacher()
        {
            $sql="SELECT * FROM users WHERE choix = 't' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMeesage());
            }
        }

        // PARTIE UPLOAD IMAGE OF USER : 
        public function upload_img($id_user,$imgName,$imgPath,$img_type)
        {
            $sql="insert into images (id_imgu,name_img,type,img) values (:id_imgu,:name_img,:type,:img)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $req->bindValue(':id_imgu',$id_user);
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
            $sql="SELECT * FROM images where id_imgu = :id_imgu";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_imgu',$imgID);
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
            $sql="DELETE FROM images where id_imgu=:id_imgu";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_imgu',$imgID);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }
    }
?>
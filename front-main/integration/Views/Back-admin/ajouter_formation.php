<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
$formation = new FormationC();
$liste_f = $formation->afficher_formation();
$categorie = new categorieC();
$liste_c = $categorie->afficher_categorie();

    if(isset($_POST['submitAjoute']))
    {
        
        if(isset($_POST['name']) && isset($_POST['categorie']) && isset($_POST['number']) && isset($_POST['time']) && isset($_POST['price']) && isset($_POST['rate']))
        {
            
            if(!empty($_POST['name']) && !empty($_POST['categorie']) && !empty($_POST['number']) && !empty($_POST['time']) && !empty($_POST['price']) && !empty($_POST['rate']))
            {
                $date_creation = date("Y-m-d");
                $formation_ajouter = new Formation($_POST['name'],$_POST['categorie'],$_POST['number'],$_POST['time'],$_POST['price'],$_POST['rate'],$date_creation);
                $formation->ajouter_formation($formation_ajouter);
                
                header('Location: Home.php');
            }
            else echo "MISSING INFO";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADD-Formation</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    <div class="" id="home">
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="Home.php">
            <h1 class="tm-site-title mb-0">Admin- Dashboard</h1>
          </a>
          <button
            class="navbar-toggler ml-auto mr-0"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars tm-nav-icon"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
              <li class="nav-item">
                <a class="nav-link" href="Home.php">
                  <i class="fas fa-tachometer-alt"></i> Dashboard
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="far fa-file-alt"></i>
                  <span> Reports <i class="fas fa-angle-down"></i> </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Daily Report</a>
                  <a class="dropdown-item" href="#">Weekly Report</a>
                  <a class="dropdown-item" href="#">Yearly Report</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <i class="fas fa-shopping-cart"></i> Buyers
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="Accounts.php">
                  <i class="far fa-user"></i> Accounts
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-cog"></i>
                  <span> Settings <i class="fas fa-angle-down"></i> </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Billing</a>
                  <a class="dropdown-item" href="#">Customize</a>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav">
            <li class="nav-item">
                            <a class="nav-link d-block" href="logout_admin.php">
                            <button class="btn btn-primary btn-block text-uppercase"><?=$_SESSION['name_admin']?> | <b>Logout</b></button>
                            </a>
            </li>
            </ul>
          </div>
        </div>
      </nav>
     
        <!-- row -->
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Formation Settings</h2>
              <form action="" class="tm-signup-form row" method="POST">
                <div class="form-group col-lg-6">
                  <label for="name">Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control validate"
                    required
                    maxlength="30"
                    maxlength="2"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Categorie">Choose a Categorie:</label>
                    <select name="categorie" id="categorie" required>
                        <option value="">--Please choose an option--</option>
                        <?php foreach($liste_c as $row2){ ?>
                        <option value="<?= $row2['nom_categorie'] ?>"><?= $row2['nom_categorie'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="Number">Number of Courses</label>
                  <input
                    id="number"
                    name="number"
                    type="number"
                    class="form-control validate"
                    required
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Time">Time(Hours)</label>
                  <input
                    id="time"
                    name="time"
                    type="number"
                    step="0.01"
                    class="form-control validate"
                    required
                    min="0"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Price">Price</label>
                  <input
                    id="price"
                    name="price"
                    type="number"
                    step="0.01"
                    class="form-control validate"
                    required
                    min="0"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Rate">Rate</label>
                  <input
                    id="rate"
                    name="rate"
                    type="number"
                    step="0.01"
                    class="form-control validate"
                    required
                    min="0"
                    max="5"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block text-uppercase" name="submitAjoute">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- row Formation-->
        <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Formations List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Num Courses</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Rate</th>
                                </tr>
                            </thead>
                            <tbody>
            <!--PHP-->
            <?php
                foreach($liste_f as $row)
                { ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row['id_formation'] ?></b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div><?=$row['nom'] ?>
                                    </td>
                                    <td><b><?=$row['categorie'] ?></b></td>
                                    <td><b><?=$row['nb_cour'] ?></b></td>
                                    <td><b><?=$row['temp'] ?> .Hours</b></td>
                                    <td><?=$row['prix'] ?> .Dt</td>
                                    <td><?=$row['taux'] ?> .Stars</td>
                                </tr>
            <?PHP
                }
                ?>
            <!--PHP-->
                                
                            </tbody>
                        </table>
                    </div>
                </div>
      </div>
      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
        
        </div>
      </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
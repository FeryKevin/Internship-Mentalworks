<?php

require '../connexion.php';

/* déclation des variables */
$name = "";
$nameError = $nameExiste = "";
$isSuccess = false;

/* requete select pour préremplir les inputs */
if(!empty($_GET['id'])) 
{
    $id = verifyInput($_GET['id']);
    $db = connect();
    $statement = $db->prepare("SELECT * FROM host WHERE id =?;");
    $statement->execute(array($id));
    $row = $statement->fetch();
    $name = $row['name'];
    $db = disconnect();
}

/* controle des champs + requetes */
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = verifyInput($_POST['name']);
    $isSuccess = true;

    /* controle du champs */
    if(empty($name))
    {
        $nameError = "Veuillez saisir votre nom.";
        $isSuccess = false;
    }
    
    /* update et select dans la base de donnée */
    if($isSuccess) 
    {
        $db = connect();
        $req = $db->prepare("SELECT COUNT(*) FROM host WHERE name = :name");
        $req->execute(array('name' => $name));
        $results = $req->fetch();
        
        if($results[0] == 0)
        {
            $statement = $db->prepare("UPDATE host set name =? WHERE id = ?;");
            $statement->execute(array($name, $id));
            $db = disconnect();
            header("Location: ../view_host.php");
        }
        else
        {
            $nameExiste = "Erreur : le nom de l'hébergeur est déjà utilisé.";
            $isSuccess = false;
        }
        
        $db = disconnect();
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modification d'un hebergeur</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    
        <!--header : navbar
        <?php 
        
        require ('../header_dossiers.php');
        
        ?>
        
        <!-- section home-->
        
        <section id="home">
            <div class="container">
                <div class="row">
        
                    <!-- titre -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Modification de l'hébergeur</p>
                    </div>
        
                    <!-- formulaire hebergeur -->
                    <form class="form" role="form" action="<?php echo 'update_hebergeur.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">                 
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="debutForm">
                                
                                <!-- input nom -->
                                <label for="name" class="labelForm2">Nom* :</label><br>
                                <input type="text" id="name" name="name" class="formInput" value="<?php echo $name; ?>"><br>
                                <p style="color:red; font-style:italic;"><?php echo $nameError;?></p>
                                <p style="color:red; font-style:italic;"><?php echo $nameExiste;?></p>
                                
                                <!-- input code interne -->
                                <label class="labelForm2">Code interne</label><br>
                                <button disabled="disabled">Champs généré automatiquement</button>
                            </div>
                        </div>
                        
                        <!-- formulaire contact EN COURS -->

                        <!--<form id="form" method="post" action="< ?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">-->
                            <div class="col-lg-5 col-lg-offset-1 col-md-12 col-sm-12">
                                <p class="titre2">Contacts</p>
                                <div class="overlay">

                                    <!-- bouton reset -->
                                    <button type="reset" class="btnTrash"><span class="glyphicon glyphicon-trash"></span></button><br>

                                    <!-- input nom1 -->
                                    <label for="nom1" class="labelForm1">Nom contact* :</label>
                                    <input type="text" id="nom1" name="nom1" class="formInput2">
                                    <p style="color:red; font-style:italic;"></p>

                                    <!-- input email -->
                                    <label for="email" class="labelForm1">Email :</label>
                                    <input type="text" id="email" name="email" class="formInput3">
                                    <p style="color:red; font-style:italic;"></p>

                                    <!-- input telephone -->
                                    <label for="nom" class="labelForm1">Téléphone :</label>
                                    <input type="text" id="telephone" name="telephone" class="formInput4">
                                    <p style="color:red; font-style:italic;"></p>
                                </div>

                                <!-- bouton ajouter un contact -->                                        

                                <button type="submit" class="addContact" disabled="disabled"><span class="glyphicon glyphicon-plus-sign" id="glyph"></span> Ajouter un contact</button><br>
                            </div>
                        
                            <!-- bouton sauvegarder -->
                            <button type="submit" id="save">Sauvegarder</button>
                        </form>
                        <!--</form>-->
                    
                        <!-- bouton supprimer + modal EN COURS -->

                        <?php
                        /* requete delete */
                        if(isset($_POST["d"]))
                        {   
                            $db = connect();

                            $sql = ("DELETE FROM customer WHERE;");
                            $statement= $db->prepare($sql);
                            $statement->execute();
                            disconnect();
                            header("Location: view_client.php"); 
                        }
                        ?>
                    
                        <!-- modal -->
                        <form class="form" action="update_hebergeur.php" role="form" method="post" enctype="multipart/form-data">
                            <button type="button" id="supprimer" href='#' data-toggle='modal' data-target='#modal'>Supprimer</button>
                            <div class='modal fade' id='modal'> 
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>x</button>
                                            <h4 class='modal-title'>Supprimer un hébergeur</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Vous êtes sur le point de supprimer un hébergeur, voulez-vous continuer ?</p>
                                            <input type="hidden" name="id" value="<?php echo $name;?>"/>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='submit' class='btn btn-danger' data-dismiss='modal' class="d" id="d">Supprimer</button>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>    

                    <!-- bouton retour -->
                    <button type="button" id="retour"><a href="../view_host.php">Retour</a></button>
                </div>
            </div>
        </section>
    </body>
</html>
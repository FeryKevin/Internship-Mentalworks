<?php

require '../connexion.php';

/* déclaration des variables */
$nom = $nomErreur = $nomExiste = "";

/* recuperation de l'id */
$db = connect();
$query = $db->query('SELECT MAX(id) AS maxid FROM customer');
$max_id = $query->fetch(PDO::FETCH_ASSOC);

/* incrementation de l'id */
$id = $max_id['maxid'];
$id++;

/* preparation de la variable code */
$code = 'CLIENT_' . $id;
$db = disconnect();

/* contrôle des champs du formulaire */

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nom = verifyInput($_POST["nom"]);
    $isSuccess = true;

    if(empty($nom))
    {
        $nomErreur = "Veuillez saisir le nom du client.";
        $isSuccess = false;
    }
    
    /* insert et select dans la base de donnée */

    if($isSuccess) 
    {
        $db = connect();
        
        $req = $db->prepare("SELECT COUNT(*) FROM customer WHERE name = :name");
        $req->execute(array('name' => $nom));
        $results = $req->fetch();
        
        if($results[0] == 0)
        {
            $statement = $db->prepare("INSERT INTO customer (code, name) values(?, ?)");
            $statement->execute(array($code, $nom));
            $db = disconnect();
            header("Location: ../view_client.php");
        }
        else
        {
            $nomExiste = "Erreur : le nom du client est déjà utilisé.";
            $isSuccess = false;
        }
        
        $db = disconnect();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nouveau client</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    
        <!--header : navbar -->
        
        <?php 
        
        require ('../header_dossiers.php');
        
        ?>
        
        <!-- section home-->
        
        <section id="home">
            <div class="container">
                <div class="row">
        
                    <!-- titre -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Nouveau client</p>
                    </div>
        
                    <!-- formulaire client -->
                    <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">                 
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="debutForm">
                                
                                <!-- input nom -->
                                <label for="nom" class="labelForm1">Nom* :</label><br>
                                <input type="text" id="nom" name="nom" class="formInput" value="<?php echo $nom; ?>">
                                <p style="color:red; font-style:italic;"><?php echo $nomErreur;?></p>
                                <p style="color:red; font-style:italic;"><?php echo $nomExiste;?></p>

                                <!-- input code interne -->
                                <label class="labelForm2">Code interne</label><br>
                                <button disabled="disabled">Champs généré automatiquement</button>
                            </div>
                        </div> 
                            
                        <!-- formulaire contact EN COURS -->

                        <!-- <form id="form" method="post" action="< ?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">-->
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
                        <!--</form>-->
                      
                        <!-- bouton sauvegarder -->
                        
                        <button type="submit" id="save">Sauvegarder</button> 
                    </form>         
                </div>
            </div>
        </section>
    </body>
</html>
<?php 
    
    require '../connexion.php';

    /* déclaration des variables */
    $nom = $nomErreur = $client = $hebergeur = $lastpass_folder = $link_mock_ups = $managed_server = $notes = $host_id = $customer_id = "";

    /* recuperation de l'id */
    $db = connect();
    $query = $db->query('SELECT MAX(id) AS maxid FROM project');
    $max_id = $query->fetch(PDO::FETCH_ASSOC);

    /* incrementation de l'id */
    $id = $max_id['maxid'];
    $id++;

    /* preparation de la variable code */
    $code = 'PROJET_' . $id;
    $db = disconnect();

    /* contrôle des champs du formulaire */

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nom = verifyInput($_POST["nom"]);
        $client = verifyInput($_POST["client"]);
        $hebergeur = verifyInput($_POST["hebergeur"]);
        $lastpass_folder = verifyInput($_POST["lastpass_folder"]);
        $link_mock_ups = verifyInput($_POST["link_mock_ups"]);
        $managed_server = verifyInput($_POST["managed_server"]);
        $notes = verifyInput($_POST["notes"]);
        $isSuccess = true;

        if(empty($nom))
        {
            $nomErreur = "Veuillez saisir le nom du projet.";
            $isSuccess = false;
        }
        
        /* insert et select dans la base de donnée */

        if($isSuccess) 
        {
            $db = connect();

            $statement = $db->prepare("INSERT INTO project (name, code, lastpass_folder, link_mock_ups, managed_server, notes, host_id, customer_id) values(?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($nom, $code, $lastpass_folder, $link_mock_ups, $managed_server, $notes, $client, $hebergeur));
            $db = disconnect();
            header("Location: ../view_projet.php");
            
            $db = disconnect();
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nouveau projet</title>
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
    
        <!-- section projets -->
        <section id="Ajt_projet">
            <div class="container">
                <div class="row">
        
                    <!-- titre -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Nouveau projet</p><br>
                    </div>

                    <!-- titre2 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre3">Informations générales</p>
                    </div>

                    <!-- formulaire projet -->
                    <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form"> 
                        <div class="row">                
                            <div class="col-lg-6 col-md-12 col-sm-12">

                                <!-- nom + code -->
                                <div class="debutForm">
                                    <div class="col-lg-6 col-md-12 col-sm-12">

                                        <!-- nom -->
                                        <label for="nom" class="labelForm1">Nom* :</label><br>
                                        <input type="text" id="nom" name="nom" class="formInput2" value="<?php echo $nom; ?>">
                                        <p style="color:red; font-style:italic;"><?php echo $nomErreur;?></p><br>

                                        <!-- code interne -->
                                        <label class="labelForm2">Code interne* :</label><br>
                                        <button disabled="disabled">Champs généré automatiquement</button><br>
                                    </div>
                                </div>

                                <!-- client + hébergeur -->
                                <div class="col-lg-6 col-md-12 col-sm-12">

                                    <!-- clients -->
                                    <label for="client" class="labelForm1">Client* :</label><br>
                                    <select type="text" class="select" name="client" value="<?php echo $client; ?>">
                                    <?php
                                    $db = connect();
                                    foreach ($db->query('SELECT * FROM customer') as $row) 
                                    {
                                        echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';
                                    }
                                    $db = disconnect();
                                    ?>
                                    </select><br><br>

                                    <!-- hébergeurs -->
                                    <label for="hebergeur" class="labelForm1">Hébergeur* :</label><br>
                                    <select type="text" class="select" name="hebergeur" id="hebergeur" value="<?php echo $hebergeur; ?>">
                                    <?php
                                    $db = connect();
                                    foreach ($db->query('SELECT * FROM host') as $row) 
                                    {
                                        echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';
                                    }
                                    $db = disconnect();
                                    ?>
                                    </select><br><br>
                
                                </div>

                                <!-- dossier lastpass + serveur infrogé + lien maquette -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <!-- dossier lastpass -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <label for="lastpass_folder" class="labelForm1">Dossier Lastpass :</label><br>
                                            <input type="text" class="formInput2" name="lastpass_folder" id="lastpass_folder" value="<?php echo $lastpass_folder; ?>">
                                        </div>

                                        <!-- serveur infrogé -->
                                        <div class="col-lg-6 col-md-12 col-sm-12"><br><br>
                                            <input type="checkbox" name="managed_server" id="managed_server" value="<?php echo $managed_server; ?>"><a> Serveur infogéré</a>
                                        </div>

                                        <!-- lien maquette -->
                                        <div class="col-lg-12 col-md-12 col-sm-12"><br>
                                            <label for="link_mock_ups" class="labelForm1">Lien Maquette :</label><br>
                                            <input type="text" class="formInput5" name="link_mock_ups" id="link_mock_ups" value="<?php echo $link_mock_ups; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- notes -->
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="note" class="labelForm1">Note :</label><br>
                                    <textarea type="text" name="note" id="note" class="box" value="<?php echo $notes; ?>"></textarea>
                                </div>
                            </div>

                            <!-- boutons -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" id="save">Sauvegarder</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
             </div>

        </section>
    </body>
</html>
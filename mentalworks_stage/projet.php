<?php 
    require ('connexion.php');

    $error = "";

    if(!empty($_POST)){ //si POST n'est pas vide l'utilisateur a envoyé un formulaire
        $nom = checkInput($_POST['nom']);
        $code = checkInput($_POST['code']);
        $lastpass = checkInput($_POST['lastpass']);
        $maquette = checkInput($_POST['maquette']);
        $client = checkInput($_POST['nom_client']);
        $hebergeur = checkInput($_POST['nom_hebergeur']);
        $serveur = checkInput($_POST['serveur_info']);
        $note = checkInput($_POST['note']);

        $lien = checkInput($_POST['lien_php']);
        $port = checkInput($_POST['port_ssh']);
        $lien = checkInput($_POST['lien']);
        $nomUtilisateur = checkInput($_POST['nom_utilisateur']);
        $restriIP = checkInput($_POST['restri_IP']);

        $IP = checkInput($_POST['IP']);
        $lien = checkInput($_POST['lien_php']);
        $port = checkInput($_POST['port_ssh']);
        $lien2 = checkInput($_POST['lien']);
        $nomUtilisateur = checkInput($_POST['nom_utilisateur']);
        $RestriIP = checkInput($_POST['restri_IP']);

        $isSuccess = true;

        if ((empty($nom)) || (empty($code)) || (empty($lastpass)) || (empty($maquette)) || (empty($client))|| (empty($hebergeur)) || (empty($serveur)) || (empty($note)) 
        || (empty($lien)) || (empty($port))|| (empty($lien)) || (empty($nomUtilisateur)) || (empty($restri_IP)) ){ //si un des champs est vide une erreur est retourné
            $erreur = "Auncun champ ne peut être vide";
            $isSuccess = false;
        }
    }
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>POC / MentalWorks</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <!--MetaName-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="css/projet.css">
</head>
<body>
    <!--Navbar-->
    
    
    <section id="Ajt_projet">
        <h1>Nouveau projet</h1>
        
        <!--Info générales-->
            <h2>Informations générales</h2>
                <form class="form" action="index.php" method="post" name="login">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="login-box">
                                <div class="textbox1" >
                                    <a>Nom* :</a><br>
                                    <input type="text" class="box0" name="nom">
                                </div>
                                <div class="textbox2" >
                                    <a>Code interne* :</a><br>
                                    <input type="text" class="box0" name="code" placeholder="Champ généré automatiquement" disabled="disabled" >
                                </div>
                                <div class="textbox3" >
                                    <a>Dossier Lastpass :</a><br>
                                    <input type="text" class="box0" name="lastpass">
                                </div>
                                <div class="textbox2" >
                                    <a>Lien Maquette</a><br>
                                    <input type="text" class="box0" name="maquette">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="login-box">
                                <div class="textbox4" >
                                    <a>Client* :</a><br>
                                    <select type="text" class="box0" name="nom_client" value="Sélectionner un client dans la liste">
                                    
                                    </select>
                                </div>
                                <div class="textbox5" >
                                    <a>Hébergeur* :</a><br>
                                    <select type="text" class="box0" name="nom_hebergeur" value="Sélectionner un hébergeur dans la liste"></select>
                                </div>
                                <div class="textbox5" >
                                    <input type="checkbox" class="box0" name="serveur_nfo"><a> Serveur infogéré</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="login-box">
                                <div class="textbox4" >
                                    <a class="note">Note :</a><br>
                                    <textarea type="text" class="box0" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

        <!--Info hébergement-->
            <h2>Informations hébergement</h2>
            <h3>Environnement de production</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="login-box">
                        <div class="textbox1" >
                            <a>Adresse IP :</a><br>
                            <input type="text" class="box0" name="IP">
                        </div>
                        <div class="textbox2" >
                            <a>Lien phpMyAdmin :</a><br>
                            <input type="text" class="box0" name="lien_php">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="login-box">
                        <div class="textbox1" >
                            <a>Port SSH :</a><br>
                            <input type="text" class="box0" name="port_ssh">
                        </div>
                        <div class="textbox2" >
                            <a>Lien :</a><br>
                            <input type="text" class="box0" name="lien">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="login-box">
                        <div class="textbox1" >
                            <a>Nom d'utilisateur :</a><br>
                            <input type="text" class="box0" name="nom_utilisateur">
                        </div>
                        <div class="textbox3" >
                            <input type="checkbox" class="box0" name="restri_IP"> <a> Restriction par IP</a>
                        </div>
                    </div>
                </div>

        <!--Bonus-->
                <div class="textbox1" >
                    <input id="bonus"type="checkbox" onclick="CheckMe()" checked> <a> Ajouter un environnement de pré-production</a>
                </div>
                    <div id="msg">
                    <div id="contai" class="container-fluid">
                        <h4>Environnement de pré-production</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="login-box">
                                    <div class="box1" >
                                        <a>Adresse IP :</a><br>
                                        <input type="text" class="box0" name="IP2">
                                    </div>
                                    <div class="box2" >
                                        <a>Lien phpMyAdmin :</a><br>
                                        <input type="text" class="box0" name="lien_php2">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="login-box">
                                    <div class="box1" >
                                        <a>Port SSH :</a><br>
                                        <input type="text" class="box0" name="port_ssh2">
                                    </div>
                                    <div class="box2" >
                                        <a>Lien :</a><br>
                                        <input type="text" class="box0" name="lien2">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="login-box">
                                    <div class="box1" >
                                        <a>Nom d'utilisateur :</a><br>
                                        <input type="text" class="box0" name="nom_utilisateur2">
                                    </div>
                                    <div class="box3" >
                                        <input type="checkbox" class="box0" name="restri_IP2"> <a> Restriction par IP</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--Script JS pour l'ajout avec la checkbox-->
                <script>
                    function CheckMe(){
                        var cb = document.getElementById("bonus");
                        var text = document.getElementById("msg");
                        if(cb.checked==true){
                            text.style.display="block";
                        } else {
                            text.style.display="none";
                        }
                    }
                </script>
            </div>
        </form>
        <div>
            <button name="button" type="submit"id="btn-save"> Sauvegarder</button>
        </div>
    </section>
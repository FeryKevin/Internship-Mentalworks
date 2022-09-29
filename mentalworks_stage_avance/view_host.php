<!DOCTYPE html>
<html>
    <head>
        <title>Hébergeurs</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">        
    </head>
    
    <body>
    
        <!-- header : navbar -->
        
        <?php 
        
        require ('header.php');
        
        ?>
        
        <!-- tableau + pagination -->
        
        <?php
        
        require ('connexion.php');

        $db = connect();

        /* requete pour mettre le resultat dans un tableau */
        $q = $db->query('SELECT COUNT(*) FROM host');
        $items = $q->fetchAll();

        /* définir la page par défaut (1ere page) */
        $page = (!empty($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;

        /* définir le nombre de lignes à afficher par page et récupérer le total de page qu'on aura */
        $limit = 20;
        $totalPages = ceil(count($items) / $limit);

        /* le nombre de pages qu'on aura en tout + sécurisation de l'url */
        $page = max($page, 1);
        $page = min($page, $totalPages);

        /* récupérer uniquement les valeurs de la page qu'on visionne */
        $offset = ($page - 1) * $limit;
        $offset = ($offset < 0) ? 0 : $offset;
        $items = array_slice($items, $offset, $limit);

        /* définit la page qu'on visionne + la limite de lignes à afficher par page */
        $page = (!empty($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
        $limit = 20;

        /* récupère le total d'entrée dans la base de données pour déterminer le nombre de pages qu'on aura au total */
        $totalItems = $db->query('SELECT count(id) AS total FROM host')->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalItems / $limit);

        /* sécurise notre variable $page et on récupère l'offset */
        $page = max($page, 1);
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $limit;
        $offset = ($offset < 0) ? 0 : $offset;

        /* récupérer tous nos items qui sont dans la base de données en précisant où commencer et la limite */
        $items = $db->query('SELECT * FROM host LIMIT '. $offset . ',' . $limit);

        ?>

        <!-- section view_page -->
        
        <section id="view_page">
            <div class="container">
                
                <!-- titre + nombre de clients --> 
                <?php

                $db = connect();
                $sql = "SELECT COUNT(*) FROM host";
                $res = $db->query($sql);
                $count = $res->fetchColumn();
                echo "<h3 id='client'>$count hébergeurs <a href='hebergeurs/nouv_hebergeur.php'><span class='glyphicon glyphicon-plus-sign' id='glyph'></span></a></h3>"; 

                ?>
                
                <!-- tableau html -->
                <table class="table table-bordered titreTableau">
                    <tr>
                        <th>NOM CLIENT</th>
                        <th>CODE INTERNE</th>
                        <th>MODIFIER</th>
                    </tr>
      
                    <!-- remplissage du tableau -->
                    <?php foreach ($items as $item): ?>
                        <tr class="contenuTableau">
                            <td><?= $item['name']; ?></td>
                            <td><?= $item['code']; ?></td>
                            <td><a href="hebergeurs/update_hebergeur.php?id=<?php echo $item['id']?>" role="button">Modifier</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <!-- pagination -->
                <nav aria-label="Array pagination">
                    <ul class="pagination">
                        
                        <!-- previous -->
                        <?php if($page != 1){ ?>
                            <li class="page-item">
                                <a class="page-link" href="view_host.php?page=<?= $page - 1; ?>" aria-label="Previous" style="background-color: #f7f8f8; color:#000;">
                                    <span aria-hidden="true" class="glyphicon glyphicon-menu-left"></span>
                                    <span class="sr-only" style="background-color: #f7f8f8; color:#000;">Previous</span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <!-- chiffre -->
                        <?php for($i = 1;$i <= $totalPages;$i++) {?>
                            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>"><a class="page-link" style="background-color: #f7f8f8; color:#000;" href="view_host.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php } ?>
                        
                        <!-- next -->
                        <?php if($page < $totalPages){ ?>
                            <li class="page-item">
                                <a class="page-link"href="view_host.php?page=<?= $page + 1; ?>" aria-label="Next" style="background-color: #f7f8f8; color:#000;">
                                    <span aria-hidden="true" class="glyphicon glyphicon-menu-right" style="background-color: #f7f8f8; color:#000;"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </section>
    </body>
</html>
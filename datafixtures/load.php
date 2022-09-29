<!-- script php -> jeu d'essai -->

<?php 
require ('connexion.php');
$db = connect();

/* insert host */
$stmt = $db->prepare("INSERT INTO host (code, name) VALUES ('HOST_11','OVH')");
$stmt->execute();
$a = $db->lastInsertId();

/* insert customer */
$stmt = $db->prepare("INSERT INTO customer (code, name) VALUES ('CLIENT_11','EADS')");
$stmt->execute();
$b = $db->lastInsertId();

/* insert contact */
$stmt = $db->prepare("INSERT INTO contact (email, phone_number, host_id, customer_id) VALUES ('eads@contact.fr','0344060606', $a, $b)");
$stmt->execute();

/* insert project */
$stmt = $db->prepare("INSERT INTO project (name, code, lastpass_folder, link_mock_ups, managed_server, notes, host_id, customer_id) VALUES ('eads-project', 'PROJECT_11', 'test11', 'test11', 0, 'test11', $a, $b)");
$stmt->execute();
$c = $db->lastInsertId();

/* insert environment */
$stmt = $db->prepare("INSERT INTO environment (name, link, ip_address, ssh_port, ssh_username, phpmyadmin_link, ip_restriction, project_id) VALUES ('test11', 'test11', '172.00.00.00', 22, 'sshtest11', 'link11', 0, $c)");
$stmt->execute();

?>
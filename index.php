<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 14/10/2016
 * Time: 01:35
 */

session_start();
// on utiise des sessions

$ROOT = __DIR__; // correspond à la racine du systeme
$DS = DIRECTORY_SEPARATOR; // correspond a un '/' mais est disponible sur n'importe quel OS

$controller = ''; // controller que va appeller le fichier index
$action = ''; // action demandée

if(isset($_GET['control'])){ // si le controller est donné dans l'URL
    $controller = $_GET['control'];
}else
    $controller = 'userSimple'; // par defaut le controller est userSimple


switch ($controller){
    case 'etu': // etu
        require("{$ROOT}{$DS}controller{$DS}etudiant.php");
        break;
    case 'admin':
        require("{$ROOT}{$DS}controller{$DS}admin.php");
        break;
    case 'userSimple':
        // si tu n'est pas un etudiant ou une admin alors tu es juste un utilisateur simple
        require("{$ROOT}{$DS}controller{$DS}userSimple.php");
        break;
}


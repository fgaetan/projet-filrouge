<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewBrand.php';
require_once '../model/ModelAdmin.php';
require_once '../model/ModelBrand.php';
ViewTemplate::head("Suppression d'une marque");
ViewTemplate::header();

if (isset($_GET['id'])) {
    $marque = new ModelBrand();
    if ($marque->display($_GET['id'])) {
        if (unlink('uploads\/brands\/' . $marque->display($_GET['id'])['logo'])) {
            if ($marque->delete($_GET['id'])) {
                ViewTemplate::managers('ViewTemplate', 'alert', ['success', 'Action effectuée avec succès.', $_SERVER['HTTP_REFERER']]);
            } else {
                ViewTemplate::managers('ViewTemplate', 'alert', ['danger', 'Erreur.', $_SERVER['HTTP_REFERER']]);
            }
        }
    } else {
        ViewTemplate::managers('ViewTemplate', 'alert', ['danger', 'Erreur.', $_SERVER['HTTP_REFERER']]);
    }
} else {
    ViewTemplate::managers('ViewTemplate', 'alert', ['danger', 'Erreur.', $_SERVER['HTTP_REFERER']]);
}

ViewTemplate::footer();
ViewTemplate::end(false);

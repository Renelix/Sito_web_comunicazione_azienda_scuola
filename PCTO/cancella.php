<?php
session_start();
ob_start();
ini_set('display_errors', 0);
if (isset($_SESSION['Id_azienda'])) {
    unset($_SESSION['Id_azienda']);
    unset($_SESSION['Denominazione']);
} else if (isset($_SESSION['Id_tutor_pcto'])) {
    unset($_SESSION['Id_tutor_pcto']);
    unset($_SESSION['Nome']);
    unset($_SESSION['Cognome']);
}
header("location: index.php");
?>
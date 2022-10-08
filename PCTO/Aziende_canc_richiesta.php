<?php
ob_start();
session_start();
if (isset($_SESSION['Id_azienda'])) {
    if (isset($_GET['Idr'])) {
        $idr = $_GET['Idr'];
        ini_set('display_errors', 0);
        $Connessione = mysqli_connect("localhost", "root", "");
        if (!$Connessione) {
            header("location: Aziende_richieste.php");
            exit;
        }
        $DB = mysqli_select_db($Connessione, "alternanza");
        if (!$DB) {
            header("location: Aziende_richieste.php");
            exit;
        }
        $query = "SELECT * FROM azienda_richieste WHERE azienda_richieste.Id_azienda_richiesta=$idr AND azienda_richieste.Cod_azienda=" . $_SESSION['Id_azienda'];
        $risultato = mysqli_query($Connessione, $query);
        if (!$risultato) {
            header("location: Aziende_richieste.php");
            exit;
        }
        $riga = mysqli_fetch_array($risultato);
        if(!isset($riga['Id_azienda_richiesta'])){
            header("location: Aziende_richieste.php");
            exit;
        }
        else {
            $query = "DELETE FROM azienda_richieste WHERE azienda_richieste.Id_azienda_richiesta=$idr";
            $risultato = mysqli_query($Connessione, $query);
            if (!$risultato) {
                die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                mysqli_close($Connessione);
                header("location: Aziende_richieste.php");
            } else {
                mysqli_close($Connessione);
                header("location: Aziende_richieste.php");
            }
        }
    } else {
        header("location: Aziende_richieste.php");
    }
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>
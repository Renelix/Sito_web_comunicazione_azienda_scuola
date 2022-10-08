<?php
ob_start();
session_start();
if (isset($_SESSION['Id_tutor_pcto'])) {
    if (isset($_GET['Id'])) {
        $id = $_GET['Id'];
        ini_set('display_errors', 0);
        $Connessione = mysqli_connect("localhost", "root", "");
        if (!$Connessione) {
            header("location: Tutor_bacheca.php?Carico=Fallito");
            exit;
        }
        $DB = mysqli_select_db($Connessione, "alternanza");
        if (!$DB) {
            header("location: Tutor_bacheca.php?Carico=Fallito");
            exit;
        }
        $query = "SELECT * FROM azienda_richieste WHERE azienda_richieste.Cod_tutor IS NOT NULL";
        $risultato = mysqli_query($Connessione, $query);
        if (!$risultato) {
            die("La tabella selezionata non esiste " . mysqli_error($Connessione));
            header("location: Tutor_bacheca.php?Carico=Fallito");
        }
        while ($riga = mysqli_fetch_array($risultato)) {
            if ($riga['Id_azienda_richiesta'] == $id) {
                header("location: Tutor_bacheca.php?Carico=Fallito");
                exit;
            }
        }
        $query = "UPDATE azienda_richieste SET azienda_richieste.Cod_tutor=" . $_SESSION['Id_tutor_pcto'] . " WHERE azienda_richieste.Id_azienda_richiesta=$id";
        $risultato = mysqli_query($Connessione, $query);
        if (!$risultato) {
            die("La tabella selezionata non esiste " . mysqli_error($Connessione));
            header("location: Tutor_bacheca.php?Carico=Fallito");
        } else {
            $query = "UPDATE azienda_richieste SET azienda_richieste.Url_contratto='docs/contratti/Contratto_standard.docx' WHERE azienda_richieste.Id_azienda_richiesta=$id";
            $risultato = mysqli_query($Connessione, $query);
            if (!$risultato) {
                die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                header("location: Tutor_bacheca.php?Carico=Fallito");
            } else {
                header("location: Tutor_bacheca.php?Carico=Eseguito");
            }
        }
        mysqli_close($Connessione);
    } else {
        header("location: Tutor_bacheca.php?Carico=Fallito");
    }
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>
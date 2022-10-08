<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestione PCTO - Login</title>
    <link rel="icon" type="image/png" href="asset/img/pcto.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var parametri = location.search;
            if (parametri == "?Credenziali=Errate") {
                $("#credenziali").removeClass("nascosto");
            } else if (parametri == "?Sessione=Scaduta") {
                $("#sessione").removeClass("nascosto");
            } else if (parametri == "?Accesso=Errore") {
                $("#noaccesso").removeClass("nascosto");
            }
        });
    </script>
</head>
<style>
    .main-content {
        width: 50%;
        border-radius: 20px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
        margin: 5em auto;
        display: flex;
    }

    .company__info {
        background-color: #198754;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        border-right: 20px #198754;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #fff;
    }

    @media screen and (max-width: 700px) {
        .main-content {
            width: 90%;
        }

        .company__info {
            display: none;
        }

        .login_form {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
    }

    @media screen and (min-width: 700px) and (max-width:1100px) {
        .main-content {
            width: 70%;
        }

        .pcto {
            width: 35%;
        }
    }

    @media screen and (min-width: 1100px) and (max-width:5000px) {
        .main-content {
            width: 35%;
        }

        .pcto {
            width: 55%;
        }
    }

    .row>h2 {
        color: #198754;
    }

    .login_form {
        background-color: #fff;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        border-top: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }

    form {
        padding: 0 2em;
    }

    .form__input {
        width: 100%;
        border: 0px solid transparent;
        border-radius: 0;
        border-bottom: 1px solid #aaa;
        padding: 1em .5em .5em;
        padding-left: 2em;
        outline: none;
        margin: 1.5em auto;
        transition: all .5s ease;
    }

    .form__input:focus {
        border-bottom-color: #198754;
        box-shadow: 0 0 5px rgba(0, 80, 80, .4);
        border-radius: 4px;
    }

    .btn {
        transition: all .5s ease;
        width: 70%;
        border-radius: 30px;
        color: #198754;
        font-weight: 600;
        background-color: #fff;
        border: 1px solid #198754;
        margin-top: 1.5em;
        margin-bottom: 1em;
    }

    .btn:hover,
    .btn:focus {
        background-color: #198754;
        color: #fff;
    }

    .nascosto {
        display: none;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['Id_azienda']) && !isset($_SESSION['Id_tutor_pcto'])) {
    ob_start();
    ini_set('display_errors', 0);
    if (isset($_POST["Use"]) && isset($_POST['Pas'])) {
        $Username = $_POST["Use"];
        $Pass = md5($_POST["Pas"]);
        $Connessione = mysqli_connect("localhost", "root", "");
        if (!$Connessione) {
            header("location: ?Accesso=Errore");
        }
        $DB = mysqli_select_db($Connessione, "alternanza");
        if (!$DB) {
            header("location: ?Accesso=Errore");
        }
        $Flag = 0;
        $query = "SELECT * FROM aziende";
        $risultato = mysqli_query($Connessione, $query);
        if (!$risultato) {
            header("location: ?Accesso=Errore");
        }
        while ($riga = mysqli_fetch_array($risultato)) {
            if ($Username == $riga['Denominazione_login'] and $Pass == $riga['Password_login']) {
                $_SESSION['Id_azienda'] = $riga['Id_azienda'];
                $_SESSION['Denominazione'] = $riga['Denominazione'];
                $Flag = 1;
                break;
            }
        }
        if ($Flag == 0) {
            $query = "SELECT * FROM tutor_pcto";
            $risultato = mysqli_query($Connessione, $query);
            if (!$risultato) {
                header("location: ?Accesso=Errore");
            }
            while ($riga = mysqli_fetch_array($risultato)) {
                if ($Username == $riga['Username_login'] and $Pass == $riga['Password_login']) {
                    $_SESSION['Id_tutor_pcto'] = $riga['Id_tutor_pcto'];
                    $_SESSION['Nome'] = $riga['Nome'];
                    $_SESSION['Cognome'] = $riga['Cognome'];
                    $Flag = 2;
                    break;
                }
            }
        }
        mysqli_close($Connessione);
        if ($Flag == 1) {
            header("location: Aziende.php");
        } else if ($Flag == 2) {
            header("location: Tutor.php");
        } else if ($Flag == 0) {
            header("location: ?Credenziali=Errate");
        }
    }
?>

    <body>
        <div class="container-fluid">
            <div class="row main-content bg-success text-center">
                <div class="col-md-4 text-center company__info">
                    <span class="company__logo">
                        <h2><img src="asset/img/pcto1.png" class="pcto"></h2>
                    </span>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                    <div class="container-fluid">
                        <div class="row">
                            <h2>Log in</h2>
                        </div>
                        <div class="row">
                            <form class="form-group" action="#" method="POST">
                                <div class="row">
                                    <input type="text" name="Use" id="username" class="form__input" placeholder="Username">
                                </div>
                                <div class="row">
                                    <input type="password" name="Pas" id="password" class="form__input" placeholder="Password">
                                </div>
                                <div class="row">
                                    <input type="submit" value="Accedi" class="btn">
                                </div>
                            </form>
                        </div>
                        <div class="alert nascosto alert-danger" role="alert" id="credenziali">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Le credenziali inserite non sono corrette! Si prega di riprovare.
                        </div>
                        <div class="alert nascosto alert-warning" role="alert" id="sessione">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Sessione scaduta, si prega di riaccedere.
                        </div>
                        <div class="alert nascosto alert-danger" role="alert" id="noaccesso">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Impossibile accedere, riprovare.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center footer" role="alert">
            <h5>Sviluppo a cura di <strong><a href="" style="color:#198754;" class="text-decoration-none">Antonio Caiafa</a></strong> V A Informatica - a.s. 2020/2021 <strong><a href="https://www.itcgtursi.edu.it/" target="_blank" style="color:#198754;" class="text-decoration-none"> ITSET "Manlio Capitolo" Tursi (MT)</a></strong></h5>
        </div>
    </body>
<?php
} else {
    if (isset($_SESSION['Id_azienda'])) {
        header("location: Aziende.php");
    } else if (isset($_SESSION['Id_tutor_pcto'])) {
        header("location: Tutor.php");
    }
}
?>

</html>
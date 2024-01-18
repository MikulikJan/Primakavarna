<?php
require "stranky.php";

session_start();

$chyba = "";

// zpracovani prihl. formulare
if (array_key_exists("prihlasit", $_POST))
{
    $jmeno = $_POST["jmeno"];
    $heslo = $_POST["heslo"];

    if ($jmeno == "admin" && $heslo == "1234")
    {
        // uzivatel. zadal platne prihlasovaci udaje
        $_SESSION["prihlasenyUzivatel"] = $jmeno;
    }
    else
    {
        // spatne prihlasovaci udaje
        $chyba = "Nesprávné přihlašovací údaje";
    }
}

// zpracování odhl. formuláře
if (array_key_exists("odhlasit", $_POST))
{
    unset($_SESSION["prihlasenyUzivatel"]);
    header("Location: ?");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrace</title>
</head>
<body>
    <?php
    if (array_key_exists("prihlasenyUzivatel", $_SESSION) == false)
    {
        // sekce pro neprihlasene uzivatele
        ?>
        <form method="post">
            <label for="jmeno">Přihl. jméno</label>
            <input type="text" name="jmeno" id="jmeno">
            <br>
            <label for="heslo">Heslo</label>
            <input type="password" name="heslo" id="heslo">
            <br>

            <button name="prihlasit">Přihlásit</button>
        </form>

        <?php
        echo $chyba;
    }
    else
    {
        // sekce pro prihlasene uzivatele
        echo "Přihlášen uživatel: {$_SESSION["prihlasenyUzivatel"]}";

        echo "<form method='post'>
            <button name='odhlasit'>Odhlásit</button>
            </form>";
    }
    ?>
</body>
</html>
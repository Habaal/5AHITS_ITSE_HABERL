<?php
session_start();

if (!isset($_SESSION["zahl"]) || isset($_POST["neu"])) {
    $_SESSION["zahl"] = random_int(1, 100);
    $_SESSION["versuche"] = 0;
}

$meldung = "";
$gewonnen = false;

if (isset($_POST["tipp"]) && is_numeric($_POST["tipp"])) {
    $tipp = (int)$_POST["tipp"];
    $_SESSION["versuche"]++;

    if ($tipp < $_SESSION["zahl"]) {
        $meldung = "Zu niedrig!";
    } elseif ($tipp > $_SESSION["zahl"]) {
        $meldung = "Zu hoch!";
    } else {
        $meldung = "Richtig! Gelöst in " . $_SESSION["versuche"] . " Versuch(en).";
        $gewonnen = true;
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Zahlenratespiel</title></head>
<body>
<h1>Zahlenratespiel</h1>
<p>Errate die Zahl zwischen 1 und 100.</p>

<?php if (!$gewonnen): ?>
<form method="post">
<input type="number" name="tipp" min="1" max="100" required autofocus>
<button type="submit">Raten</button>
</form>
<?php endif; ?>

<?php if ($meldung): ?><p><strong><?= htmlspecialchars($meldung) ?></strong></p><?php endif; ?>
<p>Versuche bisher: <?= $_SESSION["versuche"] ?></p>

<form method="post"><button type="submit" name="neu">Neues Spiel</button></form>
</body>
</html>

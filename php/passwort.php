<?php
$passwort = "";
$fehler = "";
$laenge = 12;
$post = $_SERVER["REQUEST_METHOD"] === "POST";

if ($post) {
    $laenge = max(4, min(64, (int)($_POST["laenge"] ?? 12)));

    $zeichen = "";
    if (isset($_POST["klein"]))  $zeichen .= "abcdefghijklmnopqrstuvwxyz";
    if (isset($_POST["gross"]))  $zeichen .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if (isset($_POST["zahlen"])) $zeichen .= "0123456789";
    if (isset($_POST["sonder"])) $zeichen .= "!@#$%&*?+-_";

    if ($zeichen === "") {
        $fehler = "Bitte mindestens eine Option auswählen.";
    } else {
        for ($i = 0; $i < $laenge; $i++) {
            $passwort .= $zeichen[random_int(0, strlen($zeichen) - 1)];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Passwort-Generator</title></head>
<body>
<h1>Passwort-Generator</h1>
<form method="post">
<label>Länge (4–64):
<input type="number" name="laenge" min="4" max="64" value="<?= $laenge ?>">
</label><br>
<label><input type="checkbox" name="klein"  <?= (!$post || isset($_POST["klein"]))  ? "checked" : "" ?>> Kleinbuchstaben</label><br>
<label><input type="checkbox" name="gross"  <?= (!$post || isset($_POST["gross"]))  ? "checked" : "" ?>> Großbuchstaben</label><br>
<label><input type="checkbox" name="zahlen" <?= (!$post || isset($_POST["zahlen"])) ? "checked" : "" ?>> Zahlen</label><br>
<label><input type="checkbox" name="sonder" <?= isset($_POST["sonder"]) ? "checked" : "" ?>> Sonderzeichen</label><br>
<button type="submit">Generieren</button>
</form>

<?php if ($fehler): ?>
<p style="color:red"><?= htmlspecialchars($fehler) ?></p>
<?php elseif ($passwort): ?>
<p>Dein Passwort: <code><?= htmlspecialchars($passwort) ?></code></p>
<?php endif; ?>
</body>
</html>

<?php
$noten = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($_POST["noten"] ?? [] as $n) {
        if ($n !== "" && is_numeric($n) && $n >= 1 && $n <= 5) {
            $noten[] = (int)$n;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Notenverwaltung</title></head>
<body>
<h1>Notenverwaltung</h1>
<form method="post">
<?php for ($i = 1; $i <= 5; $i++): ?>
<label>Note <?= $i ?>:
<input type="number" name="noten[]" min="1" max="5">
</label><br>
<?php endfor; ?>
<button type="submit">Berechnen</button>
</form>

<?php if (count($noten) > 0):
    $durchschnitt = array_sum($noten) / count($noten);
    $beste        = min($noten);
    $schlechteste = max($noten);
    $positive     = count(array_filter($noten, fn($n) => $n <= 4));
?>
<h2>Auswertung</h2>
<table border="1" cellpadding="5">
<tr><th>Eingegebene Noten</th><td><?= htmlspecialchars(implode(", ", $noten)) ?></td></tr>
<tr><th>Durchschnitt</th><td><?= round($durchschnitt, 2) ?></td></tr>
<tr><th>Beste Note</th><td><?= $beste ?></td></tr>
<tr><th>Schlechteste Note</th><td><?= $schlechteste ?></td></tr>
<tr><th>Positive Noten</th><td><?= $positive ?> von <?= count($noten) ?></td></tr>
</table>
<?php endif; ?>
</body>
</html>

<?php
session_start();
$polaczenie = mysqli_connect("localhost", "root", "", "multiplication") or die("Błąd połączenia: " . mysqli_connect_error());
$previousAction = 0;
$showActionI = 0;

function calculateAction($action) {
    global $polaczenie;
    $record = mysqli_query($polaczenie, "SELECT action FROM actions WHERE id='$action';");
    $selectedRecord = mysqli_fetch_assoc($record);
    $saveSelectedAction = $selectedRecord["action"];
    echo $saveSelectedAction;
}

function showAction() {
    global $previousAction, $showActionI;
    $showActionI;
    do {
        $action = random_int(1, 47);
    } while ($action == $previousAction);
    $_SESSION["action" . $showActionI] = $action;
    calculateAction($action);
    $previousAction = $action;
    $showActionI++;
}

if ($_SESSION['checkCss'] == null) {
    $_SESSION['checkCss'] = 0;
}

$jsonCss = json_encode($_SESSION['checkCss']);
echo "<script>var checkCss = $jsonCss;</script>";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Test</title>
    <link id="link_css" rel="stylesheet" href="style_default.css">
    <script>
        if (checkCss == 1) {
            document.getElementById("link_css").setAttribute("href", "style_fantasy.css");
        }
    </script>
</head>
<body>
<h2>Test z tabliczki mnożenia</h2>
<form id="form" action="result.php" method="POST">
    <table class="test_page">
    <tr>
        <td class="timer" colspan="2"><p id="time_notification">Masz 5 minut!</p><p>Po tym czasie automatycznie zakończy się test.</p></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_one" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_two" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_three" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_four" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_five" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td class="action"><?php showAction(); ?><input class="text_box" type="text" name="action_six" size="5" maxlength="3"></td>
    </tr>
    <tr>
        <td colspan="2"><button><input class="submit" type="submit" value="Zakończ test"></button></td>
    </tr>
    </table>
</form>
<script>

setTimeout(() => {
    document.getElementById("time_notification").innerHTML = "Masz 4 minuty!";
}, 60000);

setTimeout(() => {
    document.getElementById("time_notification").innerHTML = "Masz 3 minuty!";
}, 120000);

setTimeout(() => {
    document.getElementById("time_notification").innerHTML = "Masz 2 minuty!";
}, 180000);

setTimeout(() => {
    document.getElementById("time_notification").innerHTML = "Masz 1 minutę!";
}, 240000);

setTimeout(() => {
    document.getElementById("time_notification").innerHTML = "Koniec czasu!";
}, 290000);

setTimeout(() => {
    document.getElementById("form").submit();
}, 300000);

</script>
</body>
</html>
<?php
mysqli_close($polaczenie);
?>
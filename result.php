<?php
session_start();
$polaczenie = mysqli_connect("localhost", "root", "", "multiplication") or die("Błąd połączenia: " . mysqli_connect_error());
$_SESSION['checkCss'] = 0;

function checkIsResultCorrect() {
    global $polaczenie;
    $action_0 = $_POST["action_one"];
    $action_1 = $_POST["action_two"];
    $action_2 = $_POST["action_three"];
    $action_3 = $_POST["action_four"];
    $action_4 = $_POST["action_five"];
    $action_5 = $_POST["action_six"];
    $score = 0;
    for ($i = 0; $i < 6; $i++) {
        $action = $_SESSION["action" . $i];
        $record = mysqli_query($polaczenie, "SELECT action FROM actions WHERE id='$action';");
        $selectedRecord = mysqli_fetch_assoc($record);
        $beforeCalculatedAction = $selectedRecord["action"];
        $calculatedAction = eval('return ' . $beforeCalculatedAction . ';');
        if (${"action_" . $i} == $calculatedAction) {
            $score++;
        }
    }
    switch ($score) {
    case 0:
        echo "<h2>NIEDOSTATECZNY (jedynka)</h2><p>Wynik: 0/6</p>";
        break;
    case 1:
         echo "<h2>NIEDOSTATECZNY (jedynka)</h2><p>Wynik: 1/6</p>";
        break;
    case 2:
        echo "<h2>DOPUSZCZAJĄCY (dwójka)</h2><p>Wynik: 2/6</p>";
        break;
    case 3:
        echo "<h2>DOSTATECZNY (trójka)</h2><p>Wynik: 3/6</p>";
        break;
    case 4:
        echo "<h2>DOBRY (czwórka)</h2><p>Wynik: 4/6</p>";
        break;
    case 5:
        echo "<h2>BARDZO DOBRY (piątka)</h2><p>Wynik: 5/6</p>";
        break;
    case 6:
    echo "<h2>CELUJĄCY (szóstka)</h2><p>Gratulacje!</p><p>Uzysakłeś/aś motyw fantasy na jeden kolejny test!</p><p>Wynik: 6/6</p>";
        break;
    default:
        break;
    }

    return $score;
}

function changeCss() {
    $score = checkIsResultCorrect();
    if ($score == 6) {
        $_SESSION['checkCss'] = 1;
    } else {
        $_SESSION['checkCss'] = 0;
    }
    $jsonCss = json_encode($_SESSION['checkCss']);
    echo "<script>var checkCss = $jsonCss;</script>";
}

changeCss();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Test Results</title>
    <link id="link_css" rel="stylesheet" href="style_default.css">
    <script>
        if (checkCss == 1) {
            document.getElementById("link_css").setAttribute("href", "style_fantasy.css");
        }
    </script>
</head>
<body>

<script>
    console.log(checkCss);
</script>

<a href="test.php"><button>Powtórz test</button></a>
</body>
</html>
<?php
mysqli_close($polaczenie);
?>
<?php
session_start();
$_SESSION['checkCss'] = 0;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Test Results</title>
    <link id="link_css" rel="stylesheet" href="style_default.css">
</head>
<body>
<h2>Test z tabliczki mnożenia</h2>
<a href="test.php"><button>Rozpocznij test</button></a>
</body>
</html>
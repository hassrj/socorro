<?php
function celparaFah($cel) {
    return ($cel * 9/5) + 32;
}
function celparacel($cel) {
    return ($cel);
}
function celparaKelvin($cel) {
    return $cel + 273.15;
}
function fahparaCel($fah) {
    return ($fah - 32) * 5/9;
}
function fahparaKelvin($fah) {
    return ($fah - 32) * 5/9 + 273.15;
}
function fahparaFah($fah) {
    return ($fah);
}
function kelparaCel($kel) {
    return $kel - 273.15;
}
function kelparaFah($kel) {
    return ($kel - 273.15) * 9/5 + 32;
}
function kelparakel($kel) {
    return ($kel);
}
$result = "";
$unit = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && is_numeric($_POST["value"])) {
    $value = $_POST["value"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $conversores = [
        "cel" => ["fah" => "celparaFah", "kel" => "celparaKelvin", "cel" => "celparacel"],
        "fah" => ["cel" => "fahparaCel", "kel" => "fahparaKelvin", "fah" => "fahparaFah"],
        "kel" => ["cel" => "kelparaCel", "fah" => "kelparaFah", "kel" => "kelparakel"]
    ];

    if (isset($conversores[$from][$to])) {
        $result = $conversores[$from][$to]($value);
        $unit = match ($to) {
            "fah" => " °F",
            "kel" => " °K",
            "cel" => " °C",
        };
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>temperatura</title>
    <style>
        body {
            background: linear-gradient(to right, aqua, purple);
            color: white;
        }
        .container {
            max-width: 600px;
            margin: 235px auto;
            padding: 22px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 30px;
        }
        h1 {
            text-align: center;
            margin-bottom: 1px;
            font-size: 2em;
        }
        label, select, input, button {
            display: block;
            width: 100%;
            font-size: 1.2em;
            margin-bottom: 15px;
            color: white;
            border-radius: 20px;
        }
        select, input[type="number"] {
            background-color: black;
        }
        button:hover {
            background-color: royalblue;
        }
        button {
            background-color: dodgerblue;
        }
        .result {
            text-align: center;
            margin-top: 3px;
            font-size: 1.5em;
        }
        .result p {
            margin: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Converta a temperatura</h1>
        <form method="POST">
            <label for="value">Temperatura:</label>
            <input type="number" id="value" name="value" required placeholder="Temperatura Aqui">
            <label for="from">De:</label>
            <select id="from" name="from" required>
                <option value="cel">Celsius (°C)</option>
                <option value="fah">Fahrenheit (°F)</option>
                <option value="kel">Kelvin (°K)</option>
            </select>
            <label for="to">Para:</label>
            <select id="to" name="to" required>
                <option value="cel">Celsius (°C)</option>
                <option value="fah">Fahrenheit (°F)</option>
                <option value="kel">Kelvin (°K)</option>
            </select>
            <button type="submit">Converter</button>
        </form>
        <?php if ($result !== ""): ?>
            <div class="result">
                <h3>Valor Convertido:</h3>
                <p><?= number_format($result, 2) . $unit ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
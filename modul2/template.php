<?php
$errMsg = "";
$status = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pengambilan value pada input
    $height = $_POST["tinggi_badan"];
    $weight = $_POST["berat_badan"];

    // pengkondisian ketika inputan kosong
    if (!$height || !$weight || $height == "" || $weight == "") {
        $errMsg = "Value is required";
    }

    // pengkondisian ketika benar
    if ($errMsg == "") {
        // convert cm ke m
        $convertM = $height / 100;

        // kalkulasi
        $calculate = $weight / ($convertM * $convertM);

        // pembulatan
        $bmi = number_format($calculate, 1);

        // switch case
        switch ($bmi) {
            case $bmi <= 18.4:
                $status = "Underweight";
                break;
            case $bmi >= 18.5 && $bmi <= 24.9:
                $status = "Normal";
                break;
            case $bmi >= 25.0 && $bmi <= 39.9:
                $status = "Overweight";
                break;
            default:
                $status = "Obese";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator BMI</title>
    <link rel="stylesheet" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        p {
            margin: 0px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 p-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Kalkulator BMI</h4>
                    <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="tinggi_badan" id="tinggi_badan" placeholder="175">
                            <label for="tinggi_badan">Tinggi Badan (CM)</label>
                        </div>
                        <div class="form-floating">
                            <input type="number" class="form-control" name="berat_badan" id="berat_badan" placeholder="53">
                            <label for="berat_badan">Berat Badan (KG)</label>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 mt-3 w-100" name="submit">Hitung BMI</button>
                    </form>
                    <!-- success statement -->
                    <?php if ($errMsg === "") : ?>
                        <div class="alert alert-success d-flex justify-content-between" role="alert">
                            <p><?= $status ?></p>
                            <p><?= $bmi ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- error sattement -->
                    <?php if ($errMsg !== "") : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errMsg ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
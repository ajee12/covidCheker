<?php
$url = curl_init('https://covid19.mathdro.id/api');
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($url);
$data = json_decode($res, true);
$confirmed = $data['confirmed']['value'];
$recover = $data['recovered']['value'];
$deaths = $data['deaths']['value'];

if (isset($_GET['country']) && !empty($_GET['country'])) {

    $url1 = curl_init('https://covid19.mathdro.id/api/countries/' . $_GET['country']);
    curl_setopt($url1, CURLOPT_RETURNTRANSFER, true);
    $res1 = curl_exec($url1);
    $data1 = json_decode($res1, true);
    $confirm = $data1['confirmed']['value'];
    $recov  = $data1['recovered']['value'];
    $dea = $data1['deaths']['value'];
    $update = $data1['lastUpdate'];
}

$url2 = curl_init('https://covid19.mathdro.id/api/confirmed/');
curl_setopt($url2, CURLOPT_RETURNTRANSFER, true);
$res2 = curl_exec($url2);
$data2 = json_decode($res2, true);





?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Statistic Covid-19</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Covid-19 Statistics Cheker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </ul>
        </div>
        </div>
    </nav>
    <div class="container mt-2">
        <h1>Global</h1>
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-dark">
                    <p class="text-center mt-2 text-warning">Confirmed</p>
                    <h4 class=" text-center text-warning"><?php echo number_format($confirmed) ?></h4>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-dark">
                    <p class="text-center mt-2 text-success">Recovered</p>
                    <h4 class=" text-center text-success"><?php echo number_format($recover) ?></h4>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-dark">
                    <p class="text-center mt-2 text-danger">Deaths(s)</p>
                    <h4 class=" text-center text-danger"><?php echo number_format($deaths) ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center mt-4">Covid-19 Statistics Cheker</h1>
                <form method="get" name="country">
                    <div class="row center">
                        <div class="col-md-10  ">
                            <input type="search" name="country" class="form-control form-control-lg " placeholder="Indonesia" required>
                        </div>
                        <div class="col-2 d-grid gap-2 ">
                            <button type="submit" class="btn btn-block btn-lg btn-dark">Search</button>

                        </div>
                    </div>
                </form>
                <?php if (!empty($data1['confirmed'])) : ?>
                    <h4 class="mt-3">Statistics of <?php echo ($_GET['country']); ?></h4>
                    <table style="background: dark" class="table table-dark">
                        <thead>
                            <tr>
                                <th class="text-warning" scope="col">Confirmed</th>
                                <th class="text-success" scope="col">Recovered</th>
                                <th class="text-danger" scope="col">Deaths(s)</th>
                                <th scope="col">Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-warning" scope="row"><?php echo number_format($confirm) ?></th>
                                <td class="text-success"><?php echo number_format($recov) ?></td>
                                <td class="text-danger"><?php echo number_format($dea) ?></td>
                                <td><?php echo ($update) ?></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-5">Stats Last update : <?php echo ($data['lastUpdate']) ?></h3>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Country</th>
                        <th scope="col">Province</th>
                        <th scope="col">Confirmed</th>
                        <th scope="col">Recovered</th>
                        <th scope="col">Deaths(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data2 as $key) : ?>
                        <tr>
                            <th scope="row"><?php echo ($key['countryRegion']) ?></th>
                            <td><?php echo ($key['provinceState']) ?></td>
                            <td><?php echo number_format($key['confirmed']) ?></td>
                            <td><?php echo number_format($key['recovered']) ?></td>
                            <td><?php echo number_format($key['deaths']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<footer>

    <p class="text-center mt-2"><a href="https://github.com/ajee12">CreatedBy:HijrahToz</a></p>
</footer>

</html>
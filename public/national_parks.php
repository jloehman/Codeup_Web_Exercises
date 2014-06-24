<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'jason', 'letmein');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


function getOffset() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    return ($page - 1) * 4;
}

$limitRecord = 4;
$pageNumber = 0;
$offset = 0;

if (isset($_GET['page'])) {
    $pageNumber=$_GET['page'];
    $offset = $pageNumber * $limitRecord;

}



$query = 'SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset();
$stmt = $dbc->prepare($query);
$stmt->bindValue(':limitRecord', $limitRecord, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $parks = $dbc->query($query)->fetchall(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

$numPages = ceil($count / 4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

// if (isset($_GET['page']))
$nextPage = $page + 1;
$prevPage = $page - 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>National Parks</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />

    <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <div class="container">
        <h1>National Parks <small>Parks National</small></h1>

        <table class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Date Established</th>
                <th>Area in Acres</th>
                <th>Description</th>
            </tr>

            <?php foreach ($parks as $park): ?>
                <tr>
                    <td><?= $park['name']; ?></td>
                    <td><?= $park['location']; ?></td>
                    <td><?= $park['date_established']; ?></td>
                    <td><?= $park['area_in_acres']; ?></td>
                    <td><?= $park['description']; ?></td>
                </tr>
            <?php endforeach ?>
        </table>

        <ul class="pager">

          <li class="previous">
            <?php if ($page > 1): ?>
            <a href="?page=<?= $prevPage; ?>">&larr; Previous</a>
            <?php endif; ?>
          </li>
          <li class="next">
            <?php if ($page < $numPages): ?>
            <a href="?page=<?= $nextPage; ?>">Next &rarr;</a>
            <?php endif; ?>
          </li>

        </ul>
        <form method="POST" action="/national_parks.php">
            <p>
        <label for="Parks">Name</label>
        <input id="parks" name="parks" type="text" placeholder="Park Name">
            
        <label for="parks">Location</label>
        <input id="parks" name="parks" type="text" placeholder="State">
            
        <label for="parks">Date Est.</label>
        <input id="parks" name="parks" type="text" placeholder="date established">
            
        <label for="parks">Acres</label>
        <input id="parks" name="parks" type="text" placeholder="area in acres">
        </p>    
        <!-- <label for="body">Text Body</label> -->
        <p>
        <label for="parks">Description</label>
        <textarea name="description" type="text" placeholder="park description" rows="5" cols="140" id="description"></textarea>
    </p>
    <p>
        <button type="submit">submit</button>
    </p>
    </div>
</form>
</body>
</html>

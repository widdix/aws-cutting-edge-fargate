<?php
require_once('./shared.php');
$pdo = new PDO('mysql:host=' . getenv('RDS_HOSTNAME') .';dbname=test', 'master', getenv('RDS_PASSWORD'));
$pdo->exec('CREATE TABLE IF NOT EXISTS votes (id INTEGER AUTO_INCREMENT PRIMARY KEY, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, service VARCHAR(255))');
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    <div class="container" style="margin-top: 10px;">
      <div class="jumbotron">
        <h1 class="display-4">Favorite AWS Architecture</h1>
        <p class="lead">Vote for your favorite architecture.</p>
        <hr class="my-4">
        <p>Rapid Docker on AWS is made for DevOps engineers and web developers who want to dockerize their web applications and run the Docker containers on Amazon Web Services (AWS). Prior knowledge of Docker and AWS is not required.</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="https://cloudonaut.io/rapid-docker-on-aws/?utm_source=cutting-edge-arch" role="button">Check it out</a>
        </p>
      </div>
      <div class="row">
        <div class="col">
          <div id="votingresults">
            <h2>Results</h2>
            <ul class="list-group">
              <?php
              foreach($pdo->query('SELECT service, COUNT(*) as votes FROM votes GROUP BY service') as $row) {
              ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $row['service'] ?>
                <span class="badge badge-dark badge-pill"><?php echo $row['votes'] ?></span>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col">
          <div id="vote">
            <h2>Vote</h2>
            <form action="vote.php" method="post">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Favorite Service</label>
                <select name="service" class="form-control">
                  <?php foreach (SERVICES as $service) { echo '<option value="' . $service .'">' . $service .'</option>'; } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
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
                <$php echo $row['service'] ?>
                <span class="badge badge-dark badge-pill"><$php echo $row['votes'] ?></span>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col">
          <div id="vote">
            <h2>Vote</h2>
            <form action="vote.php" method="post">>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Favorite Service</label>
                <select class="form-control">
                  <option value="ec2">ec2</option>
                  <option value="lambda">lambda</option>
                  <option value="fargate">fargate</option>
                  <option value="clb">clb</option>
                  <option value="nlb">nlb</option>
                  <option value="alb">alb</option>
                  <option value="appsync">appsync</option>
                  <option value="apigateway">apigateway</option>
                  <option value="eks">eks</option>
                  <option value="ecs">ecs</option>
                  <option value="rds-aurora">rds-aurora</option>
                  <option value="rds-postgres">rds-postgres</option>
                  <option value="rds-mysql">rds-mysql</option>
                  <option value="rds-mariadb">rds-mariadb</option>
                  <option value="dynamodb">dynamodb</option>
                  <option value="s3">s3</option>
                  <option value="efs">efs</option>
                  <option value="ebs">ebs</option>
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

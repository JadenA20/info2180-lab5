#Name: Jaden Anthony
#ID: 620164510

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

#Variable for object to access database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

#GET request
if (isset($_GET['country']) && !empty(trim($_GET['country']))){
    $userQuery = $_GET['country'];
  }
  
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE '%$country%'");
$stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>

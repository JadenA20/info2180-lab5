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

    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        #Display search from lookup
        echo 
        '<table class="userlookup">
        <thead>
        <tr>
        <th>Country</th>
        <th>Continent</th>
        <th>Year of Independence</th>
        <th>Head of State</th>
        </tr>
        </thead>
        <tbody>';
        #Prints data in HTML table
        foreach ($results as $row) {
                echo '<tr>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['continent']) . '</td>
                <td>' . htmlspecialchars($row['year_of_independence']) . '</td>
                <td>' . htmlspecialchars($row['head_of_state']) . '</td>
                </tr>';
            }
            echo '</tbody></table>';
        } 
    else {
        echo "Country not found";
    }

}


/*<ul>
*<?php foreach ($results as $row): ?>
* <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
*<?php endforeach; ?>
*</ul>
*/

?>

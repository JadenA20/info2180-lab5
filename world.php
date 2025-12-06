<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

#Variable for object to access database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

#GET request
if (isset($_GET['country']) && !empty(trim($_GET['country']))){
    $userQuery = $_GET['country'];

    #Check for city searches
    if (isset($_GET['lookup']) && $_GET['lookup'] === 'city'){
        $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
        $stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            #Display search 
            echo 
            '<table class="citylookup">
            <thead>
            <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
            </tr>
            </thead>
            <tbody>';
            #Prints data in HTML table
            foreach ($results as $row) {
                    echo '<tr>
                    <td>' . htmlspecialchars($row['name']) . '</td>
                    <td>' . htmlspecialchars($row['district']) . '</td>
                    <td>' . htmlspecialchars($row['population']) . '</td>
                    </tr>';
                }
                echo '</tbody></table>';
        } 
        else {
            echo "City not found";
        }
    }
        
    else {
        #Check for country searches
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($results) {
            #Display search 
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
                    <td>' . htmlspecialchars($row['independence_year']) . '</td>
                    <td>' . htmlspecialchars($row['head_of_state']) . '</td>
                    </tr>';
                }
                echo '</tbody></table>';
            } 
        else {
            echo "Country not found";
        }
    }
}


/*<ul>
*<?php foreach ($results as $row): ?>
* <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
*<?php endforeach; ?>
*</ul>
*/

?>

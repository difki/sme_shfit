  <head>
    <meta charset="UTF-8">
    <title>test</title> 

  </head>

ilya
איליה
<?php
$servername = "localhost";
$username = "proj";
$password = "proj";
$dbname = "bitahon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PersonID, FirstName, LastName FROM TestPersons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["PersonID"]. " - Name: " . $row["LastName"]. " " . $row["FirstName"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>


<?php
$servername = "localhost";
$username = "proj";
$password = "proj";
$dbname = "testDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["Name"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<?php
$servername = "localhost";
$username = "proj";
$password = "proj";
$dbname = "testDB";

echo pot2;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->query("SET character_set_client=utf8");
$conn->query("SET character_set_connection=utf8");
$conn->query("SET character_set_database=utf8");
$conn->query("SET character_set_results=utf8");
$conn->query("SET character_set_server=utf8");

$sql = "SELECT * FROM ilya";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
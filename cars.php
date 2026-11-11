<?php
require_once "settings.php";

$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($dbconn) {
    $query = "SELECT * FROM cars";
    $result = mysqli_query($dbconn, $query);

    if ($result) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>YOM</th>
                </tr>";
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='5'>No cars found.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>$" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "<p>Query failed: " . mysqli_error($dbconn) . "</p>";
    }
    
    mysqli_close($dbconn);
} else {
    echo "<p>Unable to connect to the db.</p>";
}
?>
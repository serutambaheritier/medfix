<?php
include('connector.php');
$result = mysqli_query($connect, "DESCRIBE jobs");
while($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
?>

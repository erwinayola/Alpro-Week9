<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALPRO W9 API</title>
    <link rel="stylesheet" type="text/css" href="StyleWeb.css">
</head>
<body>
    <form action="CodeWeb.php" method="post">
        <label for="id">Id:</label>
        <input type="text" name="id" id="id"><br>

        <label for="F_Name">First Name:</label>
        <input type="text" name="F_Name" id="F_Name"><br>

        <label for="L_Name">Last Name:</label>
        <input type="text" name="L_Name" id="L_Name"><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" id="Email"><br>

        <label for="Email2">Email2:</label>
        <input type="email" name="Email2" id="Email2"><br>

        <label for="Profesi">Profesi:</label>
        <input type="text" name="Profesi" id="Profesi"><br>

        <input type="Submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $F_Name = $_POST["F_Name"];
        $L_Name = $_POST["L_Name"];
        $Email = $_POST["Email"];
        $Email2 = $_POST["Email2"];
        $Profesi = $_POST["Profesi"];

        // Pengecekan apakah ID sudah ada di file CSV
        $csvFile = "datapribadi.csv";
        $existingData = file($csvFile, FILE_IGNORE_NEW_LINES);
        $isIdExist = false;

        foreach ($existingData as $row) {
            $rowData = explode(",", $row);
            if ($rowData[0] == $id) {
                $isIdExist = true;
                break;
            }
        }

        if (!$isIdExist) {
            // Menyimpan data ke dalam file CSV
            $data = "$id, $F_Name, $L_Name, $Email, $Email2, $Profesi";
            file_put_contents($csvFile, $data . PHP_EOL, FILE_APPEND);
            echo "Data telah ditambahkan";
        } else {
            echo "ID sudah ada di dalam file. Tidak ada penambahan data.";
        }
    }
    ?>

    <?php
    echo "<table border='1'>
    <tr>
    <th>Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Email2</th>
    <th>Profesi</th>
    </tr>";

    $csvFile = "datapribadi.csv";

    if (file_exists($csvFile)) {
        $csv = array_map('str_getcsv', array_slice(file($csvFile), 1)); // Mengabaikan baris pertama (header)
    
        foreach($csv as $row) {
            echo "<tr>";
            echo "<td>" , $row[0] , "</td>";
            echo "<td>" , $row[1] , "</td>";
            echo "<td>" , $row[2] , "</td>";
            echo "<td>" , $row[3] , "</td>";
            echo "<td>" , $row[4] , "</td>";
            echo "<td>" , $row[5] , "</td>";
            echo "</tr>";
        }
    } else {
        echo "File CSV tidak ditemukan";
    }    

    echo "</table>";
    ?>
</body>
</html>
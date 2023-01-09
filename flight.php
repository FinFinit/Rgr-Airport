<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Document</title>
    <style>
        table,td {
            border: 1px solid #333333;
            border-collapse: collapse;
            padding:10px;
            background: #b5b5b5;
        }
        tr{
            background: #505050;
        }     
    </style>
</head>
<body>
<nav id="menu">
    <a href="Airport.php">Квитки</a>
    <a href="Passenger.php">Пасажири</a>
    <a href="flight.php">Рейси</a>
    <a href="main.php">На головну</a>
</nav>
    
    <?php 
        
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "Airport";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // connect to mysql database
        try{
            $connect = mysqli_connect($host, $user, $password, $database);
        } catch (mysqli_sql_exception $ex) {
            echo 'Error';
        }
            
        $ID = "";
        $departure_date = "";  //name
        $Arrival_date = ""; //id_storage
        $departure_point = "";  //email
        $destination = "";
        $id_airplane = "";

        function getPosts()
            {
                $posts = array();
                $posts[0] = $_POST['ID'];
                $posts[1] = $_POST['departure_date'];
                $posts[2] = $_POST['Arrival_date'];
                $posts[3] = $_POST['departure_point'];
                $posts[4] = $_POST['destination'];
                $posts[5] = $_POST['id_airplane'];
                return $posts;
            }


            $sql = "SELECT * FROM flight ORDER BY 'ASC' LIMIT 10";

                if (!$result = mysqli_query($connect, $sql)) {
                echo "Извините, возникла проблема в работе сайта.";
                exit;
            }

            echo "<table>\n";
            echo "<thead><tr><th colspan = '4'>Рейси</tr></th></thead>\n";
            echo "<td>". "departure_date" . "</td><td>" . "Arrival_date" . "</td><td>" . "departure_point" . "</td><td>" . "destination" ."</td>" ;
                while ($flight = $result->fetch_assoc()) {
                    echo "<tr>\n";   
                    echo "<td>". $flight['departure_date'] . "</td><td>" . $flight['Arrival_date'] . "</td><td>" . $flight['departure_point'] . "</td><td>" . $flight['destination'] ."</td>" ;
                    echo "</tr>";
                }

            echo "</table>\n";


            // Insert
            if(isset($_POST['insert']))
            {
                $data = getPosts();
                $insert_Query = "INSERT INTO `flight`(`ID`, departure_date`, `Arrival_date`, `departure_point`, `destination`) VALUES ('$data[0]', '$data[1]','$data[2]','$data[3]', '$data[4]')";
                try{
                    $insert_Result = mysqli_query($connect, $insert_Query);
                    
                    if($insert_Result)
                    {
                        if(mysqli_affected_rows($connect) > 0)
                        {
                            echo 'Data Inserted';
                        }else{
                            echo 'Data Not Inserted';
                        }
                    }
                } catch (Exception $ex) {
                    echo 'Error Insert '.$ex->getMessage();
                }
            }


            // Delete
            if(isset($_POST['delete']))
            {
                $data = getPosts();
                $delete_Query = "DELETE FROM `flight` WHERE `ID` = $data[0]";
                try{
                    $delete_Result = mysqli_query($connect, $delete_Query);
                    
                    if($delete_Result)
                    {
                        if(mysqli_affected_rows($connect) > 0)
                        {
                            echo 'Data Deleted';
                        }else{
                            echo 'Data Not Deleted';
                        }
                    }
                } catch (Exception $ex) {
                    echo 'Error Delete '.$ex->getMessage();
                }
            }


            // Edit
            if(isset($_POST['update']))
            {
                $data = getPosts();
                $update_Query = "UPDATE `flight` SET `departure_date`='$data[1]',`Arrival_date`='$data[2]',`departure_point`='$data[3]' WHERE `ID` = $data[0]";
                try{
                    $update_Result = mysqli_query($connect, $update_Query);
                    
                    if($update_Result)
                    {
                        if(mysqli_affected_rows($connect) > 0)
                        {
                            echo 'Data Updated';
                        }else{
                            echo 'Data Not Updated';
                        }
                    }
                } catch (Exception $ex) {
                    echo 'Error Update '.$ex->getMessage();
                }
            }



        ?>

    <form id="t3" action="flight.php" method="post"><br><br>
        <input type="number" name = "ID" placeholder = "ID" value="<?php echo $ID;?>"><br><br>
        <input type="text" name = "departure_date" placeholder = "departure_date" value="<?php echo $departure_date;?>"><br><br>
        <input type="text" name = "Arrival_date" placeholder = "Arrival_date" value="<?php echo $Arrival_date;?>"><br><br>
        <input type="text" name = "departure_point" placeholder = "departure_point" value="<?php echo $departure_point;?>"><br><br>
        <input type="text" name = "destination" placeholder = "destination" value="<?php echo $destination;?>"><br><br>
        <input type="number" name = "id_airplane" placeholder = "id_airplane" value="<?php echo $id_airplane;?>"><br><br>
        
        <div>
            <input type="submit" name = "insert" value="Add">
            <input type="submit" name = "update" value="Update">
            <input type="submit" name = "delete" value="Delete">
        </div>
    </form>




    
</body>
</html>
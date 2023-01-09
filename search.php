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
        p{
            font-size: 25px;
            font-weight: bold;
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

            // Search
            if(isset($_POST['search']))
            {

                $data = getPosts();
                $search_Query = "SELECT * FROM `Ticket` WHERE `flight_id` IN (SELECT `ID` FROM `flight` WHERE `departure_point` = '$data[3]' AND `destination` = '$data[4]')";
                
                $search_Result = mysqli_query($connect, $search_Query);
                
                if($search_Result)
                {
                    if(mysqli_num_rows($search_Result))
                    {
            echo "<p>Знайдені квитки: </p>\n";        
            echo "<table>\n";
            echo "<thead><tr><th colspan = '3'>Квитки</tr></th></thead>\n";
            echo "<td>". "class" . "</td><td>" . "seat" . "</td><td>" . "cost" . "</td>" ;
            while ($result = mysqli_fetch_array($search_Result)){
            echo "<tr>\n";
            echo "<td>". $result['class'] . "</td><td>" . $result['seat'] . "</td><td>" . $result['cost'] . "</td>";
            echo "</tr>";
            }
            echo "</table>\n";
        
                    }else{
                        echo 'На жаль, такого рейсу не має(';
                    }
                } else{
                    echo 'Result Error';
                }
                
            }



        ?>
        <form id="t4" action="search.php" method="post"><br><br>
        <p id="p3">Пошук квитків</p>
        <input type="date" name = "departure_date" placeholder = "Дата відправки" value="<?php echo $departure_date;?>">
        <input type="date" name = "Arrival_date" placeholder = "Дата прибуття" value="<?php echo $Arrival_date;?>">
        <input type="text" name = "departure_point" placeholder = "Місце відправки" value="<?php echo $departure_point;?>">
        <input type="text" name = "destination" placeholder = "Місце прибуття" value="<?php echo $destination;?>">
        
        <div>
            <input id="i1" type="submit" name = "search" value="Search">
        </div>
    </form>




    
</body>
</html>
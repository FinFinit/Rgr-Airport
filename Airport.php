
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

    require_once 'connect.php';

        function getPosts()
            {
                $posts = array();
                $posts[0] = $_POST['id'];
                $posts[1] = $_POST['flight_id'];
                $posts[2] = $_POST['class'];
                $posts[3] = $_POST['seat'];
                $posts[4] = $_POST['cost'];
                $posts[5] = $_POST['id_cashreg'];
                $posts[6] = $_POST['baggage'];
                $posts[7] = $_POST['passenger_id'];
                return $posts;
            }


            $sql = "SELECT * FROM Ticket ORDER BY 'ASC' LIMIT 10";

                if (!$result = mysqli_query($connect, $sql)) {
                echo "Извините, возникла проблема в работе сайта.";
                exit;
            }

            echo "<table>\n";
            echo "<thead><tr><th colspan = '4'>Квитки</tr></th></thead>\n";
            echo "<td>" . "ID" . "</td><td>". "class" . "</td><td>" . "seat" . "</td><td>" . "cost" . "</td>" ;
                while ($Ticket = $result->fetch_assoc()) {
                    echo "<tr>\n";   
                    echo "<td>" . $Ticket['ID'] . "</td><td>". $Ticket['class'] . "</td><td>" . $Ticket['seat'] . "</td><td>" . $Ticket['cost'] . "</td>" ;
                    echo "</tr>";
                }

            echo "</table>\n";


            // Insert
                if(isset($_POST['insert'])){

                $data = getPosts();
                $insert_Query = "INSERT INTO `Ticket`(`id`, `flight_id`, `class`, `seat`, `cost`, `id_cashreg`, `baggage`, `passenger_id`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]','$data[4]', '$data[5]', '$data[6]', '$data[7]')";
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
                $delete_Query = "DELETE FROM `Ticket` WHERE `id` = $data[0]";
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
                $update_Query = "UPDATE `Ticket` SET `flight_id`='$data[1]', `class`='$data[2]',`seat`='$data[3]',`cost`='$data[4]', `id_cashreg`='$data[5]', `baggage`='$data[6]', `passenger_id`='$data[7]' WHERE `id` = $data[0]";
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

    <form id="t1" action="Airport.php" method="post"><br><br>
        <input type="number" name = "id" placeholder = "id" value="<?php echo $id;?>"><br><br>
        <input type="text" name = "class" placeholder = "class" value="<?php echo $class;?>"><br><br>
        <input type="number" name = "seat" placeholder = "seat" value="<?php echo $seat;?>"><br><br>
        <input type="number" name = "cost" placeholder = "cost" value="<?php echo $cost;?>"><br><br>
        <input type="number" name = "flight_id" placeholder = "flight_id" value="<?php echo $flight_id;?>"><br><br>
        <input type="number" name = "id_cashreg" placeholder = "id_cashreg" value="<?php echo $id_cashreg;?>"><br><br>
        <input type="number" name = "baggage" placeholder = "baggage" value="<?php echo $baggage;?>"><br><br>
        <input type="number" name = "passenger_id" placeholder = "passenger_id" value="<?php echo $passenger_id;?>"><br><br>
        
        <div>
            <input type="submit" name = "insert" value="Add">
            <input type="submit" name = "update" value="Update">
            <input type="submit" name = "delete" value="Delete">
        </div>
    </form>


    
</body>
</html>
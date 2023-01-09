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
        session_start();
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
        $Name = "";  //name
        $Email = ""; //id_storage


        function getPosts()
            {
                $posts = array();
                $posts[0] = $_POST['ID'];
                $posts[1] = $_POST['Name'];
                $posts[2] = $_POST['Email'];
                return $posts;
            }


            $sql = "SELECT * FROM Passenger ORDER BY 'ASC' LIMIT 10";

                if (!$result = mysqli_query($connect, $sql)) {
                echo "Извините, возникла проблема в работе сайта.";
                exit;
            }

            echo "<table>\n";
            echo "<thead><tr><th colspan = '4'>Пасажири</tr></th></thead>\n";
            echo "<td>" . "ID" . "</td><td>". "Name" . "</td><td>" . "Email" . "</td><td>";
                while ($Passenger = $result->fetch_assoc()) {
                    echo "<tr>\n";   
                    echo "<td>" . $Passenger['ID'] . "</td><td>". $Passenger['Name'] . "</td><td>" . $Passenger['Email'] . "</td><td>";
                    echo "</tr>";
                }

            echo "</table>\n";

        
            // Insert
            if(isset($_POST['insert']))
            {
            $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
            if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                echo 'Введено неправильний email';
            }
            else{

                $data = getPosts();
                $insert_Query = "INSERT INTO `Passenger`(`Name`, `Email`) VALUES ('$data[1]','$data[2]')";
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
                }}
            }


            // Delete
            if(isset($_POST['delete']))
            {
                $data = getPosts();
                $delete_Query = "DELETE FROM `Passenger` WHERE `ID` = $data[0]";
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
                $update_Query = "UPDATE `Passenger` SET `Name`='$data[1]',`Email`='$data[2]' WHERE `ID` = $data[0]";
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

    <form id="t2" action="Passenger.php" method="post"><br><br>
        <input type="number" name = "ID" placeholder = "ID" value="<?php echo $ID;?>"><br><br>
        <input type="text" name = "Name" placeholder = "Name" value="<?php echo $Name;?>"><br><br>
        <input type="text" name = "Email" placeholder = "Email" value="<?php echo $Email;?>"><br><br>
        
        <div>
            <input type="submit" name = "insert" value="Add">
            <input type="submit" name = "update" value="Update">
            <input type="submit" name = "delete" value="Delete">
        </div>
    </form>




    
</body>
</html>
<?php 

    // Database credentials
    $user = "a3004261_admin";
    $password = "Toiohomai1234";
    $database = "a3004261_scp";
    
    // Database connection PHP object
    $connection = new mysqli('localhost', $user, $password, $database) or die(mysqli_error($connection));
    
    // Return all records from database and save as variable
    $return = $connection->query("select * from scpItem") or die(mysqli_error($connection));
    
    // Create record function
    if(isset($_POST['submit'])){
        // Store values from the form here
        $item = mysqli_real_escape_string($connection, $_POST['item']);
        $objectclass = mysqli_real_escape_string($connection, $_POST['objectclass']);
        $image = mysqli_real_escape_string($connection, $_POST['image']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $containment = mysqli_real_escape_string($connection, $_POST['containment']);
        $referances = mysqli_real_escape_string($connection, $_POST['referances']);
        $notes = mysqli_real_escape_string($connection, $_POST['notes']);
        
        // Create insert command that will take form values and store in table
        $insert = "insert into scpItem(item, objectclass, image, description, containment, referances, notes)
        values('$item', '$objectclass', '$image', '$description', '$containment', '$referances', '$notes')";
        
        // Connect to the database and run $insert query
        if($connection->query($insert) === TRUE){
            echo "
                <style>
                    body{font-family: sans-serif;}
                    a {
                    background-color: #008CBA;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    }
                </style>
                <h1>Record added successfully</h1>
                <p><a href='index.php'>Back to index.php</a></p>
            ";
        }else{
            echo "
                <h1>Error submitting record</h1>
                <p>$connection->error</p>
                <p><a href='form.php'>Back to form.php</a></p>
            ";
        }
    }
    
    // Update record function
    if(isset($_POST['update'])){
        //Create variables from our posted form values
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $item = mysqli_real_escape_string($connection, $_POST['item']);
        $objectclass = mysqli_real_escape_string($connection, $_POST['objectclass']);
        $image = mysqli_real_escape_string($connection, $_POST['image']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $containment = mysqli_real_escape_string($connection, $_POST['containment']);
        $referances = mysqli_real_escape_string($connection, $_POST['referances']);
        $notes = mysqli_real_escape_string($connection, $_POST['notes']);
        
        // Update SQL command
        $update = "UPDATE scpItem SET item='$item', objectclass='$objectclass', image='$image', description='$description', containment='$containment', referances='$referances', notes='$notes' WHERE id='$id'";
        
        // Run update query and display success or error msg
        if($connection->query($update) === TRUE){
            echo "
                <style>
                    body{font-family: sans-serif;}
                    a {
                    background-color: #008CBA;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    }
                </style>
                <h1>Record Updated</h1>
                <p><a href='index.php'>Back to main page</a></p>
            ";
        }else{
             echo "
                <style>
                    body{font-family: sans-serif;}
                    a {
                    background-color: #008CBA;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    }
                </style>
                <h1>Error Updating Record</h1>
                <p>$connection->error</p>
                <p><a href='index.php'>Back to main page</a></p>
            ";
        }
    }
    
    // Delete record function
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        
        // Delete SQL command
        $del = "delete from scpItem where id=$id";
        
        if($connection->query($del) === TRUE){
            echo "
                <style>
                    body{font-family: sans-serif;}
                    a {
                    background-color: #008CBA;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    }
                </style>
                <h1>Record Deleted</h1>
                <p><a href='index.php'>Back to main page</a></p>
            ";
        }else{
            echo "
                <style>
                    body{font-family: sans-serif;}
                    a {
                    background-color: #008CBA;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    }
                </style>
                <h1>Error Deleting Record</h1>
                <p>$connection->error</p>
                <p><a href='index.php'>Back to main page</a></p>
            ";
        }
    }
    
?>
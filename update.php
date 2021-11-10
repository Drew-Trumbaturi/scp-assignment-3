<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Updating an SCP</title>
</head>

<body class="bg-dark my-4">
    <?php include "connection.php"; ?>
    
    <!-- Header -->
    <div class="container card" style="background-color: gray;">
        <div class="row">
            <div class="col-sm-3">
                <img src="images/scp-logo-signature.png" alt="">
            </div>

            <div class="col-sm-6 card" style="background: gray; border: none;">
                <h1 class="my-3 center">SCP Foundation</h1>
            </div>

            <div class="col-sm-3">
                <img src="images/scp-logo-signature.png" alt="" style="float: right;">
            </div>
        </div>
        <hr>

        <!-- Navbar -->
        <div class="topnav">
            <ul class="nav nav-pills m-1" id="pills-tab" role="tablist">
                <!-- Run PHP loop through the database and display item here to give us nav items -->
                <a href="index.php">Home</a>
                <?php foreach($return as $link): ?>
                    <li>
                        <a class="nav-link text-light" href="index.php?link='<?php echo $link['item']; ?>'"><?php echo $link['item']; ?></a>
                    </li>
                    
                <?php endforeach; ?>
                <a href="form.php">Add an SCP</a>
            </ul>
        </div>
        <hr>

        <!-- Main Content-->
        <hr>
        <h1 class="center text-light">Update SCP Below</h1>
        <hr>
        
        <?php 
            include "connection.php";
            
            $id = $_GET['update'];
            $return = $connection->query("SELECT * FROM scpItem WHERE id=$id") or die($connection->error);
            $column = $return->fetch_assoc();
        ?>

        <div class="row">
            <div class="col p-2">
                <div class="card p-2 rounded">
                    <form class="form-group" method="post" action="connection.php">
                        <input type="hidden" name="id" value="<?php echo $column['id']; ?>">
                        
                        <h1 class="p-3 bg-dark text-light rounded">Please fill out the form below to edit the SCP...</h1>

                        <label><b>Edit SCP Item #:</b></label>
                        <input type="text" name="item" class="form-control" value="<?php echo $column['item']; ?>">
                        
                        <label><b>SCP object class:</b></label>
                        <input type="text" name="objectclass" class="form-control" value="<?php echo $column['objectclass']; ?>">
                        
                        <label><b>SCP image:</b></label>
                        <input type="text" name="image" class="form-control" value="<?php echo $column['image']; ?>">
                        
                        <label><b>Description of the SCP:</b></label>
                        <textarea class="form-control" rows="5" name="description">value="<?php echo $column['description']; ?>"</textarea>
                        
                        <label><b>Special Containment Procedure of the SCP:</b></label>
                        <textarea class="form-control" rows="5" name="containment">value="<?php echo $column['containment']; ?>"</textarea>
                        
                        <label><b>Enter any additional references:</b></label>
                        <textarea class="form-control" rows="5" name="referances">value="<?php echo $column['referances']; ?>"</textarea>
                        
                        <label><b>Enter any additional notes:</b></label>
                        <textarea class="form-control" rows="5" name="notes">value="<?php echo $column['notes']; ?>"</textarea>
                        
                        <input type="submit" class="btn btn-success mt-2" name="submit" value="Update Record">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="index.php"><img src="images/scp-logo-signature.png" alt="scp-sml-logo"></a>
                <span class="text-muted">© 2021 SCP Foundation, Inc</span>
            </div>

            <ul class="nav justify-content-center pb-3 mb-3" style="font-size: large;">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="scp_catalog.php" class="nav-link px-2 text-muted">SCP Catalog</a></li>
                <li class="nav-item"><a href="guide_list.php" class="nav-link px-2 text-muted">Guide</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link px-2 text-muted">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">Contact</a></li>
            </ul>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="text-muted">Website Powered by Derkastan Ltd.</li>
                <li class="text-muted" style="font-size:smaller">*This website is a work of fiction and should not be
                    taken seriously.</li>
            </ul>
        </footer>
    </div>

    <script src="javascript/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
</body>

</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">

    <title>SCP Foundation</title>
  </head>
  <body class="bg-dark my-4">
    <!-- This is for the database to connect to our site through the connection.php file we made -->
    <?php include "connection.php"; ?>
    
    <!-- Header -->
    <div class="container card" style="background-color: gray;">
        <div class="row">
            <div class="col-sm-3">
                <img src="images/scp-logo-signature.png" alt="">
            </div>

            <div class="col-sm-6 card" style="background: gray; border: none;">
                <h1 class="my-3 center" href="index.php">SCP Foundation</h1>
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
    
    <!-- Main Body -->
        <div class="row">
            <div class="col">
                <?php
                
                    if(isset($_GET['link']))
                    {
                        $item = trim($_GET['link'], "'");
                        
                        // Run sql command to select record based on the GET value
                        $record = $connection->query("SELECT * FROM scpItem WHERE item='$item'") or die($connection->mysqli_error($connection));
                        
                        // Turn record into associative array
                        $array = $record->fetch_assoc();
    
                        
                        $item = $array['item'];
                        $objectclass = $array['objectclass'];
                        $image = $array['image'];
                        $description = $array['description'];
                        $containment = $array['containment'];
                        $referances = $array['referances'];
                        $notes = $array['notes'];
    
                        // Variables to hold out update and delete url strings
                        $id = $array['id'];
                        $update = "update.php?update=" . $id;
                        $delete = "connection.php?delete=" . $id;
                        
                        echo "
                        <div class='card mb-2 p-3'>
                              <div class='p-2 rounded bg-dark text-light center'>
                                  <h1><b>Item #: $item</b></h1>
                                  <h2><b>Object Class: $objectclass</b></h2>
                              </div>
                              <hr>
                              <p class='center'>
                                  <img src='$image'>
                              </p>
                              <hr>
                              <h3 class='p-2 rounded bg-dark text-light center'>Containment Procedures:</h3>
                              <hr>
                              <p>$containment</p>
                              <hr>
                              <h3 class='p-2 rounded bg-dark text-light center'>Description:</h3>
                              <hr>
                              <p>$description</p>
                              <hr>
                            ";
                        if($referances != "")
                        {
                            echo "
                                <h3 class='p-2 rounded bg-dark text-light center'>References:</h3>
                                <hr>
                                <p>$referances</p>
                                <hr>
                            "; 
                        }
                        if($notes != "")
                        {
                            echo "
                                <h3 class='p-2 rounded bg-dark text-light center'>Additional Notes:</h3>
                                <hr>
                                <p>$notes</p>
                                <hr>
                            "; 
                        }
                        
                        echo "
                            <br>
                            <p>
                                <a href='$update' class='btn btn-primary'>Update Record</a>
                                <a href='$delete' class='btn btn-danger'>Delete Record</a>
                            </p>
                        ";
                    }
                    else
                    {
                        //Main Index for when people first come to the site
                        echo "
                                <!-- Main Body -->
                                <div class='row'>
                                    <div class='col-md-4 center p-2'>
                                        <div class='card h-100 p-2 rounded'>
                                            <h2 class='p-2 rounded bg-dark text-light center'>Featured SCP Stories</h2>
                                            <hr>
                        
                                            <div class='card mb-4 p-1 rounded'>
                                                <h1 class='p-3 bg-dark text-light rounded'>SCP-002</h1>
                                                <p><img src='images/scp/SCP-002_main.png' alt='SCP-002_main'></p>
                                                <p>SCP-002 resembles a tumorous, fleshy growth with a volume of roughly 60 m³ (or 2000 ft³). An iron valve hatch on one side leads to its interior, which appears to be a standard low-rent apartment of...</p>
                                            </div>
                                            
                                            <div class='card mt-4 p-1 rounded'>
                                                <h1 class='p-3 bg-dark text-light rounded'>SCP-006</h1>
                                                <p><img src='images/scp/SCP-006.png' alt='SCP-006'></p>
                                                <p>SCP-006 is a very small spring located 60 km west of Astrakhan. Foundation Command was aware of its existence since the 19th century, but were unable to secure it until 1991 due to political reasons. On the spot of the spring, a chemical factory has been constructed as a disguise, with the majority of laborers under Foundation and/or Russian control. The liquid emitted from the spring has been chemically...</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='col-md-8 p-2'>
                                        <div class='card h-100 p-2 rounded'>
                                            <h1 class='p-2 rounded bg-dark text-light center'>Branches of the SCP Foundation</h1>
                                            <hr>
                        
                                            <div class='row'>
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-int.png' alt='scp-logo-int'>
                                                    <p><a href='http://scp-int.wikidot.com/'>SCP-Int</a></p>
                                                    <p>Internation Translation Archive</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-cn-400.png' alt='scp-logo-chi'>
                                                    <p><a href='http://scp-wiki-cn.wikidot.com/'>SCP基金会</a></p>
                                                    <p>SCP Chinese</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-fr-400.png' alt='scp-logo-fra'>
                                                    <p><a href='http://fondationscp.wikidot.com/'>Fondation SCP</a></p>
                                                    <p>SCP French</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-ru-400.png' alt='scp-logo-rus'>
                                                    <p><a href='http://scp-ru.wikidot.com/'>Фонд SCP</a></p>
                                                    <p>SCP Russian</p>
                                                </div>
                                            </div>
                        
                                            <div class='row'>
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-ko-400.png' alt='scp-logo-kor'>
                                                    <p><a href='http://ko.scp-wiki.net/'>SCP 재단</a></p>
                                                    <p>SCP Korean</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-pl-400.png' alt='scp-logo-pol'>
                                                    <p><a href='http://scp-wiki.net.pl/'>Fundacja SCP</a></p>
                                                    <p>SCP Polish</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-de-400.png' alt='scp-logo-ger'>
                                                    <p><a href='http://scp-wiki-de.wikidot.com/'>SCP auf Deutsch</a></p>
                                                    <p>SCP German</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-cs-400.png' alt='scp-logo-czk'>
                                                    <p><a href='http://scp-cs.wikidot.com/'>SCP Nadace</a></p>
                                                    <p>SCP Czech</p>
                                                </div>
                                            </div>
                        
                                            <div class='row'>
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-es-400.png' alt='scp-logo-spa'>
                                                    <p><a href='#'>La Fundación SCP</a></p>
                                                    <p>SCP Spanish</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-it-400.png' alt='scp-logo-pol'>
                                                    <p><a href='http://lafundacionscp.wikidot.com/'>SCP Ita</a></p>
                                                    <p>SCP Italian</p>
                                                </div>
                        
                                                <div class='col-sm-3  center'>
                                                    <img src='images/branches/scp-logo-jp-400.png' alt='scp-logo-ger'>
                                                    <p><a href='http://scp-jp.wikidot.com/'>SCP財団</a></p>
                                                    <p>SCP Japanese</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-pt-400.png' alt='scp-logo-czk'>
                                                    <p><a href='http://scp-pt-br.wikidot.com/'>Fundação SCP</a></p>
                                                    <p>SCP Portuguese</p>
                                                </div>
                                            </div>
                        
                                            <div class='row'>
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-ua-400.png' alt='scp-logo-spa'>
                                                    <p><a href='http://scp-ukrainian.wikidot.com/'>Фонд SCP</a></p>
                                                    <p>SCP Ukranian</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-zh-400.png' alt='scp-logo-pol'>
                                                    <p><a href='http://scp-zh-tr.wikidot.com/'>SCP基金會</a></p>
                                                    <p>SCP Traditional Chinese</p>
                                                </div>
                        
                                                <div class='col-sm-3 center'>
                                                    <img src='images/branches/scp-logo-th-400.png' alt='scp-logo-ger'>
                                                    <p><a href='http://scp-th.wikidot.com/'>สถาบัน SCP</a></p>
                                                    <p>SCP Thia</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";   
                    }
                ?>
            </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="row">
                <div class="col-sm-4 center">
                    <a href="index.php"><img src="images/scp-logo-signature.png" alt="scp-sml-logo"></a>  
                    <span class="text-muted">© 2021 SCP Foundation, Inc</span>
                </div>
                
                <div class="col-sm-4 center">
                    <ul class="nav justify-content-center pb-3 mb-3">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php">Home</a>
                        </li>
                
                        <?php foreach($return as $link): ?>
                            <li class="nav-item">
                                <a class="nav-link px-2 text-muted" href="index.php?link='<?php echo $link['item']; ?>'"><?php echo $link['item']; ?></a>
                            </li>
                    
                        <?php endforeach; ?>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-muted" href="form.php">Add an SCP</a>
                        </li>
                    </ul>
                </div>
                
                <div class="col-sm-4 center">
                    <ul class="nav justify-content-end list-unstyled d-flex">
                        <li class="text-muted">Website Powered by Derkastan Ltd.</li>
                        <li class="text-muted" style="font-size:smaller">*This website is a work of fiction and should not be taken seriously.</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>
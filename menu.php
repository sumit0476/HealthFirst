<?php
if(session_status()==1)session_start();
?>
<nav class="navbar navbar-dark navbar-expand-md bg-primary shadow-lg">
    <div class="container"><a class="navbar-brand" href="index.html">
                               <img class="rounded-circle img-fluid" src="assets/img/logo.jpg" style="width: 40px;margin-right: 10px;" />
    Real Time Medical Help</a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav">
                
                
                      <?php if(!isset($_SESSION['UID'])) {?>
                        <li class="nav-item"><a class="nav-link" role="button" href="search.html">Search</a></li>
                <li class="nav-item">
                    <a class="nav-link" role="button" href="Medicinesearch.html">Medicine Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="button" href="Quiz.html">Mental Health Checkup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="button" href="covidtest.html">Take Covid Test</a>
                </li>
                     <li class="nav-item"><a class="nav-link" role="button" href="login.html">Login</a></li>
                    
                     <?php } else {?>
                     <?php if($_SESSION['ProfileType']=='MedicalShop') {?>  
                <li class="nav-item"><a class="nav-link" href="updatemedicine.html">My Medicines</a></li>
                <li class="nav-item"><a class="nav-link" href="customerorder.html">Customer Orders</a></li>  <?php }?>
                      
                    <li class="nav-item"><a class="nav-link" href="myProfile.html">My Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="messages.html">Inbox</a></li>
                <li class="nav-item"><a class="nav-link" href="myorders.html">My Orders</a></li>                 
                <li class="nav-item"><a class="nav-link" >Welcome <?php echo $_SESSION["User"]["UserName"];?></a></li>

                    <li class="nav-item"><a class="nav-link" href="assets/phpscript/Logout.php">Logout</a></li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
<div class="container ">
      <a class="navbar-brand" href="<?php echo URL ?>/admins/dashboard">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault2" aria-controls="navbarsExampleDefault2" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault2">
        <ul class="navbar-nav mr-auto">
          
         
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Categories</a>
                <div  aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="<?php echo URL ?>/categories">All Categories</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/categories/add">Add Category</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Manufature</a>
                <div  aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="<?php echo URL ?>/manufactures">All Manufatures</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/manufactures/add">Add Manufature</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Products</a>
                <div  aria-labelledby="dropdown02">
                    <a  href="<?php echo URL ?>/products/all">All Products</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/products/add">Add Product</a>
                </div>
            </li>

            <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/orders">Orders</a>
                </li>
    
        </ul>
      </div>
      </div>
    </nav>
    <div class="container all">

    <?php require_once ROOTDIR ."/application/views/inc/messages.php" ?>

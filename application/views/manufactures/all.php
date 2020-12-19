
<?php //require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php //require_once ROOTDIR ."/application/views/inc/sidebar.php" ?>
    <div class="content">
        <div class="profile" style="max-width: 800px">
        <!-- <h5>Manufactures Management</h5>
        <input type="text" id='search_man' class="form-control w-50 mx-auto" placeholder="Search"> -->
        <h2 class="signup-heading">All Product</h2>
            <span style="width: 15%; line-height: 24px"><a href="<?php echo URL ?>/manufactures/add">Add new manfacture</a></span>
            <span>Search</span>
            <form style="display: inline-block;" action=""><input type="text" placeholder="enter a product"></form>

        <?php if($manufactures ){  ?>
        <table class="all-product">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                
                $i = 0;
                    foreach ( $manufactures as $man) { $i++ ?>                        
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                            <a href="<?php echo URL ?>/manufactures/show/<?php echo $man->man_id?>" class="text-danger">
                                <?php echo $man->man_name ?>
                            </a>
                        </td>
                        <td><?php echo $man->creator ?></td>
                            <td>
                                <a href="<?php echo URL ?>/manufactures/<?php echo $man->active == 0 ? 'activate':'inActivate'?>/<?php echo $man->man_id ?>">
                                    <?php echo $man->active == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>':'<i class="fa fa-thumbs-up  text-success"></i>' ?>
                                </a>
                            </td>
                        <td>
                        <form style="display: inline-block;"class='' action="<?php echo URL ?>/manufactures/delete/<?php echo $cat->cat_id?>" method='GET'>
                            <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                            <button type="submit" >Delete</button>
                        </form>
                            <button ><a href="<?php echo URL ?>/manufactures/edit/<?php echo $man->man_id?>" class="">Edit</a></button>
                        </td>
                    </tr>
                <?php } 
                
                ?>
            </tbody>
        </table>
        <?php }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
                    <?php  } ?>
        </div>          
    </div>
<style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>

<?php //require_once ROOT ."/views/inc/adminFooter.php" ?>
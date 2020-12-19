
<?php //require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php //require_once ROOTDIR ."/application/views/inc/sidebar.php" ?>
        <div class="content">
            <div class="profile">

                
                            <h2 class='signup-heading'>Edit Manufacture</h2>
                        <div class="admin-edit">
                            <form action="<?php echo URL?>/manufactures/update/<?php echo $manufacture->man_id ?>" method="POST">
    
                                <div class="">
                                    <input 
                                        value="<?php echo $manufacture->man_name ?>"
                                        type="text" 
                                        name="manufacture" 
                                        placeholder="Enter manufacture name" 
                                        class="form-control <?php echo  isset($errMan) ?  'is-invalid' : '' ?>"
                                    >
                                    <input type="hidden" name="man_id" value="<?php echo $manufacture->man_id ?>">
                                    <?php echo  isset($errMan) ?  '<div class="invalid-feedback">'.$errMan.'</div>' : '' ?>
                                </div>
                                <div class="">
                                    <textarea class="admin-textarea"
                                        name="description" 
                                        class="form-control <?php echo  isset($errDes) ?  'is-invalid' : '' ?>"
                                    ><?php echo $manufacture->description ?>
                                    </textarea>
                                    <?php echo  isset($errDes) ?  '<div class="invalid-feedback">'.$errDes.'</div>' : '' ?>
                                </div>

                                <div class="">
                                <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                                    <button class="admin-button"><a href='<?php echo URL ?>/manufactures/all' class="">
                                    
                                        Go Back
                                    </a></button>
                                    <input style="width: 30%;cursor: pointer;" type="submit" name='editManufacture' value='Edit' class="">
                                </div>

                            </form>
                        </div>
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
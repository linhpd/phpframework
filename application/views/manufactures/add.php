
<?php //require_once ROOT ."/views/inc/adminHeader.php"   ?>
<?php //require_once ROOTDIR . "/application/views/inc/sidebar.php" ?>

    <div class="content">

        <div class="profile" style="max-width: 500px;">
            <h2 class='signup-heading'>Add New Manufacture</h2>
        <div class="admin-edit">
            <form action="<?php echo URL ?>/manufactures/add" method="POST">

                <div class="form-group">
                    <input type="text" name="manufacture" placeholder="Enter manufacture name" class="form-control <?php echo isset($errMan) ? 'is-invalid' : '' ?>">
                    <?php echo isset($errMan) ? '<div class="invalid-feedback">' . $errMan . '</div>' : '' ?>
                </div>
                <div class="">
                    <textarea class="admin-textarea"
                        name="description" 
                        placeholder="Enter manufacture description" 
                        class="form-control <?php echo isset($errDes) ? 'is-invalid' : '' ?>"
                        ></textarea>
                        <?php echo isset($errDes) ? '<div class="invalid-feedback">' . $errDes . '</div>' : '' ?>
                </div>
                <div class="form-group">
                    <input type="hidden" name="csrf" value="<?php new Csrf();
                        echo Csrf::get()
                        ?>">
                        <button class="admin-button">
                    <a href='<?php echo URL ?>/manufactures/all' class="btn btn-sm btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        Go Back
                    </a>
                    </button>
                    <input style="width: 30%;" type="submit" name='addManufacture' value='Add'>
                </div>
</div>
            </form>
        </div>
    </div>
<style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
<?php
//require_once ROOT ."/views/inc/adminFooter.php" ?>
<?php if ($_SESSION['user_status'] == 'admin') : ?>
    <div class="admin">
        <div class="admin-left">
            <div class="logo">
                <a href="/">
                <div class="al">ALICE</div>
                </a>
                <span>Панель администрирования</span>
                </a>
            </div>
            <?php echo render('admin/navbar/navigation.php'); ?>
        </div>
        <div class="admin-right">
            <div class="admin-right-top">
                <div class="a-right-top-content">
                    <?php echo get_admin_title(); ?>
                </div>
            </div>
            <div class="admin-right-content">
                <?php require_once '../config/admin.php' ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
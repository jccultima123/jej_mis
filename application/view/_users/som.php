            <div>
                <button class="btn btn-danger btn-block" disabled="disabled">
                    You are logged in as: <?php echo $_SESSION['user_name'] ?>
                </button>
                <a href="<?php echo URL; ?>som" class="btn btn-danger btn-block">Go back to Sales And Order Management Module</a>
                <a href="<?php echo URL; ?>som/logout" class="btn btn-danger btn-block">LOGOUT as <?php echo $_SESSION['user_name'] ?></a>
            </div>
        </div>
        <div class="panel-footer">
            (C) JEJ CELLMANIA TRADING CORPORATION
        </div>
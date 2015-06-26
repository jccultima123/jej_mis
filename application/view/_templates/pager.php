<nav>
    <ul class="pager">
        <li>
            <?php
            if ($id > 1) {
                echo '<a href=?page=' . ($id - 1) . ' aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
            }
            ?>
        </li>
        <?php
            for ($i = 1; $i <= $total; $i++) {
                if ($i == $id) {
                    echo "<li class='active'><a>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='?page=" . $i . "'>" . $i . "</a></li>";
                }
            }
        ?>
        <li>
            <?php
            if ($id != $total) {
                if ($id == 0) {
                    echo '<a href=?page=' . ($id + 2) . ' aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                } else {
                    echo '<a href=?page=' . ($id + 1) . ' aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                }
            }
            ?>
        </li>
    </ul>
</nav>
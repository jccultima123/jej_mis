<?php foreach ($categories as $category) { ?>
    <?php if ($category->id == $sales->category) { ?>
        <option class="option" <?php echo 'selected'; ?> value="<?php echo $sales->category; ?>"><?php echo $category->name; ?></option>
    <?php } if ($category->id != $sales->category) { ?>
        <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
    <?php } ?>
<?php } ?>
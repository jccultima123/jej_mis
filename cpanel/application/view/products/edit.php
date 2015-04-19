<div class="container">
    <h2>Products</h2>
    <!-- add song form -->
    <div>
        <h3>Edit Product</h3>
        <span class="error_text"><?php $this->renderFeedbackMessages(); ?></span>
        <form action="<?php echo URL; ?>products/updateproduct" method="POST">
            <label>Artist</label><br />
            <input autofocus type="text" name="artist" value="<?php echo htmlspecialchars($song->artist, ENT_QUOTES, 'UTF-8'); ?>" required /><br /><br />
            <label>Track</label><br />
            <input type="text" name="track" value="<?php echo htmlspecialchars($song->track, ENT_QUOTES, 'UTF-8'); ?>" required /><br /><br />
            <label>Link</label><br />
            <input type="text" name="link" value="<?php echo htmlspecialchars($song->link, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <input type="hidden" name="song_id" value="<?php echo htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <input type="submit" name="submit_update_song" value="Update" />
        </form>
    </div>
</div>


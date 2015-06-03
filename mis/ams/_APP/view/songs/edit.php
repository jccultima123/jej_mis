<div class="container">
    <h2>You are in the View: application/view/song/edit.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div>
        <h3>Edit a song</h3>
        <?php if (isset($error)) { ?>
            <span class="error_text"><?php echo $error; ?></span>
            <br /><br />
        <?php } ?>
        <form action="<?php echo URL; ?>songs/updatesong" method="POST">
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


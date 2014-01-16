<?php
$options = get_option('rss-image-resize');

if (isset($_POST['save'])) {
    if (!check_admin_referer()) die('No hacking please');
    $options = stripslashes_deep($_POST['options']);
    update_option('rss-image-resize', $options);
}
?>
<div class="wrap">

    <form method="post">
        <?php wp_nonce_field(); ?>

        <h2>RSS Image Resize</h2>

        <table class="form-table">
            <tr>
                <th>Maximum Width</th>
                <td>
                    <input type="text" size="5" name="options[width]" value="<?php echo htmlspecialchars($options['width']); ?>"/>
                    <span>Input the maximum width for images in your RSS feed</span>
                </td>
            </tr>

        </table>

        <p class="submit"><input type="submit" name="save" value="Save" class="button button-submit"></p>

    </form>
</div>

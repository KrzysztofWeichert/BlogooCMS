<section>
    <h2>Edit home</h2>
    <form action="/?page=edit-home&id=<?php echo $params['home']['id'] ?>" method="post">
        <input type="text" name="meta-title" id="add_title" placeholder="Meta title"value="<?php echo $params['home']['meta_title'] ?>">
        <input type="text" name="meta-description" id="add_title" placeholder="Meta description" value="<?php echo $params['home']['meta_desc'] ?>">
        <textarea id="mytextarea" name="description"><?php echo $params['home']['description'] ?></textarea>
        <input type="submit" value="Save" class="submit">
    </form>
</section>
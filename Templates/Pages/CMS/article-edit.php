<section>
    <h2>Edit an article</h2>
    <form action="/?page=edit&id=<?php echo $params['article']['id'] ?>" method="post">
        <input type="text" name="title" id="add_title" placeholder="Article title" value="<?php echo $params['article']['title'] ?>">
        <input type="text" name="meta-title" id="add_title" placeholder="Meta title"value="<?php echo $params['article']['meta_title'] ?>">
        <input type="text" name="meta-description" id="add_title" placeholder="Meta description" value="<?php echo $params['article']['meta_desc'] ?>">
        <textarea id="mytextarea" name="description"><?php echo $params['article']['description'] ?></textarea>
        <input type="submit" value="Save" class="submit">
    </form>
</section>
<?php if (!empty($params['errorMessage'])) { ?>
    <div class="alert alert-error">
        <?= $params['errorMessage']?>
    </div>
<?php } ?>

<form action="index.php?r=tasks-edit" method="post">
    <fieldset>
        <legend>Task</legend>


        <div class="control-group <?php if ($params['nameError']) {echo 'error';}?>">
            <label>Name</label>
            <input name="name" type="text" placeholder="Input name" value="<?= $params['name']?>"
                   <?php if($params['isEdit']) { ?>disabled<?php }?>>
        </div>
        <div class="control-group <?php if ($params['emailError']) {echo 'error';}?>">
            <label>Email</label>
            <input name="email" type="email" placeholder="Input email" value="<?= $params['email']?>"
                   <?php if($params['isEdit']) { ?>disabled<?php }?>>
        </div>

        <div class="control-group <?php if ($params['textError']) {echo 'error';}?>">
            <label>Task Text</label>
            <textarea name="text" placeholder="Input task text"><?php if (isset($params['text'])) { ?><?= $params['text']?><?php } ?></textarea>
        </div>
        <?php if($params['isEdit']) { ?>
            <div class="control-group <?php if ($params['emailError']) {echo 'error';}?>">
                <label>Done</label>
                <input name="did" type="checkbox" value="1" <?php if ($params['did']) { ?>checked="checked"<?php } ?>>
            </div>
            <input type="hidden" name="email" value="<?= $params['email']?>">
            <input type="hidden" name="isEdit" value="true">
        <?php } ?>

        <button type="submit" class="btn">Save</button>
    </fieldset>
</form>
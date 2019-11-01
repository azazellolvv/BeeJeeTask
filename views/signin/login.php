<?php if (!empty($params['errorMessage'])){ ?>
    <div class="alert alert-error">
        <?= $params['errorMessage']?>
    </div>
<?php } ?>

<form class="form-horizontal" action="/index.php?r=signin-login" method="post">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Name</label>
        <div class="controls">
            <input name="name" type="text" id="inputEmail" placeholder="Email" value="<?= $params['name'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <input name="password" type="password" id="inputPassword" placeholder="Password" value="<?= $params['password'] ?>">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Sign in</button>
        </div>
    </div>
</form>
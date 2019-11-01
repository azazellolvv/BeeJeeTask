<?php if (!empty($params['successMessage'])){ ?>
    <div class="alert alert-success">
        <?= $params['successMessage']?>
    </div>
<?php } ?>
<?php if (!empty($params['errorMessage'])){ ?>
    <div class="alert alert-error">
        <?= $params['errorMessage']?>
    </div>
<?php } ?>

<p>
    <a href="/index.php?r=tasks-edit" class="btn btn-success">Create task</a>
</p>
<table class="table table-bordered table-striped">
    <thead>
        <td>
            <a href="/index.php?r=tasks-index&sort=<?= $params['sort'] == 'name-asc' ? 'name-desc' : 'name-asc'
            ?>&page=<?= $params['page'] ?>">Name <?= $params['sort'] == 'name-asc' ? '(a-z)' :
                    ($params['sort'] == 'name-desc' ? '(z-a)' : '') ?></a>
        </td>
        <td>
            <a href="/index.php?r=tasks-index&sort=<?= $params['sort'] == 'email-asc' ? 'email-desc' : 'email-asc'
            ?>&page=<?= $params['page'] ?>">Email <?= $params['sort'] == 'email-asc' ? '(a-z)' :
                    ($params['sort'] == 'email-desc' ? '(z-a)' : '') ?></a>
        </td>
        <td>
            <a href="/index.php?r=tasks-index&sort=<?= $params['sort'] == 'text-asc' ? 'text-desc' : 'text-asc'
            ?>&page=<?= $params['page'] ?>">Text <?= $params['sort'] == 'text-asc' ? '(a-z)' :
                    ($params['sort'] == 'text-desc' ? '(z-a)' : '') ?></a>
        </td>
        <td>
            <a href="/index.php?r=tasks-index&sort=<?= $params['sort'] == 'did-asc' ? 'did-desc' : 'did-asc'
            ?>&page=<?= $params['page'] ?>">Done <?= $params['sort'] == 'did-asc' ? '(a-z)' :
                    ($params['sort'] == 'did-desc' ? '(z-a)' : '') ?></a>
        </td>
        <td>
            <a href="/index.php?r=tasks-index&sort=<?= $params['sort'] == 'adminEdit-asc' ? 'adminEdit-desc'
                : 'adminEdit-asc' ?>&page=<?= $params['page'] ?>">AdminEdit <?= $params['sort'] == 'adminEdit-asc' ? '(a-z)' :
                    ($params['sort'] == 'adminEdit-desc' ? '(z-a)' : '') ?></a>
        </td>
        <?php if($_SESSION['adminLogin']) { ?>
            <td>&nbsp;</td>
        <?php } ?>

    </thead>
    <tbody>
        <?php foreach($params['taskList'] as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['name'])?></td>
            <td><?= htmlspecialchars($task['email'])?></td>
            <td><?= htmlspecialchars($task['text'])?></td>
            <td><?= htmlspecialchars($task['did'])?></td>
            <td><?= htmlspecialchars($task['adminEdit'])?></td>
            <?php if($_SESSION['adminLogin']) { ?>
                <td><a href="/index.php?r=tasks-edit&email=<?= htmlspecialchars($task['email']) ?>">Edit</a></td>
            <?php } ?>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div class="pagination">
    <ul>
        <li>
            <?php if ($params['page'] == 1) {?>
                <span>Prev</span>
            <?php } else {?>
                <a disabled href="/index.php?r=tasks-index&sort=<?= $params['sort'] ?>&page=<?=
                ($params['page'] - 1) ?>">Prev</a>
            <?php } ?>
        </li>

        <?php for ($i = 1; $i <= $params['pageCount']; $i++){?>
            <li <?php if($i == $params['page']) {?>class="active" <?php }
            ?>><a href="/index.php?r=tasks-index&sort=<?= $params['sort'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php }?>

        <li>
            <?php if ($params['pageCount'] == $params['page']) {?>
                <span>Next</span>
            <?php } else {?>
                <a href="/index.php?r=tasks-index&sort=<?= $params['pageCount'] ?>&page=<?=
                ($params['page'] + 1) ?>">Next</a></li>
            <?php } ?>
    </ul>
</div>
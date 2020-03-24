<!doctype html>
<html lang="en">
  <head>
      <? require_once(VIEW_ROOT . 'base/head.php') ?>
  </head>
  <body>
    <? require_once(VIEW_ROOT . 'base/header.php') ?>
    <main role="main">
      <? require_once(VIEW_ROOT . 'base/jumbotron.php') ?>
      <div class="container">
        <div class="col-md-12">
        <?php if(!empty($response['messages'])) : ?>
            <? foreach($response['messages'] as $message) : ?>
              <div class="alert alert-success" role="alert">
                <?=$message?>
              </div>
            <? endforeach ?>
          <?php endif; ?>

          <?php if(!empty($response['errors'])) : ?>
            <? foreach($response['errors'] as $message) : ?>
              <div class="alert alert-danger" role="alert">
                <?=$message?>
              </div>
            <? endforeach ?>
          <?php endif; ?>

          <?php if(!empty($response['data'])) : ?>
            <table id="tasks" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th><?=LANG_NAME?></th>
                  <th><?=LANG_EMAIL?></th>
                  <th><?=LANG_DESCRIPTION?></th>
                  <th><?=LANG_STATUS?></th>
                  <? if($_SESSION['is_auth']) : ?>
                    <th><?=LANG_ACTION?></th>
                  <? endif; ?>
                </tr>
              </thead>
              <tbody>
                <? foreach($response['data'] as $row) : ?>
                    <tr>
                      <td><?=$row['name']?></td>
                      <td><?=$row['email']?></td>
                      <td><?=$row['description']?></td>
                      <td>
                        <?=$row['status']?>
                        <?=$row['is_admin_edit'] ? ' & ' . $row['is_admin_edit'] : '' ?>
                      </td>
                      <? if($_SESSION['is_auth']) : ?>
                        <td>
                          <a class="btn btn-primary btn-sm" href="?page=edit&id=<?=$row['id']?>" role="button"><?=LANG_EDIT?></a>
                          <a class="btn btn-primary btn-sm" href="?mode=performed-task&id=<?=$row['id']?>" role="button"><?=LANG_PERFORMER?></a>
                        </td>
                      <? endif; ?>
                    </tr>
                  <? endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th><?=LANG_NAME?></th>
                  <th><?=LANG_EMAIL?></th>
                  <th><?=LANG_DESCRIPTION?></th>
                  <th><?=LANG_STATUS?></th>
                  <? if($_SESSION['is_auth']) : ?>
                    <th><?=LANG_ACTION?></th>
                  <? endif; ?>
                </tr>
              </tfoot>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <? require_once(VIEW_ROOT . 'base/modals.php') ?>
  </body>
  <? require_once(VIEW_ROOT . 'base/footer.php') ?>
</html>
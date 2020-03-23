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
          <table id="tasks" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th><?=LANG_NAME?></th>
                <th><?=LANG_EMAIL?></th>
                <th><?=LANG_STATUS?></th>
              </tr>
            </thead>
            <tbody>
              <? foreach($data as $row) : ?>
                  <tr>
                    <td><?=$row['name']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['status']?></td>
                  </tr>
                <? endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th><?=LANG_NAME?></th>
                <th><?=LANG_EMAIL?></th>
                <th><?=LANG_STATUS?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <? require_once(VIEW_ROOT . 'base/modals.php') ?>
  </body>
  <? require_once(VIEW_ROOT . 'base/footer.php') ?>
</html>
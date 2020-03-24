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
        <a class="btn btn-primary btn-sm" href="/" role="button"><?=LANG_BACK?></a><br /><br />
          <?php if(!empty($response['messages'])) : ?>
            <? foreach($response['messages'] as $message) : ?>
              <div class="alert alert-success" role="alert">
                <?=$message?>
              </div>
            <? endforeach ?>
          <?php endif; ?>

          <?php if(!empty($response['errors'])) : ?>
            <? foreach($response['errors'] as $error) : ?>
              <div class="alert alert-danger" role="alert">
                <?=$error?>
              </div>
            <? endforeach ?>
          <?php endif; ?>

          <?php if(!empty($response['data'])) : ?>
            <form action="?mode=update-task" method="POST" class="needs-validation" novalidate>
              <input type="hidden" name="id" value="<?=$response['data']['id']?>">
              <div class="form-row">
                <div class="col-md-4">
                    <label for="validationName"><?=LANG_NAME?></label>
                    <input type="text" class="form-control" id="validationName" name="name" value="<?=$response['data']['name']?>" required>
                </div>
                <div class="col-md-4">
                    <label for="validationEmail"><?=LANG_EMAIL?></label>
                    <input type="text" class="form-control" id="validationEmail" name="email" value="<?=$response['data']['email']?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
                <div class="col-md-4">
                    <label for="validationStatus"><?=LANG_STATUS?></label>
                    <select class="form-control" id="validationStatus" name="status" required>
                      <option value='1' <?=($response['data']['status'] == LANG_STATUS_NEW) ? 'selected' : '' ?>><?=LANG_STATUS_NEW?></option>
                      <option value='2'<?=($response['data']['status'] == LANG_STATUS_IN_PROGRESS) ? 'selected' : '' ?>><?=LANG_STATUS_IN_PROGRESS?></option>
                      <option value='3'<?=($response['data']['status'] == LANG_STATUS_DONE) ? 'selected' : '' ?>><?=LANG_STATUS_DONE?></option>
                    </select>
                </div>
              </div>
              <div class="form-row">
                  <div class="col-md-12">
                      <label for="validationDescription"><?=LANG_DESCRIPTION?></label>
                      <textarea class="form-control" id="validationDescription" name="description" required><?=$response['data']['description']?></textarea>
                  </div>
              </div>

              <br />
              <button type="submit" class="btn btn-primary btn-sm"><?=LANG_SAVE_CHANGES?></button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <? require_once(VIEW_ROOT . 'base/modals.php') ?>
  </body>
  <? require_once(VIEW_ROOT . 'base/footer.php') ?>
</html>
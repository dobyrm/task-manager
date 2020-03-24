<!doctype html>
<html lang="en">
  <head>
      <? require_once(VIEW_ROOT . 'base/login_head.php') ?>
  </head>
  <body class="text-center">
    <form action="?mode=authentication" method="POST" class="form-signin needs-validation" novalidate>
      <h1 class="h3 mb-3 font-weight-normal"><?=LANG_PLEASE_SIGN_IN?></h1>
      <?php if(!empty($response['errors'])) : ?>
        <? foreach($response['errors'] as $error) : ?>
          <div class="alert alert-danger" role="alert">
            <?=$error?>
          </div>
        <? endforeach ?>
      <?php endif; ?>
      <label for="inputLogin" class="sr-only"><?=LANG_LOGIN?></label>
      <input type="text" id="inputLogin" class="form-control" name="login" placeholder="<?=LANG_LOGIN?>" required autofocus=""> <br />
      <label for="inputPassword" class="sr-only"><?=LANG_PASSWORD?></label>
      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="<?=LANG_PASSWORD?>" required>
      <button class="btn btn-lg btn-primary btn-block btn-sm" type="submit"><?=LANG_SIGN_IN?></button>
      <a href="/" class="btn btn-lg btn-primary btn-block btn-sm"><?=LANG_TO_HOME_PAGE?></a>
    </form>
  </body>
  <? require_once(VIEW_ROOT . 'base/footer.php') ?>
</html>
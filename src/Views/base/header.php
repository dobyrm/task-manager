<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <strong><?=LANG_SHORT_APP_NAME?></strong>
            </a>
            <? if($_SESSION['is_auth']) : ?>
                <a href="?mode=logout" class="text-white"><?=LANG_LOGOUT?></a>
            <? else : ?>
                <a href="?page=login" class="text-white"><?=LANG_LOGIN?></a>
            <? endif; ?>
        </div>
    </div>
</header>
<?php
    // Начало сессии
    session_start();
    // Подключение файла с настройками базы данных
    include 'db_connection.php';
    // Выборка всех постов из базы данных, отсортированных по id в обратном порядке
    $posts = $mysql->query("SELECT * FROM posts ORDER BY id DESC");
    // Подключение шапки сайта
    require_once 'header.php'
?>

<main>
    <div class="contatiner">
        <div class="main-row">
            <h1 class="h1 main-row__title">Учебные материалы</h1>
            <?php
                // Если пользователь авторизован, показать кнопку добавления поста
                if(isset($_SESSION['name'])){?>
                    <a href="/add_post.php" class="btn-add-link">
                        <button class="main-row__button">
                            <div class="button-plus"><img src="assets/img/+.svg" alt=""></div>
                            <div class="button-text">Добавить пост</div>
                        </button>
                    </a>
                <?php }
                // Если пользователь не авторизован, показать заблокированную кнопку добавления поста
                else{?>
                    <button class="main-row__button btn-denied" data-tooltip="Вы не авторизованы!">
                        <div class="button-plus"><img src="assets/img/+.svg" alt=""></div>
                        <div class="button-text">Добавить пост</div>
                    </button>
                <?php }
            ?>
        </div>
        <div class="cards">
            <?php
                // Цикл для вывода всех постов
                foreach ($posts as $row) { ?>
                    <div class="card">
                        <p class="card__date">Добавлено <?=date("d",strtotime($row['data_load']))?> декабря</p>
                        <p class="card__title"><?=$row['title']?></p>
                        <a href="postDetail.php?post=<?=$row['id']?>" class="card__button">Подробнее</a>
                    </div>
                    <!-- Версия карточки для мобильных устройств -->
                    <a href="postDetail.php?post=<?=$row['id']?>" class="card card-mobile">
                        <p class="card__date card__date-mobile"><img src="assets/img/clock.svg" alt=""> <?=date("d.m.y",strtotime($row['data_load']))?></p>
                        <p class="card__title"><?=$row['title']?></p>
                    </a>
            <?php }
            ?>
        </div>
        <button class="show-more">Показать ещё</button>
    </div>
</main>

<?php
    // Подключение подвала сайта
    require_once 'footer.php'
?>



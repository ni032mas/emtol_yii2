<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kartik\nav\NavX;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\bootstrap\Carousel;
use evgeniyrru\yii2slick\Slick;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'EMTOL',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/login']];
    } else {
        $session = Yii::$app->session;
        $session->open();
        if (isset($_SESSION['cart.qty'])) {
            $qty = (int)$_SESSION['cart.qty'];
        } else {
            $qty = 0;
        }
        $cartName = !$qty ? 'Корзина' : 'Корзина(' . $qty . ')';
        $menuItems[] = [
            'label' => $cartName,
            'url' => ['#'],
            'linkOptions' => [
                'onclick' => 'return getCart()',
                'id' => 'navbar-cart',
            ],
        ];
//        $menuItems[] = [
//            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
//            'url' => ['/logout'],
//            'linkOptions' => ['data-method' => 'post']
//        ];
        $menuItems[] =
            ['label' => Yii::$app->user->identity->username,
                'items' => [
                    ['label' => 'Личный кабинет', 'url' => '/my-dashboard/orders'],
                    ['label' => 'Заказы', 'url' => '/my-dashboard/orders'],
                    '<li class="divider"></li>',
                    [
                        'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ]];
    }
    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    //    echo Nav::widget([
    //        'options' => ['class' => 'navbar-nav navbar-right'],
    //        'items' => $menuItems,
    //    ]);
    NavBar::end();

    ?>
    <div class="container<?= isset($this->params['fluid']) && $this->params['fluid'] ? '-fluid' : '' ?>">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; EMTOL <?= date('Y') ?></p>
    </div>
</footer>
<?php
Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button> 
                <a href="' . Url::to(['cart/view']) . '" class="btn btn-primary">Оформить заказ</a>
                <button type="button" class="btn btn-danger" onClick = "clearCart()">Очистить корзину</button>',
    'id' => 'cart-modal',
]);
Modal::end();
Modal::begin([
    'header' => '<h2>Заказ</h2>',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>',
    'id' => 'orders-item-modal',
]);
Modal::end();

Modal::begin([
    'header' => '<h2>Подверждение</h2>',
    'size' => 'modal-sm',
    'footer' => '<a href="' . Url::to(['/orders/cancel']) . '" data-id="" class="btn btn-danger btn-cancel-order">Отменить заказ</a>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>',
    'id' => 'orders-cancel-modal',
]);
Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

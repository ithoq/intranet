<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
                'brandLabel' => Html::img(Yii::$app->homeUrl . 'img/logo_copservir.png', ['width' => '140', 'height' => 'auto']),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            $opciones = [];
            if (Yii::$app->user->isGuest) {
                $opciones = [['label' => 'Iniciar sesión', 'url' => ['/site/login']]];
            } else {
                $opciones = [
                    ['label' => 'Mi cuenta', 'url' => '#'],
                    ['label' => 'Mi calendario', 'url' => '#'],
                    ['label' => 'Mis publicaciones', 'url' => '#'],
                    '<li class="divider"></li>',
                    // '<li class="dropdown-header">Dropdown Header</li>',
                    ['label' => 'Salir ' . Yii::$app->user->identity->alias, 'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']]
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    !Yii::$app->user->isGuest ?['label' => Yii::$app->user->identity->alias, 'url' => ['#']] : ['label' => ''],
                    ['label' => 'Mi cuenta', //Html::tag('span', '', ['class' => "glyphicon glyphicon-cog"]),
                        'items' => $opciones,
                    ],
                ],
            ]);
            NavBar::end();
            ?>


            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

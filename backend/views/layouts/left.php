<?php
use common\models\ContactForm;
use common\models\Callback;

$contact_count = ContactForm::find()->where(['status'=>0])->count();
$callback_count = Callback::find()->where(['status'=>0])->count();

if($contact_count == 0)
    $contact_count = '';

if($callback_count == 0)
    $callback_count = '';

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->email?></p>

                <a href="/">Перейти на главную</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Пользователи', 'icon' => 'fas fa-user', 'url' => ['/users/users']],
                    ['label' => 'Аккаунты', 'icon' => 'fas fa-user-circle', 'url' => ['/accounts/accounts']],
                    ['label' => 'Работы', 'icon' => 'fas fa-briefcase', 'url' => ['/works/works']],
                    ['label' => 'Очередь', 'icon' => 'fas fa-list-ol', 'url' => ['/queue/queue']],
                    ['label' => 'Youtube очередь', 'icon' => 'fas fa-list-ol', 'url' => ['/youtube/youtube']],
                    ['label' => Yii::t('balance', 'Balance'), 'icon' => 'fas fa-shopping-basket', 'url' => ['/balance/balance']],
                    ['label' => 'Заявки', 'icon' => 'fas fa-clipboard-list', 'url' => ['/orders/contact'] ,'template'=>'<a href="{url}">{icon}<span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">'.$contact_count.'</small></span></a>'],
                    ['label' => 'Звонки', 'icon' => 'fas fa-phone', 'url' => ['/orders/callback'] ,'template'=>'<a href="{url}">{icon}<span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">'.$callback_count.'</small></span></a>'],
                    ['label' => 'Тарифы', 'icon' => 'fas fa-suitcase', 'url' => ['/cases/cases']],
                    ['label' => Yii::t('history', 'History'), 'icon' => 'fas fa-history', 'url' => ['/history/history']],
                    ['label' => 'Настройки', 'icon' => 'fas fa-cogs', 'url' => ['/settings/settings']],
                    ['label' => 'SEO', 'icon' => 'fas fa-globe', 'url' => ['/settings/seo']],
                    ['label' => Yii::t('reviews', 'Reviews'), 'icon' => 'fas fa-comments', 'url' => ['/reviews/reviews']],
                    ['label' => 'Соц. сети', 'icon' => 'fas fa-share-square', 'url' => ['/page-socials/page-social']],
                    ['label' => 'Услуги в соц. сети', 'icon' => 'fas fa-share-square', 'url' => ['/page-socials-services/page-socials-services']],
                   // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                   // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>

    </section>

</aside>

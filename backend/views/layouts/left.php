<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    ['label' => 'Аккаунты', 'icon' => 'fas fa-user-circle', 'url' => ['/accounts/accounts']],
                    ['label' => 'Очередь', 'icon' => 'fas fa-list-ol', 'url' => ['/queue/queue']],
                    ['label' => 'Настройки', 'icon' => 'fas fa-cogs', 'url' => ['/settings/settings']],
                    ['label' => 'Работы', 'icon' => 'fas fa-briefcase', 'url' => ['/works/works']],
                    ['label' => Yii::t('balance', 'Balance'), 'icon' => 'fas fa-shopping-basket', 'url' => ['/balance/balance']],
                    ['label' => 'Cases', 'icon' => 'fas fa-suitcase', 'url' => ['/cases/cases']],
                    ['label' => Yii::t('orders', 'Orders'), 'icon' => 'fas fa-shopping-cart', 'url' => ['/orders/orders']],
<<<<<<< HEAD
	                ['label' => Yii::t('reviews', 'Reviews'), 'icon' => 'fas fa-shopping-cart', 'url' => ['/reviews/reviews']],
=======
                    ['label' => 'Заявки', 'icon' => 'fas fa-shopping-cart', 'url' => ['/orders/contact']],
>>>>>>> 27e1a9dc47898ecd1e8059ed36f2920cf4ab51ac
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

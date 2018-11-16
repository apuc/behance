
<div class="header__phone-wrap">
    <img class="header__phone-img" src="/images/phone.png" alt="" role="presentation"/>
    <div class="header__phone-info">
            <?php if($account): ?>
                <span class="header__phone-name"><?= $account->display_name; ?></span>
                <div class="header__phone-main">
                    <div class="header__phone-avatar"><img src="<?= $account->image; ?>"/>
                    </div>
                    <div class="d-flex flex-column"><span>Graphic designer</span><span>Craft Group</span><span class="c-gray mt-1"><i class="fa fa-map-marker"></i>Moscow, Russian Federation</span><span class="c-gray mt-1 text-underline">https://vk.com/kotya_ka</span></div>
                </div>
                <div class="d-flex justify-content-between pr-2">
                    <div class="header__phone-btn header__phone-btn-blue">Следить
                    </div>
                    <div class="header__phone-btn"><i class="fa fa-envelope"></i> Сообщение
                    </div>
                </div>
                <div class="d-flex mb-4"><span class="pr-4">Инф</span><span class="pr-4">Проекты</span><span class="pr-4">Коллекции</span><span>Стена</span></div>
            <?php else: ?>
              <?= $this->render('phone-account-default')?>
            <?php endif; // if($phone_account)?>
            <?php if($works): ?>
                <div class="d-flex flex-wrap">
                    <?php foreach($works as $w): ?>
                        <div class="header__phone-item">
                            <div class="header__phone-item-img"><img src="<?=$w->image?>"/>
                            </div><span class="font-weight-bold mb-2"><?=$w->name?></span><span><?= $account->display_name; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <?= $this->render('phone-works-default')?>
            <?php endif;// if($phone_works)?>
    </div>
</div>

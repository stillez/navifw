<?php foreach($this->cates as $cate):?>
    <h2><?=$cate->title?></h2>
    <div class="items">
        <?php foreach($this->news[$cate->id] as $item):?>
            <div class="item">
                <div class="item-image">
                    <img src="<?=Navi::$baseUrl?>/publics/images/news/<?=$item->image?>" />
                </div>
                <div class="item-title">
                    <a href="<?=Navi::$baseUrl?>/news/detail/<?=$item->alias?>"><?=$item->title?></a>
                </div>
                <div class="item-price">
                    <span><?=$item->price?> VND</span>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endforeach;?>
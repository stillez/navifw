
<div class="table">
    <form action="" method="post">
        <table class="items" border="1">
            <thead>
                <tr>
                    <th class="checkbox-column"><input type="checkbox" value="1" name="ids_all" id="ids_all" /></th>
                    <th><a class="sort-link" href="">ID</a></th>
                    <th><a class="sort-link" href="">Title</a></th>
                    <th><a class="sort-link" href="">Image</a></th>
                    <th><a class="sort-link" href="">Status</a></th>
                    <th><a class="sort-link" href="">Updated</a></th>
                   <!-- <th><a class="sort-link" href="">Inserter</a></th> -->
                    <th class="button-column">
 
                    </th>
                </tr>
                <tr class="filters">
                    <td>&nbsp;</td>
                    <td class="ct id"><input name="News[id]" type="text" value="<?=$this->model->id?>" /></td>
                    <td><input name="News[title]" type="text" value="<?=$this->model->title?>" /></td>
                    <td>&nbsp;</td>
                    <td><input name="News[status]" type="text" /></td>
                    <td>&nbsp;</td>
                    <td><input name="News[updated]" type="text" /></td>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="hidden" /></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->models as $item):?>
                <tr>
                    <td class="ct id"><input value="1" id="ids_0" type="checkbox" name="" /></td>
                    <td class="ct id"><?=$item->id?></td>
                    <td><a target="_blank" href="<?=Navi::$baseUrl?>/../<?=$item->alias?>.html"><?=$item->title?></a></td>
                    <td class="ct"><img src="<?=Navi::$resourceUrl?>/images/products/thumbs/<?=$item->image?>" /></td>
                    <td class="ct"><a href="<?=Navi::$baseUrl?>/<?=Navi::$controller?>/status/<?=$item->id?>" class="status <?=$item->status != 0 ? 'enable' : ''?>"></a></td>
                    <td class="ct"><?=$item->updated?></td>
                   <!-- <td class="ct"><a href=""><?=$item->fullname?></a></td> -->
                    <td class="ct act">
                        <a href="<?=Navi::$baseUrl?>/<?=Navi::$controller?>/edit/<?=$item->id?>"><i>Edit</i></a>
                        <a class="delete" href="<?=Navi::$baseUrl?>/<?=Navi::$controller?>/delete/<?=$item->id?>"><i>Del</i></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </form>
</div>
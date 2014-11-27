<div class="form">
    <form method="post" enctype="multipart/form-data">
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('id')?></label>
            </div>
            <div class="input">
                <input type="text" name="Products[id]" class="txt-form alias$Products[alias]" value="<?=htmlspecialchars($this->model->id)?>" />
                <div class="error"><?=$this->model->getError('title')?></div>
            </div>
        </div>
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('title')?></label>
            </div>
            <div class="input">
                <input type="text" name="Products[title]" class="txt-form alias$Products[alias]" value="<?=htmlspecialchars($this->model->title)?>" />
                <div class="error"><?=$this->model->getError('title')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('alias')?></label>
            </div>
            <div class="input">
                <input type="text" name="Products[alias]" class="txt-form" value="<?=$this->model->alias?>" />
                <div class="error"><?=$this->model->getError('alias')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('cate_id')?></label>
            </div>
            <div class="input">
                <select name="Products[cate_id]" class="sel-form">
                    <?php foreach(Cates::model()->findAll('status = 1') as $item):?>
                        <option value="<?=$item->id?>" <?=$this->model->cate_id == $item->id ? 'selected="selected"' : ''?>>
                            <?=$item->title?>
                        </option>
                    <?php endforeach;?>
                </select>
                <div class="error"><?=$this->model->getError('cate_id')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('status')?></label>
            </div>
            <div class="input">
                <select name="Products[status]" class="sel-form">
                    <?php foreach(Constant::$status as $key => $value):?>
                        <option value="<?=$key?>" <?=$this->model->status == $key ? 'selected="selected"' : ''?>>
                            <?=$value?>
                        </option>
                    <?php endforeach;?>
                </select>
                <div class="error"><?=$this->model->getError('status')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('seo_title')?></label>
            </div>
            <div class="input">
                <input type="text" name="Products[seo_title]" class="txt-form" value="<?=htmlspecialchars($this->model->seo_title)?>" />
                <div class="error"><?=$this->model->getError('seo_title')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('seo_keywords')?></label>
            </div>
            <div class="input">
                <textarea name="Products[seo_keywords]" class="txtare-form"><?=$this->model->seo_keywords?></textarea>
                <div class="error"><?=$this->model->getError('seo_keywords')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('seo_description')?></label>
            </div>
            <div class="input">
                <textarea name="Products[seo_description]" class="txtare-form"><?=$this->model->seo_description?></textarea>
                <div class="error"><?=$this->model->getError('seo_description')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">
                <label class="lbl-form" for=""><?=$this->model->getLabel('description')?></label>
            </div>
            <div class="input">
                <textarea class="ckeditor txtare-form" name="Products[description]"><?=htmlspecialchars($this->model->description)?></textarea>
                <div class="error"><?=$this->model->getError('description')?></div>
            </div>
        </div>
         
        <div class="controls">
            <div class="label">&nbsp;</div>
            <div class="input">
                <input type="submit" class="bnt-form" value="Save" />
            </div>
        </div>
    </form>
</div>
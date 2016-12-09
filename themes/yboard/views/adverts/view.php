<?php
/* @var $this SiteController */
/* @var $model Bulletin */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array();
if ($model->category->parent)
    $this->breadcrumbs[$model->category->parent->name] = array('site/category', 'id' => $model->category->parent->id);
$this->breadcrumbs[$model->category->name] = array('site/category', 'id' => $model->category->id);
?>
<div class="advert_full">
    <div class='title' style='padding:0px 3px;'><?= $model->name ?> 
        <div style='float:right'>
            <a href='<?
            echo Yii::app()->createUrl('adverts/update', array('id' => $model->id));
            ?>'><i class='fa fa-pencil'></i></a> 
            <a href='javascript:void(0)' onclick='setFavoriteAdv("<?= $model->id ?>", this)'><i class='fa fa-bookmark-o'></i></a>
        </div>
    </div>
    <div class='date'>
        <span><a href='<? echo Yii::app()->createUrl('user/view', array('id' => $model->user->id))
            ?>'>
                <i class='fa fa-user'></i><?= $model->user->username ?>
            </a></span>  
        <span><i class='fa fa-clock-o'></i><?= PeopleDate::format($model->created_at) ?></span> 
        <span><i class='fa fa-eye'></i><?= $model->views ?></span>
        <div style='float:right; margin-top:-6px; '> 
            <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="link" 
                 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir"></div>
        </div>
    </div>
    <div class="content">
        <div>
            <?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $model)); ?>
        </div>
        <div>
            <?php $model->youtube_id ? $this->widget('ext.Yiitube', array('v' => $model->youtube_id, 'size' => 'small')) : '';
            ?>
        </div>
        <div>
            <?php echo str_replace("\n", "<br/>", $model->text); ?>
        </div>

        <br/>

        <div class='attributes'>

            <? if (sizeof($model->fields) > 0 and is_array($model->fields)) { ?>
                <?php
                if (is_array($model->fields))
                    foreach ($model->fields as $f_name => $field) {
                        echo "<div>"
                        . Yii::app()->params['categories'][$model->category_id]
                        ['fields'][$f_name]['name'] . " - " . $field
                        . "</div>";
                    }
                ?>

            <? } ?>
        </div>
        <div class='price'><?= t('Price') ?> - 
            <? if ($model->price) { ?>
                <?= $model->price ?> ( <?= Yii::app()->params['currency'][$model->currency] ?> ) 
                <a href='javascript:void(0);' onclick='show_converter()' > открыть конвертор </a>
                <div class='price_converter'><?
                    foreach (Yii::app()->params['currency'] as $cn => $cur) {
                        printf("%.2f", $model->price / Yii::app()->params['exchange'][$model->currency] * Yii::app()->params['exchange'][$cn]);
                        echo " " . $cur . " | ";
                    }
                    ?></div>
                <?
            } else {
                echo "<i>" . t('Not set') . "</i>";
            }
            ?>
        </div>

        <div> 
            <span> Контакты : </span> <br/>
            <?= $model->user->phone ?> <br/>
            <?= $model->user->email ?> <br/>
            <?= $model->user->skype ?> 
        </div>
        <? if (Yii::app()->user->id != $model->user->id) { ?>
            <div>
                <?php
                echo $this->renderPartial('/messages/_form', array(
                    'model' => $mes_model,
                    'receiver' => $data->user->id)
                );
                ?>
            </div>

            <?
        }
        ?>

        <div class='related'> <span>Похожие объявления: </span>

            <?
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataRel,
                'itemView' => '_view_short',
                'ajaxUpdate' => false,
            ));
            ?>
        </div>
    </div>

</div>
<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\brand\index.html";i:1554169792;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DsMall(php)B2B2C商城系统后台</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/css/admin.css">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/iconfont/iconfont.css">
        <link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.css">
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery-2.1.4.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.validate.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.cookie.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/common.js"></script>
        <script src="<?php echo ADMIN_SITE_ROOT; ?>/js/admin.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/perfect-scrollbar.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/layer/layer.js"></script>
        <script type="text/javascript">
            var BASESITEROOT = "<?php echo BASE_SITE_ROOT; ?>";
            var ADMINSITEROOT = "<?php echo ADMIN_SITE_ROOT; ?>";
            var BASESITEURL = "<?php echo BASE_SITE_URL; ?>";
            var HOMESITEURL = "<?php echo HOME_SITE_URL; ?>";
            var ADMINSITEURL = "<?php echo ADMIN_SITE_URL; ?>";
        </script>
    </head>
    <body>
        <div id="append_parent"></div>
        <div id="ajaxwaitid"></div>









<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3><?php echo \think\Lang::get('ds_brand_manage'); ?></h3>
                <h5></h5>
            </div>
            <?php if($admin_item): ?>
<ul class="tab-base ds-row">
    <?php if(is_array($admin_item) || $admin_item instanceof \think\Collection || $admin_item instanceof \think\Paginator): if( count($admin_item)==0 ) : echo "" ;else: foreach($admin_item as $key=>$item): ?>
    <li><a href="<?php echo $item['url']; ?>" <?php if($item['name'] == $curitem): ?>class="current"<?php endif; ?>><span><?php echo $item['text']; ?></span></a></li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php endif; ?>
        </div>
    </div>

    <form method="get" name="formSearch" id="formSearch">
        <div class="ds-search-form">
            <dl>
                <dt><?php echo \think\Lang::get('brand_index_name'); ?></dt>
                <dd><input class="txt" name="search_brand_name" id="search_brand_name" value="<?php echo $search_brand_name; ?>" type="text"></dd>
            </dl>
            <dl>
                <dt><?php echo \think\Lang::get('brand_index_class'); ?></dt>
                <dd><input class="txt" name="search_brand_class" id="search_brand_class" value="<?php echo $search_brand_class; ?>" type="text"></dd>
            </dl>
            <div class="btn_group">
                 <a href="javascript:document.formSearch.submit();" class="btn " title="<?php echo \think\Lang::get('ds_query'); ?>"><?php echo \think\Lang::get('ds_query'); ?></a>
                 <?php if($search_brand_name != '' || $search_brand_class != ''): ?>
                    <a class="btn" href="<?php echo url('Brand/index'); ?>" title="<?php echo \think\Lang::get('ds_cancel_search'); ?>"><span><?php echo \think\Lang::get('ds_cancel_search'); ?></span></a>
                 <?php endif; ?>
                 <a class="btn btn-default" href="<?php echo url('Brand/export_step1'); ?>" id="dsexport"><span><?php echo \think\Lang::get('ds_export'); ?>Excel</span></a>
            </div>
        </div>
        <input type="hidden" value="" name="export">
    </form>
    
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom">
            <h4 title="<?php echo \think\Lang::get('ds_explanation_tip'); ?>"><?php echo \think\Lang::get('ds_explanation'); ?></h4>
            <span id="explanationZoom" title="<?php echo \think\Lang::get('ds_explanation_close'); ?>" class="arrow"></span>
        </div>
        <ul>
            <li><?php echo \think\Lang::get('brand_index_help1'); ?></li>
            <li><?php echo \think\Lang::get('brand_index_help2'); ?></li>
            <li><?php echo \think\Lang::get('brand_index_help3'); ?></li>
        </ul>
    </div>
        <table class="ds-default-table">
            <thead>
            <tr class="thead">
                <th class="w24"></th>
                <th class="w48"><?php echo \think\Lang::get('ds_sort'); ?></th>
                <th><?php echo \think\Lang::get('brand_index_name'); ?></th>
                <th class="w150"><?php echo \think\Lang::get('brand_index_class'); ?></th>
                <th class="w150"><?php echo \think\Lang::get('brand_index_pic_sign'); ?></th>
                <th class="w48 align-center"><?php echo \think\Lang::get('brand_showtype'); ?></th>
                <th class="w48 align-center"><?php echo \think\Lang::get('ds_recommend'); ?></th>
                <th class="w120 align-center"><?php echo \think\Lang::get('ds_handle'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(!(empty($brand_list) || (($brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator ) && $brand_list->isEmpty()))): if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$v): ?>
            <tr class="hover edit" id="ds_row_<?php echo $v['brand_id']; ?>">
                <td><input value="<?php echo $v['brand_id']; ?>" class="checkitem" type="checkbox" name="del_brand_id[]"></td>
                <td class="sort"><span class="editable"  ds_type="inline_edit" fieldname="brand_sort" ajax_branch='brand_sort' fieldid="<?php echo $v['brand_id']; ?>" datatype="pint" maxvalue="255" title="<?php echo \think\Lang::get('ds_editable'); ?>"><?php echo $v['brand_sort']; ?></span></td>
                <td class="name"><span class="editable" ds_type="inline_edit" fieldname="brand_name" ajax_branch='brand_name' fieldid="<?php echo $v['brand_id']; ?>" required="1"  title="<?php echo \think\Lang::get('ds_editable'); ?>"><?php echo $v['brand_name']; ?></span></td>
                <td class="class"><?php echo $v['brand_class']; ?></td>
                <td class="picture"><div class="brand-picture"><img src="<?php echo brand_image($v['brand_pic']); ?>" style="height:30px;"/></div></td>
                <td class="align-center"><?php echo $v['show_type']==1?lang('brand_showtype_text'):lang('brand_showtype_img'); ?></td>
                <td class="align-center yes-onoff">
                    <?php if($v['brand_recommend'] == '0'): ?>
                    <a href="JavaScript:void(0);" class="disabled" ajax_branch='brand_recommend' ds_type="inline_edit" fieldname="brand_recommend" fieldid="<?php echo $v['brand_id']; ?>" fieldvalue="0" title="<?php echo \think\Lang::get('ds_editable'); ?>"><img src="<?php echo ADMIN_SITE_ROOT; ?>/images/treetable/transparent.gif"></a>
                    <?php else: ?>
                    <a href="JavaScript:void(0);" class="enabled" ajax_branch='brand_recommend' ds_type="inline_edit" fieldname="brand_recommend" fieldid="<?php echo $v['brand_id']; ?>" fieldvalue="1"  title="<?php echo \think\Lang::get('ds_editable'); ?>"><img src="<?php echo ADMIN_SITE_ROOT; ?>/images/treetable/transparent.gif"></a>
                   <?php endif; ?>
                </td>
                <td class="align-center">
                    <a href="javascript:dsLayerOpen('<?php echo url('Brand/brand_edit',['brand_id'=>$v['brand_id']]); ?>','<?php echo \think\Lang::get('ds_edit'); ?>-<?php echo $v['brand_name']; ?>')" class="dsui-btn-edit"><i class="iconfont"></i><?php echo \think\Lang::get('ds_edit'); ?></a>
                    <a href="javascript:dsLayerConfirm('<?php echo url('Brand/brand_del',['brand_id'=>$v['brand_id']]); ?>','<?php echo \think\Lang::get('ds_ensure_del'); ?>',<?php echo $v['brand_id']; ?>)" class="dsui-btn-del"><i class="iconfont"></i><?php echo \think\Lang::get('ds_del'); ?></a>
                </td>
            </tr>
           <?php endforeach; endif; else: echo "" ;endif; else: ?>
            <tr class="no_data">
                <td colspan="10"><?php echo \think\Lang::get('ds_no_record'); ?></td>
            </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
                <?php if(!(empty($brand_list) || (($brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator ) && $brand_list->isEmpty()))): ?>
                <tr colspan="15" class="tfoot">
                    <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
                    <td colspan="16">
                        <label for="checkallBottom"><?php echo \think\Lang::get('ds_select_all'); ?></label>
                        &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn btn-small" onclick="submit_delete_batch()"><span><?php echo \think\Lang::get('ds_del'); ?></span></a>
                    </td>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
        <?php echo $showpage; ?>
    <div class="clear"></div>
</div>
<script type="text/javascript" src="<?php echo ADMIN_SITE_ROOT; ?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
    function submit_delete(ids_str){
        _uri = ADMINSITEURL+"/Brand/brand_del.html?brand_id=" + ids_str;
        dsLayerConfirm(_uri,'<?php echo \think\Lang::get('ds_ensure_del'); ?>');
    }
</script>

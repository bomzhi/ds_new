<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\brand\brand_apply.html";i:1545196757;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
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
                <h3><?php echo \think\Lang::get('ds_welcome'); ?></h3>
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

    <div class="fixed-empty"></div>
    <form method="get" name="formSearch">
        <div class="ds-search-form">
            <dl>
                <dt><?php echo \think\Lang::get('brand_index_name'); ?></dt>
                <dd><input class="txt" name="search_brand_name" id="search_brand_name" value="<?php echo \think\Request::instance()->param('search_brand_name'); ?>" type="text"></dd>
            </dl>
            <dl>
                <dt><?php echo \think\Lang::get('brand_index_class'); ?></dt>
                <dd><input class="txt" name="search_brand_class" id="search_brand_class" value="<?php echo \think\Request::instance()->param('search_brand_class'); ?>" type="text"></dd>
            </dl>
            <div class="btn_group">
                <a href="javascript:document.formSearch.submit();" class="btn " title="<?php echo \think\Lang::get('ds_query'); ?>"><?php echo \think\Lang::get('ds_query'); ?></a>
                <?php if($filtered): ?>
                <a href="<?php echo url('Brand/brand_apply'); ?>" class="btn btn-default" title="<?php echo \think\Lang::get('ds_cancel'); ?>"><?php echo \think\Lang::get('ds_cancel'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <form method='post' id="form_brand">
        <input type="hidden" name="type" id="type" value="" />
        <table class="ds-default-table">
            <thead>
                <tr class="space">
                    <th colspan="15"><?php echo \think\Lang::get('ds_list'); ?></th>
                </tr>
                <tr class="thead">
                    <th>&nbsp;</th>
                    <th><?php echo \think\Lang::get('brand_index_name'); ?></th>
                    <th><?php echo \think\Lang::get('brand_index_class'); ?></th>
                    <th><?php echo \think\Lang::get('brand_index_pic_sign'); ?></th>
                    <th class="align-center"><?php echo \think\Lang::get('ds_handle'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!(empty($brand_list) || (($brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator ) && $brand_list->isEmpty()))): if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$v): ?>
                <tr class="hover edit">
                    <td class="w24">
                        <input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $v['brand_id']; ?>">
                    </td>
                    <td class="name w270"><span><?php echo $v['brand_name']; ?></span></td>
                    <td class="class"><?php echo $v['brand_class']; ?></td>
                    <td>
                        <div class="brand-picture">
                            <img src="<?php echo brand_image($v['brand_pic']); ?>" style="height: 35px">
                        </div>
                    </td>
                    <td class="w96 align-center">
                        <a href="<?php echo url('Brand/brand_apply_set',['state'=>'pass','brand_id'=>$v['brand_id']]); ?>" class="dsui-btn-add"><i class="iconfont"></i><?php echo \think\Lang::get('ds_pass'); ?></a>
                        <a href="<?php echo url('Brand/brand_apply_set',['state'=>'refuse','brand_id'=>$v['brand_id']]); ?>" class="dsui-btn-del"><i class="iconfont"></i><?php echo \think\Lang::get('ds_del'); ?></a>
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
                <tr class="tfoot">
                    <td>
                        <input type="checkbox" class="checkall" id="checkallBottom">
                    </td>
                    <td colspan="16">
                        <label for="checkallBottom"><?php echo \think\Lang::get('ds_select_all'); ?></label>
                        &nbsp;&nbsp;
                        <a href="JavaScript:void(0);" class="btn btn-small" onclick="submit_form('pass');" name="id">
                            <span><?php echo \think\Lang::get('ds_pass'); ?></span>
                        </a>
                        <a href="JavaScript:void(0);" class="btn btn-small" onclick="submit_form('refuse');" name="id">
                            <span><?php echo \think\Lang::get('ds_del'); ?></span>
                        </a>
                        <?php echo $show_page; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </form>
</div>
<script>
    function submit_form(type) {
        layer.confirm('<?php echo \think\Lang::get('brand_apply_handle_ensure'); ?>？', {
            btn: ['确定', '取消'],
            title: false,
        }, function () {
            $('#type').val(type);
            $('#form_brand').submit();
        });
    }
</script>
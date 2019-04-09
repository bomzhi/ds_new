<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\goodsalbum\index.html";i:1545196757;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
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
                <h3>相册列表</h3>
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

    <form method="get" name="formSearch">
        <div class="ds-search-form">
            <dl>
                <dt><?php echo \think\Lang::get('g_album_keyword'); ?></dt>
                <dd><input class="txt" name="keyword" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" type="text"></dd>
            </dl>
            <div class="btn_group">
                <?php if($store_name!=''  && !empty($albumclass_list)): ?>
                <a class="btn btn-mini" target="_blank" href="<?php echo url('home/Store/index',['store_id'=>$albumclass_list['0']['store_id']]); ?>"><span><?php echo $store_name; ?></span></a>
                <?php endif; ?>
                <a href="javascript:document.formSearch.submit();" class="btn " title="<?php echo \think\Lang::get('ds_query'); ?>"><?php echo \think\Lang::get('ds_query'); ?></a>
                <?php if($filtered): ?>
                <a href="<?php echo url('Goodsalbum/index'); ?>" class="btn btn-default" title="<?php echo \think\Lang::get('ds_cancel'); ?>"><?php echo \think\Lang::get('ds_cancel'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </form>
    
  <div class="explanation" id="explanation">
      <div class="title" id="checkZoom">
          <h4 title="<?php echo \think\Lang::get('ds_explanation_tip'); ?>"><?php echo \think\Lang::get('ds_explanation'); ?></h4>
          <span id="explanationZoom" title="<?php echo \think\Lang::get('ds_explanation_close'); ?>" class="arrow"></span>
      </div>
      <ul>
          <li><?php echo \think\Lang::get('g_album_del_tips'); ?></li>
      </ul>
  </div>
    
    
    <form method='post' id="picForm" name="picForm">
        <table class="ds-default-table">
            <thead>
            <tr class="thead">
                <th class="w24"></th>
                <th class="w72 center"><?php echo \think\Lang::get('g_album_fmian'); ?></th>
                <th class="w270"><?php echo \think\Lang::get('g_album_one'); ?></th>
                <th class="w270"><?php echo \think\Lang::get('g_album_shop'); ?></th>
                <th class="w270"><?php echo \think\Lang::get('g_album_pic_count'); ?></th>
                <th class="align-center"><?php echo \think\Lang::get('ds_handle'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(!(empty($albumclass_list) || (($albumclass_list instanceof \think\Collection || $albumclass_list instanceof \think\Paginator ) && $albumclass_list->isEmpty()))): if(is_array($albumclass_list) || $albumclass_list instanceof \think\Collection || $albumclass_list instanceof \think\Paginator): if( count($albumclass_list)==0 ) : echo "" ;else: foreach($albumclass_list as $key=>$v): ?>
            <tr class="hover edit" id="ds_row_<?php echo $v['aclass_id']; ?>">
                <td><input value="<?php echo $v['aclass_id']; ?>" class="checkitem" type="checkbox" name="aclass_id[]"></td>
                <td>
                    <?php if(!(empty($v['aclass_cover']) || (($v['aclass_cover'] instanceof \think\Collection || $v['aclass_cover'] instanceof \think\Paginator ) && $v['aclass_cover']->isEmpty()))): ?>
                    <img src="<?php echo goods_cthumb($v['aclass_cover'],240,$v['store_id']); ?>" onload="javascript:ResizeImage(this,70,70);">
                    <?php else: ?>
                    <img src="<?php echo UPLOAD_SITE_URL; ?>/<?php echo default_goodsimage(0); ?>" onload="javascript:ResizeImage(this,70,70);">
                    <?php endif; ?>
                </td>
                <td class="name"><?php echo $v['aclass_name']; ?></td>
                <td class="class"><a href="<?php echo url('home/Store/index',['store_id'=>$v['store_id']]); ?>" ><?php echo $v['store_name']; ?></td>
                <td><?php echo !empty($pic_count[$v['aclass_id']])?$pic_count[$v['aclass_id']] : 0; ?></td>
                <td class="align-center">
                    <a href="<?php echo url('Goodsalbum/pic_list',['aclass_id'=>$v['aclass_id']]); ?>" class="dsui-btn-view"><i class="iconfont"></i><?php echo \think\Lang::get('g_album_pic_one'); ?></a>
                    <a href="javascript:dsLayerConfirm('<?php echo url('Goodsalbum/aclass_del',['aclass_id'=>$v['aclass_id']]); ?>','<?php echo \think\Lang::get('ds_ensure_del'); ?>',<?php echo $v['aclass_id']; ?>)" class="dsui-btn-del"><i class="iconfont"></i><?php echo \think\Lang::get('ds_del'); ?></a></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; else: ?>
            <tr class="no_data">
                <td colspan="10"><?php echo \think\Lang::get('ds_no_record'); ?></td>
            </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <?php if(!(empty($albumclass_list) || (($albumclass_list instanceof \think\Collection || $albumclass_list instanceof \think\Paginator ) && $albumclass_list->isEmpty()))): ?>
            <tr colspan="15" class="tfoot">
                <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
                <td colspan="16"><label for="checkallBottom"><?php echo \think\Lang::get('ds_select_all'); ?></label>
                    &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn btn-small" onclick="submit_delete_batch()"><span><?php echo \think\Lang::get('ds_del'); ?></span></a>
                </td>
            </tr>
            <?php endif; ?>
            </tfoot>
        </table>
        <?php echo $show_page; ?>
    </form>
</div>

<script type="text/javascript">
    function submit_delete(ids_str){
        _uri = ADMINSITEURL+"/Goodsalbum/aclass_del.html?aclass_id=" + ids_str;
        dsLayerConfirm(_uri,'<?php echo \think\Lang::get('ds_ensure_del'); ?>');
    }
</script>
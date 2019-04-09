<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:100:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\goodsclass\goods_class_edit.html";i:1545196757;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
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
                <h3><?php echo \think\Lang::get('goods_class_index_class'); ?></h3>
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

    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom">
            <h4 title="<?php echo \think\Lang::get('ds_explanation_tip'); ?>"><?php echo \think\Lang::get('ds_explanation'); ?></h4>
            <span id="explanationZoom" title="<?php echo \think\Lang::get('ds_explanation_close'); ?>" class="arrow"></span>
        </div>
        <ul>
            <li><?php echo \think\Lang::get('goods_class_edit_prompts_one'); ?></li>
            <li><?php echo \think\Lang::get('goods_class_edit_prompts_two'); ?></li>
        </ul>
    </div>
    

    <form id="goods_class_form" name="goodsClassForm" enctype="multipart/form-data" method="post">
        <input type="hidden" name="gc_id" value="<?php echo $class_array['gc_id']; ?>" />
        <input type="hidden" name="gc_parent_id" id="gc_parent_id" value="<?php echo $class_array['gc_parent_id']; ?>" />
        <input type="hidden" name="old_type_id" value="<?php echo $class_array['type_id']; ?>">
        <table class="ds-default-table">
            <tbody>
                <tr class="noborder">
                    <td colspan="2" class="required"><label class="gc_name validation" for="gc_name"><?php echo \think\Lang::get('goods_class_index_name'); ?>:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" maxlength="20" value="<?php echo $class_array['gc_name']; ?>" name="gc_name" id="gc_name" class="txt"></td>
                    <td class="vatop tips"></td>
                </tr>
                <tr>
                    <td colspan="2" class="required"><label for="parent_id"><?php echo \think\Lang::get('goods_class_add_sup_class'); ?>:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><select name="gc_parent_id" id="gc_parent_id">
                            <option value="<?php echo $class_array['gc_parent_id']; ?>">不更改所属分类（更改下拉）</option>
                            <?php if(!(empty($parent_list) || (($parent_list instanceof \think\Collection || $parent_list instanceof \think\Paginator ) && $parent_list->isEmpty()))): if(is_array($parent_list) || $parent_list instanceof \think\Collection || $parent_list instanceof \think\Paginator): if( count($parent_list)==0 ) : echo "" ;else: foreach($parent_list as $k=>$v): ?>
                            <option <?php if($class_array['gc_parent_id'] == $v['gc_id']): ?>selected='selected'<?php endif; ?> value="<?php echo $v['gc_id']; ?>"><?php echo $v['gc_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </select></td>
                    <td class="vatop tips"><span style="color:#ff0000">注意：不要把顶级分类整体移动到其它分类下；</span> <?php echo \think\Lang::get('goods_class_add_sup_class_notice'); ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="required"><label for="pic">分类图片:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform">
                        <?php if(!(empty($class_array['pic']) || (($class_array['pic'] instanceof \think\Collection || $class_array['pic'] instanceof \think\Paginator ) && $class_array['pic']->isEmpty()))): ?>
                        <span class="type-file-show"><img class="show_image" src="<?php echo ADMIN_SITE_ROOT; ?>/images/preview.png">
                            <div class="type-file-preview"><img src="<?php echo $class_array['pic']; ?>"></div>
                        </span>
                        <?php endif; ?>
                        <span class="type-file-box">
                            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
                            <input type='button' name='button' id='button1' value='' class='type-file-button' />
                            <input name="pic" type="file" class="type-file-file" id="pic" size="30" hidefocus="true" ds_type="change_pic">
                        </span>
                    </td>
                    <td class="vatop tips">第一级图标显示在首页，建议用16px * 16px。二级分类图标显示在电脑端商品分类页，建议用70px * 70px。三级分类图标显示在手机端商品分类页，建议用60px * 60px</td>
                </tr>
                <tr>
                    <td colspan="2" class="required"><label>发布虚拟商品:</label>
                        <span>
                            <label for="t_gc_virtual">
                                <input id="t_gc_virtual" type="checkbox" class="checkbox" checked="checked" value="1" name="t_gc_virtual">
                                关联到子分类</label>
                        </span></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><label><input type="checkbox" name="gc_virtual" id="gc_virtual" value="1" <?php if($class_array['gc_virtual'] == 1): ?>checked<?php endif; ?>>允许</label></td>
                    <td class="vatop tips">勾选允许发布虚拟商品后，在发布该分类的商品时可选择交易类型为“虚拟兑换码”形式。</td>
                </tr>
                <tr>
                    <td colspan="2" class="required"><label class="validation">分佣比例:</label>
                        <span>
                            <label for="t_commis_rate">
                                <input id="t_commis_rate" class="checkbox" type="checkbox" checked="checked" value="1" name="t_commis_rate">
                                关联到子分类</label>
                        </span></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input id="commis_rate" class="w60" type="text" value="<?php echo $class_array['commis_rate']; ?>" name="commis_rate">
                        % </td>
                    <td class="vatop tips">必须为0-100的整数</td>
                </tr>
                
   
                <tr>
                    <td colspan="2" class="required"><label class="validation"><?php echo \think\Lang::get('goods_class_add_type'); ?>:</label>
                        <span>
                            <label for="t_associated">
                                <input class="checkbox" type="checkbox" name="t_associated" value="1" checked="checked" id="t_associated" />
                                <?php echo \think\Lang::get('goods_class_edit_related_to_subclass'); ?></label>
                        </span></td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" id="gcategory">
                        <select class="class-select">
                            <option value="0"><?php echo \think\Lang::get('ds_please_choose'); ?>...</option>
                            <?php if(!(empty($gc_list) || (($gc_list instanceof \think\Collection || $gc_list instanceof \think\Paginator ) && $gc_list->isEmpty()))): if(is_array($gc_list) || $gc_list instanceof \think\Collection || $gc_list instanceof \think\Paginator): if( count($gc_list)==0 ) : echo "" ;else: foreach($gc_list as $k=>$v): if($v['gc_parent_id'] == 0): ?>
                            <option value="<?php echo $v['gc_id']; ?>"><?php echo $v['gc_name']; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                        </select><?php echo \think\Lang::get('ds_quickly_targeted'); ?></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="hidden" name="t_name" id="t_name" value="<?php echo $class_array['type_name']; ?>" />
                        <input type="hidden" name="t_sign" id="t_sign" value="" />
                        <div id="type_div" class="goods-sort-type">
                            <div class="container">
                                <dl>
                                    <dd>
                                        <input type="radio" name="t_id" value="0" <?php if($class_array['type_id']): ?>checked="checked"<?php endif; ?> /><?php echo \think\Lang::get('goods_class_null_type'); ?>
                                    </dd>
                                </dl>
                                <?php if(!(empty($type_list) || (($type_list instanceof \think\Collection || $type_list instanceof \think\Paginator ) && $type_list->isEmpty()))): if(is_array($type_list) || $type_list instanceof \think\Collection || $type_list instanceof \think\Paginator): if( count($type_list)==0 ) : echo "" ;else: foreach($type_list as $k=>$val): if(!(empty($val['type']) || (($val['type'] instanceof \think\Collection || $val['type'] instanceof \think\Paginator ) && $val['type']->isEmpty()))): ?>
                                <dl>
                                    <dt id="type_dt_<?php echo $k; ?>"><?php echo $val['name']; ?></dt>
                                     <?php if(is_array($val['type']) || $val['type'] instanceof \think\Collection || $val['type'] instanceof \think\Paginator): if( count($val['type'])==0 ) : echo "" ;else: foreach($val['type'] as $key=>$v): ?>
                                    <dd>
                                        <input type="radio" class="radio" name="t_id" value="<?php echo $v['type_id']; ?>" <?php if($class_array['type_id'] == $v['type_id']): ?>checked="checked"<?php endif; ?> />
                                               <span><?php echo $v['type_name']; ?></span></dd>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                                <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div>
                        </div></td>
                    <td class="vatop tips"><?php echo \think\Lang::get('goods_class_add_type_desc_one'); ?><a onclick="window.parent.openItem('index,type,goods')" href="JavaScript:void(0);"><?php echo \think\Lang::get('ds_type'); ?></a><?php echo \think\Lang::get('goods_class_add_type_desc_two'); ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="required"><label for="gc_sort"><?php echo \think\Lang::get('ds_sort'); ?>:</label></td>
                </tr>
                <tr class="noborder">
                    <td class="vatop rowform"><input type="text" value="<?php if($class_array['gc_sort'] == ''): ?>0<?php else: ?><?php echo $class_array['gc_sort']; endif; ?>" name="gc_sort" id="gc_sort" class="txt"></td>
                    <td class="vatop tips"><?php echo \think\Lang::get('goods_class_add_update_sort'); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="tfoot">
                    <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo \think\Lang::get('ds_submit'); ?></span></a></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
<script type="text/javascript" src="<?php echo PLUGINS_SITE_ROOT; ?>/mlselection.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.mousewheel.js"></script> 
<script>
                        $(function() {
                            
                            $('#type_div').perfectScrollbar();
                            //按钮先执行验证再提交表单
                            $("#submitBtn").click(function() {
                                if ($("#goods_class_form").valid()) {
                                    $("#goods_class_form").submit();
                                }
                            });
                            
                            $("#pic").change(function() {
                                $("#textfield1").val($(this).val());
                            });
                            $('input[type="radio"][name="t_id"]').change(function() {
                                // 标记类型时候修改 修改为ok
                                var t_id = <?php echo $class_array['type_id']; ?>;
                                if (t_id != $(this).val()) {
                                    $('#t_sign').val('ok');
                                } else {
                                    $('#t_sign').val('');
                                }

                                if ($(this).val() == '0') {
                                    $('#t_name').val('');
                                } else {
                                    $('#t_name').val($(this).next('span').html());
                                }
                            });

                            $('#goods_class_form').validate({
                                errorPlacement: function(error, element) {
                                    error.appendTo(element.parent().parent().prev().find('td:first'));
                                },
                                rules: {
                                    gc_name: {
                                        required: true,
                                        remote: {
                                            url: "<?php echo url('Goodsclass/ajax',['branch'=>'check_class_name']); ?>",
                                            type: 'get',
                                            data: {
                                                gc_name: function() {
                                                    return $('#gc_name').val();
                                                },
                                                gc_parent_id: function() {
                                                    return $('#gc_parent_id').val();
                                                },
                                                gc_id: '<?php echo $class_array['gc_id']; ?>'
                                            }
                                        }
                                    },
                                    commis_rate: {
                                        required: true,
                                        max: 100,
                                        min: 0,
                                        digits: true
                                    },
                                    gc_sort: {
                                        number: true
                                    }
                                },
                                messages: {
                                    gc_name: {
                                        required: '<?php echo \think\Lang::get('goods_class_add_name_null'); ?>',
                                        remote: '<?php echo \think\Lang::get('goods_class_add_name_exists'); ?>'
                                    },
                                    commis_rate: {
                                        required: '<?php echo \think\Lang::get('goods_class_add_commis_rate_error'); ?>',
                                        max: '<?php echo \think\Lang::get('goods_class_add_commis_rate_error'); ?>',
                                        min: '<?php echo \think\Lang::get('goods_class_add_commis_rate_error'); ?>',
                                        digits: '<?php echo \think\Lang::get('goods_class_add_commis_rate_error'); ?>'
                                    },
                                    gc_sort: {
                                        number: '<?php echo \think\Lang::get('goods_class_add_sort_int'); ?>'
                                    }
                                }
                            });

                            // 类型搜索
                            $(document).off('change',"#gcategory > select").on("change","#gcategory > select", function() {
                                type_scroll($(this));
                            });
                        });
                        var typeScroll = 0;
                        function type_scroll(o) {
                            var id = o.val();
                            if (!$('#type_dt_' + id).is('dt')) {
                                return false;
                            }
                            
                            $('#type_div').scrollTop(-typeScroll);
                            var sp_top = $('#type_dt_' + id).offset().top;
                            var div_top = $('#type_div').offset().top;
                            $('#type_div').scrollTop(sp_top - div_top);
                            typeScroll = sp_top - div_top;
                        }
                        gcategoryInit('gcategory');
</script> 

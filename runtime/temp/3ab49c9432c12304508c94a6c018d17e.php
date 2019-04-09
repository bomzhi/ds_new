<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\brand\form.html";i:1554684884;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;}*/ ?>
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
    <form id="brand_form" method="post" name="form1" enctype="multipart/form-data">
        <input type="hidden" name="brand_id" value="<?php echo $brand_array['brand_id']; ?>" />
        <table class="ds-default-table">
            <tbody>
            <tr class="noborder">
                <td class="required w120"><label class="validation"><?php echo \think\Lang::get('brand_index_name'); ?>:</label></td>
                <td class="vatop rowform"><input type="text" value="<?php echo $brand_array['brand_name']; ?>" name="brand_name" id="brand_name" class="txt"></td>
                <td class="vatop tips"></td>
            </tr>
            <tr class="noborder">
                <td class="required"><label class="validation"><?php echo \think\Lang::get('brand_name_initial'); ?>:</label></td>
                <td class="vatop rowform"><input type="text" value="<?php echo $brand_array['brand_initial']; ?>" name="brand_initial" id="brand_initial" class="txt"></td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_name_initial_tips'); ?></td>
            </tr>
            <tr class="noborder">
                <td class="required"><?php echo \think\Lang::get('brand_index_class'); ?>: </td>
                <td class="vatop rowform" id="gcategory"><input type="hidden" value="<?php echo $brand_array['class_id']; ?>" name="class_id" class="mls_id">
                    <input type="hidden" value="<?php echo $brand_array['brand_class']; ?>" name="brand_class" class="mls_name">
                    <span class="mr10"><?php echo $brand_array['brand_class']; ?></span>
                    <?php if(!(empty($brand_array['class_id']) || (($brand_array['class_id'] instanceof \think\Collection || $brand_array['class_id'] instanceof \think\Paginator ) && $brand_array['class_id']->isEmpty()))): ?>
                    <input class="edit_gcategory" type="button" value="<?php echo \think\Lang::get('ds_edit'); ?>">
                    <?php endif; ?>
                    <select <?php if(!(empty($brand_array['class_id']) || (($brand_array['class_id'] instanceof \think\Collection || $brand_array['class_id'] instanceof \think\Paginator ) && $brand_array['class_id']->isEmpty()))): ?>style="display:none;"<?php endif; ?> class="class-select">
                    <option value="0"><?php echo \think\Lang::get('ds_please_choose'); ?>...</option>
                    <?php if(!(empty($gc_list) || (($gc_list instanceof \think\Collection || $gc_list instanceof \think\Paginator ) && $gc_list->isEmpty()))): if(is_array($gc_list) || $gc_list instanceof \think\Collection || $gc_list instanceof \think\Paginator): if( count($gc_list)==0 ) : echo "" ;else: foreach($gc_list as $key=>$v): if($v['gc_parent_id'] == '0'): ?>
                    <option value="<?php echo $v['gc_id']; ?>"><?php echo $v['gc_name']; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                    </select>
                </td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_index_class_tips'); ?></td>
            </tr>
            <tr class="noborder">
                <td class="required"><?php echo \think\Lang::get('brand_index_pic_sign'); ?>: </td>
                <td class="vatop rowform">
                    <?php if(!(empty($brand_array['brand_pic']) || (($brand_array['brand_pic'] instanceof \think\Collection || $brand_array['brand_pic'] instanceof \think\Paginator ) && $brand_array['brand_pic']->isEmpty()))): ?>
                    <span class="type-file-show"> <img class="show_image" src="<?php echo ADMIN_SITE_ROOT; ?>/images/preview.png">
                        <div class="type-file-preview" style="display: none;"><img id="view_img" src="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_BRAND; ?>/<?php echo $brand_array['brand_pic']; ?>"></div>
                    </span>
                    <?php endif; ?>
                    <span class="type-file-box">
                        <input type='text' name='brand_pic' id='brand_pic' class='type-file-text' />
                        <input type='button' name='button' id='button' value='' class='type-file-button' />
                        <input name="_pic" type="file" class="type-file-file" id="_pic" size="30" hidefocus="true" />
                    </span>
                </td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_index_upload_tips'); ?><?php echo \think\Lang::get('brand_add_support_type'); ?>gif,jpg,png</td>
            </tr>
            <tr class="noborder">
                <td class="required"><?php echo \think\Lang::get('brand_showtype'); ?>: </td>
                <td class="vatop rowform">
                    <input id="brand_showtype_0" type="radio" <?php if($brand_array['show_type']==0): ?>checked<?php endif; ?> value="0" style="margin-bottom:6px;" name="brand_showtype" />
                    <label for="brand_showtype_0"><?php echo \think\Lang::get('brand_showtype_img'); ?></label>
                    <input id="brand_showtype_1" type="radio" <?php if($brand_array['show_type']==1): ?>checked<?php endif; ?> value="1" style="margin-bottom:6px;" name="brand_showtype" />
                    <label for="brand_showtype_1"><?php echo \think\Lang::get('brand_showtype_text'); ?></label>
                </td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_showtype_tips'); ?></td>
            </tr>
            <tr class="noborder">
                <td class="required"><?php echo \think\Lang::get('brand_add_if_recommend'); ?>: </td>
                <td class="vatop rowform onoff"><label for="brand_recommend1" class="cb-enable <?php if($brand_array['brand_recommend'] == '1'): ?>selected<?php endif; ?>" title="<?php echo \think\Lang::get('ds_yes'); ?>"><span><?php echo \think\Lang::get('ds_yes'); ?></span></label>
                    <label for="brand_recommend0" class="cb-disable <?php if($brand_array['brand_recommend'] == '0'): ?>selected<?php endif; ?>" title="<?php echo \think\Lang::get('ds_no'); ?>"><span><?php echo \think\Lang::get('ds_no'); ?></span></label>
                    <input id="brand_recommend1" name="brand_recommend" <?php if($brand_array['brand_recommend'] == '1'): ?>checked="checked"<?php endif; ?> value="1" type="radio">
                    <input id="brand_recommend0" name="brand_recommend" <?php if($brand_array['brand_recommend'] == '0'): ?>checked="checked"<?php endif; ?> value="0" type="radio"></td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_index_recommend_tips'); ?></td>
            </tr>
            <tr> 
            </tr>
            <tr class="noborder">
                <td class="required"><?php echo \think\Lang::get('ds_sort'); ?>: </td>
                <td class="vatop rowform"><input type="text" value="<?php echo $brand_array['brand_sort']; ?>" name="brand_sort" id="brand_sort" class="txt"></td>
                <td class="vatop tips"><?php echo \think\Lang::get('brand_add_update_sort'); ?></td>
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
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/mlselection.js"></script>
<script>
    function call_back(picname){
        $('#brand_pic').val(picname);
        $('#view_img').attr('src','<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_BRAND; ?>/'+picname);
    }
    //按钮先执行验证再提交表单
    $(function(){
        // 编辑分类时清除分类信息
        $('.edit_gcategory').click(function(){
            $('input[name="class_id"]').val('');
            $('input[name="brand_class"]').val('');
        });

        $("#submitBtn").click(function(){
            if($("#brand_form").valid()){
                $("#brand_form").submit();
            }
        });
        jQuery.validator.addMethod("initial", function(value, element) {
            return /^[A-Za-z0-9]$/i.test(value);
        }, "");
        $("#brand_form").validate({
            errorPlacement: function(error, element){
                error.appendTo(element.parent().parent().find('td:last'));
            },
            rules : {
                brand_name : {
                    required : true,
                    remote   : {
                        url :"<?php echo url('Brand/ajax','branch=check_brand_name'); ?>",
                        type:'get',
                        data:{
                            brand_name : function(){
                                return $('#brand_name').val();
                            },
                            id  : '<?php echo $brand_array['brand_id']; ?>'
                        }
                    }
                },
                brand_initial : {
                    initial  : true
                },
                brand_sort : {
                    number   : true,
                    range : [0,255]
                }
            },
            messages : {
                brand_name : {
                    required : '<?php echo \think\Lang::get('brand_add_name_null'); ?>',
                    remote   : '<?php echo \think\Lang::get('brand_add_name_exists'); ?>'
                },
                brand_initial : {
                    initial : '<?php echo \think\Lang::get('brand_add_initial'); ?>'
                },
                brand_sort  : {
                    number   : '<?php echo \think\Lang::get('brand_add_sort_int'); ?>',
                    range : '<?php echo \think\Lang::get('class_sort_explain'); ?>'
                }
            }
        });
    });
    gcategoryInit('gcategory');
</script>
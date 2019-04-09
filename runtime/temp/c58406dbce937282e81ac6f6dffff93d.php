<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\type\type_form.html";i:1545795872;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
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





<style>
    tr.disable{-webkit-opacity: 0.3;  
    /* Netscape and Older than Firefox 0.9 */  
    -moz-opacity: 0.3;  
    /* Safari 1.x (pre WebKit!) 老式khtml内核的Safari浏览器*/  
    -khtml-opacity: 0.3;  
    /* IE9 + etc...modern browsers */  
    opacity: .3;  
    /* IE 4-9 */  
    filter:alpha(opacity=30);  
    /*This works in IE 8 & 9 too*/  
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";  
    /*IE4-IE9*/  
    filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=30);}
</style>


<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>类型管理</h3>
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
    <form class="" id="type_form" method="post">
        <div class="ncap-form-default">
            <dl>
                <dt></dt>
                <dd>
                    <div id="gcategory" class="default_select">
                        <input type="hidden" name="class_id" value="<?php echo $type['class_id']; ?>" class="mls_id" />
                        <input type="hidden" name="class_name" value="<?php echo (isset($type['class_name']) && ($type['class_name'] !== '')?$type['class_name']:''); ?>" class="mls_name" />
                        <?php if($type['class_id']): ?>
                        <span><?php echo (isset($type['class_name']) && ($type['class_name'] !== '')?$type['class_name']:''); ?></span>
                        <input type="button" value="<?php echo \think\Lang::get('ds_edit'); ?>" class="edit_gcategory" />
                        <?php endif; ?>
                        <select <?php if($type['class_id']): ?>style="display:none"<?php endif; ?>>
                            <option value="0">请选择分类</option>
                            <?php if(is_array($gc_list) || $gc_list instanceof \think\Collection || $gc_list instanceof \think\Paginator): if( count($gc_list)==0 ) : echo "" ;else: foreach($gc_list as $key=>$gc): ?>
                            <option value="<?php echo $gc['gc_id']; ?>"><?php echo $gc['gc_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><?php echo \think\Lang::get('type_name'); ?></dt>
                <dd>
                    <input type="text" name="type_name" id="type_name" value="<?php echo (isset($type['type_name']) && ($type['type_name'] !== '')?$type['type_name']:''); ?>" />
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>

            <dl>
                <dt><?php echo \think\Lang::get('type_sort'); ?></dt>
                <dd>
                    <input type="text" name="type_sort" id="type_sort" value="<?php echo (isset($type['type_sort']) && ($type['type_sort'] !== '')?$type['type_sort']:'0'); ?>" />
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl data-brand="title">
                <dt>选择相关品牌</dt>
                <dd>
                </dd>
            </dl>
            <?php if(!(empty($brand_list) || (($brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator ) && $brand_list->isEmpty()))): if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $key=>$brand_gc): ?>
            <dl data-brand="content">
                <dt><?php echo $brand_gc['name']; ?></dt>
                <dd>
                    <?php if(is_array($brand_gc['brand']) || $brand_gc['brand'] instanceof \think\Collection || $brand_gc['brand'] instanceof \think\Paginator): if( count($brand_gc['brand'])==0 ) : echo "" ;else: foreach($brand_gc['brand'] as $key=>$brand): ?>
                    <input type="checkbox" id="brand_<?php echo $brand['brand_id']; ?>" value="<?php echo $brand['brand_id']; ?>" name="brand_id[]" <?php if($brand['checked']): ?>checked="checked"<?php endif; ?> />
                    <label for="brand_<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dd>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            <dl data-spec="title">
                <dt>选择相关规格</dt>
                <dd>
                </dd>
            </dl>
            <?php if(!(empty($spec_list) || (($spec_list instanceof \think\Collection || $spec_list instanceof \think\Paginator ) && $spec_list->isEmpty()))): if(is_array($spec_list) || $spec_list instanceof \think\Collection || $spec_list instanceof \think\Paginator): if( count($spec_list)==0 ) : echo "" ;else: foreach($spec_list as $key=>$spec_gc): ?>
            <dl data-spec="content">
                <dt><?php echo $spec_gc['name']; ?></dt>
                <dd>
                    <?php if(is_array($spec_gc['spec']) || $spec_gc['spec'] instanceof \think\Collection || $spec_gc['spec'] instanceof \think\Paginator): if( count($spec_gc['spec'])==0 ) : echo "" ;else: foreach($spec_gc['spec'] as $key=>$spec): ?>
                    <input type="checkbox" id="spec_<?php echo $spec['sp_id']; ?>" value="<?php echo $spec['sp_id']; ?>" name="spec_id[]" <?php if(!(empty($spec['checked']) || (($spec['checked'] instanceof \think\Collection || $spec['checked'] instanceof \think\Paginator ) && $spec['checked']->isEmpty()))): ?>checked="checked"<?php endif; ?>/>
                    <label for="spec_<?php echo $spec['sp_id']; ?>"><?php echo $spec['sp_name']; ?></label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dd>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>



        <table class="ds-default-table">
            <thead>
                <tr>
                    <th width="100">排序</th>
                    <th width="200">属性名称</th>
                    <th>属性可选值</th>
                    <th width="100">显示</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody id="tr_model">
                <tr></tr>
                <?php if(!(empty($attr_list) || (($attr_list instanceof \think\Collection || $attr_list instanceof \think\Paginator ) && $attr_list->isEmpty()))): if(is_array($attr_list) || $attr_list instanceof \think\Collection || $attr_list instanceof \think\Paginator): if( count($attr_list)==0 ) : echo "" ;else: foreach($attr_list as $key=>$attr): ?>
                <tr data-attr="old">
                
                <td><input type="text" class="form-control" name="at_value[<?php echo $attr['attr_id']; ?>][sort]" value="<?php echo $attr['attr_sort']; ?>"/></td>
                <td><input type="text" class="form-control" name="at_value[<?php echo $attr['attr_id']; ?>][name]" value="<?php echo $attr['attr_name']; ?>"/></td>
                <td><?php echo $attr['attr_value']; ?></td>
                <td><input type="checkbox" name="at_value[<?php echo $attr['attr_id']; ?>][show]" <?php if($attr['attr_show']): ?> checked="checked" <?php endif; ?> /></td>
                <td>
                    <input type="hidden" value="" name="at_value[<?php echo $attr['attr_id']; ?>][form_submit]" />
                    <input type="hidden" value="<?php echo $attr['attr_id']; ?>" name="at_value[<?php echo $attr['attr_id']; ?>][attr_id]" />
                    <input type="checkbox" data-attr="del" name="a_del[<?php echo $attr['attr_id']; ?>]" value="<?php echo $attr['attr_id']; ?>" style="display:none" />
                    <a href="<?php echo url('Type/attr_edit',['attr_id'=>$attr['attr_id']]); ?>"><?php echo \think\Lang::get('ds_edit'); ?></a>
                    <a onclick="remove_tr($(this));" href="JavaScript:void(0);">移除</a>
                </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <tr data-attr="new">
                    <td><input type="text" class="form-control" name="at_value[key][sort]" value="0"/></td>
                    <td><input type="text" class="form-control" name="at_value[key][name]" value=""/></td>
                    <td><textarea rows="5" cols="80" class="form-control" name="at_value[key][value]"></textarea></td>
                    <td><input type="checkbox" name="at_value[key][show]" checked="checked" /></td>
                    <td>
                        <a onclick="remove_tr($(this));" href="JavaScript:void(0);">移除</a>
                    </td>
                </tr>
                <?php endif; ?>
                
            </tbody>
            <tbody>
                <tr>
                    <td>
                        <a id="add_type" class="btn-add-nofloat marginleft" href="JavaScript:void(0);"> <span>添加一个属性</span> </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <input id="submitBtn" class="btn" type="submit" value="提交"/>
    </form>
</div>
<!--载入-->
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/mlselection.js"></script>
<script>
                            $(function () {
                                gcategoryInit("gcategory");
                                $(function () {
                                    gcategoryInit("gcategory");
                                    var i = 0;
                                    var tr_model = '<tr data-attr="new">' +
                                            '<td><input type="text" class="form-control" name="at_value[key][sort]" value="0" /></td>' +
                                            '<td><input type="text" class="form-control" name="at_value[key][name]" value="" /></td>' +
                                            '<td><textarea rows="5" cols="80" class="form-control" name="at_value[key][value]"></textarea></td>' +
                                            '<td><input type="checkbox" name="at_value[key][show]" checked="checked" /></td>' +
                                            '<td><a onclick="remove_tr($(this));" href="JavaScript:void(0);">移除</a></td>' +
                                            '</tr>';
                                    $("#add_type").click(function () {
                                        $('#tr_model > tr:last').after(tr_model.replace(/key/g, i));
                                        i++;
                                    });
                                });
                      
                                $('#gcategory').click(function(){
                                    $.getJSON("<?php echo url('Type/ajaxGetSpecAndBrand'); ?>"+"?type_id=<?php echo (isset($type['type_id']) && ($type['type_id'] !== '')?$type['type_id']:0); ?>&class_id="+$('[name=class_id]').val(),function(data){
                                        $('[data-spec=content]').remove();
                                        var s_list=data.s_list;
                                        var html='';
                                        for(var i in s_list){
                                            var html_spec='';
                                            var spec=s_list[i].spec;
                                            for(var j in spec){
                                                html_spec+='<input type="checkbox" id="spec_'+spec[j].sp_id+'" value="'+spec[j].sp_id+'" name="spec_id[]" '+((spec[j].checked=='1')?'checked="checked"':"")+' />'+
                                                    '<label for="spec_'+spec[j].sp_id+'">'+spec[j].sp_name+'</label>';
                                            }
                                            html+='<dl data-spec="content">'+
                                                '<dt>'+s_list[i].name+'</dt>'+
                                                '<dd>'+
                                                    html_spec+
                                                '</dd>'+
                                            '</dl>';
                                        }
                                        $('[data-spec=title]').after(html);
                                        
                                        
                                        $('[data-brand=content]').remove();
                                        var b_list=data.b_list;
                                        var html='';
                                        for(var i in b_list){
                                            var html_brand='';
                                            var brand=b_list[i].brand;
                                            for(var j in brand){
                                                html_brand+='<input type="checkbox" id="brand_'+brand[j].brand_id+'" value="'+brand[j].brand_id+'" name="brand_id[]" '+((brand[j].checked=='1')?'checked="checked"':"")+' />'+
                                                    '<label for="brand_'+brand[j].brand_id+'">'+brand[j].brand_name+'</label>';
                                            }
                                            html+='<dl data-brand="content">'+
                                                '<dt>'+b_list[i].name+'</dt>'+
                                                '<dd>'+
                                                    html_brand+
                                                '</dd>'+
                                            '</dl>';
                                        }
                                        $('[data-brand=title]').after(html);
                                    })    
                                });
                                $('#type_form').submit(function(){
                                    $('tr[data-attr=old].disable').find('[data-attr=del]').prop('checked',true);
                                    $('tr[data-attr=new].disable').find('input').prop('disabled',true);
                                });
                            });
                            function remove_tr(o) {
                                if(o.parents('tr:first').hasClass('disable')){
                                    o.parents('tr:first').removeClass('disable');
                                    o.text('移除');
                                }else{
                                    o.parents('tr:first').addClass('disable');
                                    o.text('还原');
                                }
                                
                            };
                            

//按钮先执行验证再提交表单
                    $(function() {
                        $("#submitBtn").click(function() {
                            if ($("#type_form").valid()) {
                                $("#type_form").submit();
                            }
                        });
                    });
                    $(document).ready(function() {
                        $("#type_form").validate({
                            errorPlacement: function(error, element) {
                                error.appendTo(element.nextAll('span.err'));
                            },
                            rules: {
                                type_name : {
                                    required : true
                                },
                                type_sort : {
                                    required : true,
                                    number : true,
                                    range : [0,255]
                                },
                            },
                            messages: {
                                type_name : {
                                    required : '请输入类型名称',
                                },
                                type_sort : {
                                    required : '<?php echo \think\Lang::get('type_edit_type_attr_sort_no_null'); ?>',
                                    number : '<?php echo \think\Lang::get('type_edit_type_attr_sort_no_digits'); ?>',
                                    range : '<?php echo \think\Lang::get('class_sort_explain'); ?>'
                                },
                            }
                        });
                    });

</script>

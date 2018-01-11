
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\AdminArticleContent;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminArticleContent();
$modeltype = new \backend\models\AdminArticleType();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<link href="../common/kindeditor/themes/default/default.css" rel="stylesheet" />
<script charset="utf-8" src="../common/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="../common/kindeditor/lang/en.js"></script>
<script charset="utf-8" src="../common/kindeditor/lang/zh-CN.js"></script>
<?php $this->endBlock(); ?>

<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#content',{allowImageUpload:true,resizeType : 1,width:"80%",height:"500px",langType : 'zh-CN'});
    });
$(document).ready(function(){
  // $("#acontent").css({"background-color":"blue","font-size":"14px"});
});
</script>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
            
              <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
                    |
              <button id="delete_btn" type="sbutton" class="btn btn-xs btn-danger">批量删除</button>
                
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
            <div class="row">
            <div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'admin-article-content-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('admin-article-content/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('title')?>:</label>
                      <input type="text" class="form-control" id="query[title]" name="query[title]"  value="<?=isset($query["title"]) ? $query["title"] : "" ?>">
                  </div>
              <div class="form-group">
                <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
              </div>
               <?php ActiveForm::end(); ?> 
            </div>
            </div>
            <!-- row end search -->
            
            <!-- row start -->
            <div class="row">
            <div class="col-sm-12">
            <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
              echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'title\', \'desc\')" '.CommonFun::sortClass($orderby, 'title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('title').'</th>';
              echo '<th onclick="orderby(\'status\', \'desc\')" '.CommonFun::sortClass($orderby, 'status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('status').'</th>';
              echo '<th onclick="orderby(\'sort\', \'desc\')" '.CommonFun::sortClass($orderby, 'sort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sort').'</th>';
              echo '<th onclick="orderby(\'content\', \'desc\')" '.CommonFun::sortClass($orderby, 'content').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('content').'</th>';
              echo '<th onclick="orderby(\'type_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'type_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('type_id').'</th>';
              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_user').'</th>';
              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_date').'</th>';
                  ?>
    
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->title . '</td>';
                echo '  <td>' . ($model->status == '1'?'是':'否') . '</td>';
                echo '  <td>' . $model->sort . '</td>';
                echo '  <td>' . $model->content . '</td>';
                foreach ($models1 as $model1) { if ($model1->id == $model->type_id) {
                echo '  <td>'.$model1->name. '</td>';
                }} 
                echo '  <td>' . $model->update_user . '</td>';
                echo '  <td>' . $model->update_date . '</td>';
                echo '  <td class="center">';
                // echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                    <div class="infos">
                    从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>                   到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>                   共 <?= $pages->totalCount?> 条记录</div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                <?= LinkPager::widget([
                    'pagination' => $pages,
                    'nextPageLabel' => '»',
                    'prevPageLabel' => '«',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                ]); ?>  
                
                </div>
            </div>
          </div>
          <!-- row end -->
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>添加文章</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-article-content-form", "class"=>"form-horizontal","action"=>"index.php?r=admin-article-content/save"]); ?>
          <input type="hidden" class="form-control" id="id" name="AdminArticleContent[id]" />

          <div id="controller_id_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="AdminArticleContent[title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="action_id_div" class="form-group">
              <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
              <div class="col-sm-10">
<!--                   <input type="radio" class="form-control"  name="AdminArticleContent[status]" value="1" checked="checked" />是
                  <input type="radio" class="form-control"  name="AdminArticleContent[status]" value="0" />否 -->
                  <select id="status" name="AdminArticleContent[status]">
                    <option value="" <?php if ("AdminArticleContent[status]" == '') { ?>selected="selected" <?php } ?>>请选择</option>
                    <option value="1" <?php if ("AdminArticleContent[status]" == 1) { ?>selected="selected" <?php } ?>>是</option>
                    <option value="2" <?php if ("AdminArticleContent[status]" == 2) { ?>selected="selected" <?php } ?>>否</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="action_id_div" class="form-group">
              <label for="type_id" class="col-sm-2 control-label">关联类型</label>
              <div class="col-sm-10">
                  <select id="type_id" name="AdminArticleContent[type_id]">
                  <option value="" <?php if ("AdminArticleContent[type_id]" == '') { ?>selected="selected" <?php } ?>>请选择</option>

                  <?php foreach ($models1 as $model) {?>
           
                  <option value="<?=$model->id ?>" <?php if("AdminArticleContent[type_id]" == $model->id) {?> select=selected <?php } ?>><?=$model->name ?></option>
            
                  <?php } ?>

                  </select>
              </div>
              <div class="clearfix"></div>
          </div>


          <div id="url_div" class="form-group">
              <label for="sort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("content")?></label>
              <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="AdminArticleContent[content]"></textarea>
              </div>
              <div class="clearfix"></div>
          </div>


          <div id="url_div" class="form-group">
              <label for="sort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sort")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sort" name="AdminArticleContent[sort]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_user_div" class="form-group">
              <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_user" name="AdminArticleContent[create_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="AdminArticleContent[create_date]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_user_div" class="form-group">
              <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_user" name="AdminArticleContent[update_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_date_div" class="form-group">
              <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_date" name="AdminArticleContent[update_date]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

                    

            <?php ActiveForm::end(); ?>          
                </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
                    id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
function orderby(field, op){
     var url = window.location.search;
     var optemp = field + " desc";
     if(url.indexOf('orderby') != -1){
         url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
             var optemp = field + " desc";
             optemp = decodeURI($1) != optemp ? optemp : field + " asc";
             return "orderby=" + optemp;
           }); 
     }
     else{
         if(url.indexOf('?') != -1){
             url = url + "&orderby=" + encodeURI(optemp);
         }
         else{
             url = url + "?orderby=" + encodeURI(optemp);
         }
     }
     window.location.href=url; 
 }
 function searchAction(){
        $('#admin-article-content-search-form').submit();
    }
 function viewAction(id){
        initModel(id, 'view', 'fun');
    }

 function initEditSystemModule(data, type){
    if(type == 'create'){
        $("#id").val('');
        $("#title").val('');
        $("#status").val('');
        $("#sort").val('');
        $("#content").val('');
        $("#type_id").val('');
    $("#create_user").val('');
    $("#create_date").val('');
    $("#update_user").val('');
    $("#update_date").val('');
        
    }
    else{
        $("#id").val(data.id);
        $("#title").val(data.title);
        $("#status").val(data.status);
        $("#sort").val(data.sort);
        $("#content").val(data.content);
        $("#type_id").val(data.type_id);
      $("#create_user").val(data.create_user);
      $("#create_date").val(data.create_date);
      $("#update_user").val(data.update_user);
      $("#update_date").val(data.update_date);
        }
    if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#status").attr({readonly:true,disabled:true});
      $("#sort").attr({readonly:true,disabled:true});
      $("#content").attr({readonly:true,disabled:true});
      $("#type_id").attr({readonly:true,disabled:true});
      $("#create_user").attr({readonly:true,disabled:true});
      $("#create_user").parent().parent().show();
      $("#create_date").attr({readonly:true,disabled:true});
      $("#create_date").parent().parent().show();
      $("#update_user").attr({readonly:true,disabled:true});
      $("#update_user").parent().parent().show();
      $("#update_date").attr({readonly:true,disabled:true});
      $("#update_date").parent().parent().show();
    $('#edit_dialog_ok').addClass('hidden');
    }
    else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:false,disabled:false});
      $("#status").attr({readonly:false,disabled:false});
      $("#sort").attr({readonly:false,disabled:false});
      $("#content").attr({readonly:false,disabled:false});
      $("type_id").attr({readonly:false,disabled:false});
      $("#create_user").attr({readonly:false,disabled:false});
      $("#create_user").parent().parent().hide();
      $("#create_date").attr({readonly:false,disabled:false});
      $("#create_date").parent().parent().hide();
      $("#update_user").attr({readonly:false,disabled:false});
      $("#update_user").parent().parent().hide();
      $("#update_date").attr({readonly:false,disabled:false});
      $("#update_date").parent().parent().hide();
        $('#edit_dialog_ok').removeClass('hidden');
        }
        $('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
    
    $.ajax({
           type: "GET",
           url: "<?=Url::toRoute('admin-article-content/view')?>",
           data: {"id":id},
           cache: false,
           dataType:"json",
           error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
           success: function(data){
               initEditSystemModule(data, type);
           }
        });
}
    
function editAction(id){
    initModel(id, 'edit');
}

function deleteAction(id){
    var ids = [];
    if(!!id == true){
        ids[0] = id;
    }
    else{
        var checkboxs = $('#data_table :checked');
        if(checkboxs.size() > 0){
            var c = 0;
            for(i = 0; i < checkboxs.size(); i++){
                var id = checkboxs.eq(i).val();
                if(id != ""){
                    ids[c++] = id;
                }
            }
        }
    }
    if(ids.length > 0){
        admin_tool.confirm('请确认是否删除', function(){
            $.ajax({
                   type: "GET",
                   url: "<?=Url::toRoute('admin-article-content/delete')?>",
                   data: {"ids":ids},
                   cache: false,
                   dataType:"json",
                   error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                   success: function(data){
                       for(i = 0; i < ids.length; i++){
                           $('#rowid_' + ids[i]).remove();
                       }
                       admin_tool.alert('msg_info', '删除成功', 'success');
                       window.location.reload();
                   }
                });
        });
    }
    else{
        // admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
    alert('请先选择要删除的数据'); 
    }
    
}

function getSelectedIdValues(formId)
{
    var value="";
    $( formId + " :checked").each(function(i)
    {
        if(!this.checked)
        {
            return true;
        }
        value += this.value;
        if(i != $("input[name='id']").size()-1)
        {
            value += ",";
        }
     });
    return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
    $('#admin-article-content-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-article-content-form').bind('submit', function(e) {
    e.preventDefault();
    var id = $("#id").val();
    var action = id == "" ? "<?=Url::toRoute('admin-article-content/create')?>" : "<?=Url::toRoute('admin-article-content/update')?>";
    $(this).ajaxSubmit({
        type: "post",
        dataType:"json",
        url: action,
        data:{id:id},
        success: function(value) 
        {
            if(value.errno == 0){
                $('#edit_dialog').modal('hide');
                admin_tool.alert('msg_info', '添加成功', 'success');
                window.location.reload();
            }
            else{
                var json = value.data;
                for(var key in json){
                    $('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
                    
                }
            }

        }
    });
});
</script>
<?php $this->endBlock(); ?>
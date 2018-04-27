
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use common\models\AdminFinanceRecord;
use backend\models\AdminMember;

$modelLabel = new \common\models\AdminFinanceRecord();
$membersModel= AdminMember::find()->select('id,name,prefix_name')->where(['status' => 10])->asArray()->all();
$members = array_column($membersModel, 'name', 'id');
$prefixNames = array_column($membersModel, 'prefix_name', 'id');

?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 200px;">
                <button id="export_btn" onclick="exportDate()" type="button" class="btn btn-xs btn-primary">导&nbsp;&emsp;出</button>&nbsp;|&nbsp;
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
        			|
        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'admin-finance-record-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('admin-finance-record/index')]); ?>
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('operate_name')?>:</label>
                      <input type="text" class="form-control" id="query[operate_name]" name="query[operate_name]"  value="<?=isset($query["operate_name"]) ? $query["operate_name"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 5px;">
                      <label><?= '会员前缀'?>:</label>
                      <input type="text" class="form-control" id="prefix_name" name="prefix_name"  value="<?=isset($query["prefix_name"]) ? $query["prefix_name"] : "" ?>">
                  </div>
                    <div class="form-group" style="margin: 5px;">
                        <label><?= '会员名'?>:</label>
                        <input type="text" class="form-control" id="member_name" name="member_name"  value="<?=isset($query["member_name"]) ? $query["member_name"] : "" ?>">
                    </div>
                    <div class="form-group" style="margin: 5px;">
                        <label><?=$modelLabel->getAttributeLabel('operate_type')?>:</label>
                        <select id="query[operate_type]"  class="form-control" name="query[operate_type]">
                            <option value=0 <?php if(0 == $query["operate_type"]):?> selected="selected"<?php endif;?>>请选择</option>
                            <option value=1 <?php if(1 == $query["operate_type"]):?> selected="selected"<?php endif;?>>充  值</option>
                            <option value=2 <?php if(2 == $query["operate_type"]):?> selected="selected"<?php endif;?>>消  费</option>
                        </select>
                    </div>
                <div class="form-group input-append date form_datetime" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('create_time')?>:</label>
                    <input size="16" type="text" name="startDate"  class="form-control"value="<?=isset($query['startDate']) ?$query['startDate'] : '' ?>" readonly >
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
                <div class="form-group input-append date form_datetime" style="margin: 5px;">
                    <label><?= '-'?></label>
                    <input size="16" type="text" name="endDate" class="form-control"value="<?=isset($query['endDate']) ?$query['endDate'] : '' ?>" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-calendar"></i></span>
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
              echo '<th onclick="" '. '会员前缀' .' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'会员前缀</th>';
              echo '<th onclick="orderby(\'member_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'member_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('member_id').'</th>';
              echo '<th onclick="orderby(\'amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('amount').'</th>';
              echo '<th onclick="orderby(\'operate_type\', \'desc\')" '.CommonFun::sortClass($orderby, 'operate_type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('operate_type').'</th>';
              echo '<th onclick="orderby(\'remark\', \'desc\')" '.CommonFun::sortClass($orderby, 'remark').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('remark').'</th>';
              echo '<th onclick="orderby(\'operate_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'operate_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('operate_name').'</th>';
              echo '<th onclick="orderby(\'order_sn\', \'desc\')" '.CommonFun::sortClass($orderby, 'order_sn').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('order_sn').'</th>';
              echo '<th onclick="orderby(\'pay_sn\', \'desc\')" '.CommonFun::sortClass($orderby, 'pay_sn').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('pay_sn').'</th>';
              echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
              echo '<th onclick="orderby(\'ip\', \'desc\')" '.CommonFun::sortClass($orderby, 'ip').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('ip').'</th>';

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
                echo '  <td>' . $prefixNames[$model->member_id] . '</td>';
                echo '  <td>' . $members[$model->member_id] . '</td>';
                echo '  <td>' . $model->amount . '</td>';
                echo '  <td>' . $model->operate_type . '</td>';
                echo '  <td>' . $model->remark . '</td>';
                echo '  <td>' . $model->operate_name . '</td>';
                echo '  <td>' . $model->order_sn . '</td>';
                echo '  <td>' . $model->pay_sn . '</td>';
                echo '  <td>' . $model->create_time . '</td>';
                echo '  <td>' . $model->ip . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
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
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-finance-record-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-finance-record/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />
          <div id="amount_div" class="form-group">
              <div id="msg_info"></div>
              <label for="amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("member_id")?></label>
              <div class="col-sm-10">
                  <select id="member_id" class="form-control" name="AdminFinanceRecord[member_id]">
                      <?php foreach ($members as $key => $member):?>
                          <option value="<?= $key?>"><?= $member?></option>
                      <?php endforeach;?>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>
          <div id="amount_div" class="form-group">
              <label for="amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("amount")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="amount" name="AdminFinanceRecord[amount]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="operate_type_div" class="form-group">
              <label for="operate_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("operate_type")?></label>
              <div class="col-sm-10">
                  <select id="operate_type" class="form-control" name="AdminFinanceRecord[operate_type]">
                          <option value="1"> 充值</option>
                          <option value="2"> 消费</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="remark_div" class="form-group">
              <label for="remark" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("remark")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="remark" name="AdminFinanceRecord[remark]" placeholder="<?php echo $modelLabel->getAttributeLabel("remark")?>" />
              </div>
              <img id="payImage" alt="模式二扫码支付" src="" style="width:150px;height:150px;display: none;margin: 0 auto;"/>
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
     function exportDate() {
         var ids = [];
         if(!!id == true){
             ids[0] = id;
         }
         else{
             var checkboxs = $('#data_table :checked');
             if(checkboxs.size() > 0){
                 var c = 0;
                 for(i = 1; i < checkboxs.size(); i++){
                     var id = checkboxs.eq(i).val();
                     if(id != ""){
                         ids[c++] = id;
                     }
                 }
             }
         }
         console.log(ids);
         if(ids.length > 0){
             admin_tool.confirm('请确认是否导出', function(){
                 window.location.href= "<?=Url::toRoute('admin-finance-record/export')?>" + "&ids=" + ids.join(',');
             });
         }
         else{
             alert('请先选择要导出的数据');
         }
     }

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
		$('#admin-finance-record-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#member_id").val('');
		$("#amount").val('');
		$("#operate_type").val(0);
		$("#remark").val('');
		$("#operate_name").val('');
		$("#create_time").val('');
		$("#ip").val('');
		
	}
	else{
		$("#id").val(data.id);
		$("#member_id").val(data.member_id);
    	$("#amount").val(data.amount);
    	$("#operate_type").val(data.operate_type);
    	$("#remark").val(data.remark);
    	$("#operate_name").val(data.operate_name);
    	$("#create_time").val(data.create_time);
    	$("#ip").val(data.ip);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#member_id").attr({readonly:true,disabled:true});
      $("#amount").attr({readonly:true,disabled:true});
      $("#operate_type").attr({readonly:true,disabled:true});
      $("#remark").attr({readonly:true,disabled:true});
      $("#operate_name").attr({readonly:true,disabled:true});
      $("#create_time").attr({readonly:true,disabled:true});
      $("#ip").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#member_id").attr({readonly:false,disabled:false});
      $("#amount").attr({readonly:false,disabled:false});
      $("#operate_type").attr({readonly:false,disabled:false});
      $("#remark").attr({readonly:false,disabled:false});
      $("#operate_name").attr({readonly:false,disabled:false});
      $("#create_time").attr({readonly:false,disabled:false});
      $("#ip").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-finance-record/view')?>",
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
				   url: "<?=Url::toRoute('admin-finance-record/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
					},
				   success: function(data){
            console.log(data);
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
    var operate_type = $('#operate_type').val();
    if (operate_type == 1) {
        $("#msg_info").html('');
        var memberId = $('#member_id').val();
        var amount = $('#amount').val();
        var remark = $('#remark').val();
        getPayCode(memberId, amount, remark);
        return;
    }
    $('#payImage').css('display', 'none');
	$('#admin-finance-record-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-finance-record-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-finance-record/create')?>" : "<?=Url::toRoute('admin-finance-record/update')?>";
    $(this).ajaxSubmit({
        type: "post",
    	dataType:"json",
    	url: action,
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

function getPayCode (memberId, amount, remark) {
    $.ajax({
        type: "GET",
        url: "<?=Url::toRoute('admin-finance-record/get-pay-code')?>",
        data: {"memberId":memberId, "amount":amount, "remark":remark},
        cache: false,
        dataType:"json",
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
        },
        success: function(data){
            if (data.code !== 0) {
                admin_tool.alert('msg_info', '出错了，' + data.message, 'warning');
                return;
            }
            var url ="http://paysdk.weixin.qq.com/example/qrcode.php?data=" + encodeURIComponent(data.data);
            $('#payImage').css('display', 'block');
            $('#payImage').attr('src', url);

        }
    });
}

 
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-right",
        todayHighlight: true
    });
</script>
<?php $this->endBlock(); ?>
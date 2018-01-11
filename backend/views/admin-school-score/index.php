
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\AdminSchoolScore;
use common\models\AdminSchool;

$modelLabel = new \common\models\AdminSchoolScore();
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
            <div class="input-group input-group-sm" style="width: 150px;">
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
                <?php ActiveForm::begin(['id' => 'admin-school-score-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('admin-school-score/index')]); ?>     
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('year')?>:</label>
                      <input type="text" class="form-control" id="query[year]" name="query[year]"  value="<?=isset($query["year"]) ? $query["year"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('school_id')?>:</label>
                      <input type="text" class="form-control" id="query[school_name]" name="query[school_name]"  value="<?=isset($query["school_name"]) ? $query["school_name"] : "" ?>">
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
              echo '<th onclick="orderby(\'school_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'school_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('school_id').'</th>';
              echo '<th onclick="orderby(\'year\', \'desc\')" '.CommonFun::sortClass($orderby, 'year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('year').'</th>';
              echo '<th onclick="orderby(\'high_score\', \'desc\')" '.CommonFun::sortClass($orderby, 'high_score').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('high_score').'</th>';
              echo '<th onclick="orderby(\'agv_score\', \'desc\')" '.CommonFun::sortClass($orderby, 'agv_score').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('agv_score').'</th>';
              echo '<th onclick="orderby(\'low_score\', \'desc\')" '.CommonFun::sortClass($orderby, 'low_score').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('low_score').'</th>';
              echo '<th onclick="orderby(\'diff_score\', \'desc\')" '.CommonFun::sortClass($orderby, 'diff_score').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('diff_score').'</th>';
              echo '<th onclick="orderby(\'plan_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'plan_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('plan_count').'</th>';
              echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number').'</th>';
              echo '<th onclick="orderby(\'rank\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank').'</th>';
echo '<th onclick="orderby(\'rank\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('batch_id').'</th>';
echo '<th onclick="orderby(\'rank\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('mold_id').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            $obj = new AdminSchool();
            $cates = $obj->getCates();
            $batch_arr = [];
            $mold_arr = [];
            foreach($cates[0]['children'] as $cate) {
                $batch_arr[$cate['id']] = $cate['name'];
            }
            $mold_arr[0] = '文科';
            $mold_arr[1] = '理科';
            $mold_arr[2] = '其他';
            foreach ($models as $model) {
                $batch = isset($model->batch_id)? $batch_arr[$model->batch_id] : '';
                $mold =  isset($model->mold_id)? $mold_arr[$model->mold_id] : '';
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                foreach ($schoolInfo as $school) {
                    if($school['id'] == $model->school_id) {
                         echo ' <td>' . $school['name'] . '</td>';
                    }
                }
                echo '  <td>' . $model->year . '</td>';
                echo '  <td>' . $model->high_score . '</td>';
                echo '  <td>' . $model->agv_score . '</td>';
                echo '  <td>' . $model->low_score . '</td>';
                echo '  <td>' . $model->diff_score . '</td>';
                echo '  <td>' . $model->plan_count . '</td>';
                echo '  <td>' . $model->number . '</td>';
                echo '  <td>' . $model->rank . '</td>';
                echo '  <td>' . $batch . '</td>';
                echo '  <td>' . $mold  . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
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
                <?php $form = ActiveForm::begin(["id" => "admin-school-score-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-school-score/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="year_div" class="form-group">
              <label for="year" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("year")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="year" name="AdminSchoolScore[year]" placeholder="年份必填" />
              </div>
              <div class="clearfix"></div>
          </div>
          <div id="school_id_div" class="form-group">
              <label for="school_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("school_id")?></label>
              <div class="col-sm-10">
                   <select name="AdminSchoolScore[school_id]" id="school_id" class="form-control" >
                    <option>请选择</option>
                    <?php foreach($schoolInfo as $school):?>
                    <option value="<?= $school['id']?>"><?= $school['name']?> </option>
                    <?php endforeach;?>
                    </select>
              </div>
              <div class="clearfix"></div>
          </div>
          <div id="high_score_div" class="form-group">
              <label for="high_score" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("high_score")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="high_score" name="AdminSchoolScore[high_score]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="agv_score_div" class="form-group">
              <label for="agv_score" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("agv_score")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="agv_score" name="AdminSchoolScore[agv_score]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="low_score_div" class="form-group">
              <label for="low_score" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("low_score")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="low_score" name="AdminSchoolScore[low_score]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="diff_score_div" class="form-group">
              <label for="diff_score" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("diff_score")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="diff_score" name="AdminSchoolScore[diff_score]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="plan_count_div" class="form-group">
              <label for="plan_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("plan_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="plan_count" name="AdminSchoolScore[plan_count]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="plan_count_div" class="form-group">
              <label for="number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="number" name="AdminSchoolScore[number]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="rank_div" class="form-group">
              <label for="rank" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="rank" name="AdminSchoolScore[rank]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>
            <div id="batch_id_div" class="form-group">
              <label for="batch_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("batch_id")?></label>
              <div class="col-sm-10">
                   <select name="AdminSchoolScore[batch_id]" id="batch_id" class="form-control" >
                    <option>请选择</option>
                    <?php foreach($batch_arr as $key => $item):?>
                    <option value="<?= $key?>"><?= $item?> </option>
                    <?php endforeach;?>
                    </select>
              </div>
              <div class="clearfix"></div>
          </div> 
            <div id="mold_id_div" class="form-group">
              <label for="mold_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("mold_id")?></label>
              <div class="col-sm-10">
                   <select name="AdminSchoolScore[mold_id]" id="mold_id" class="form-control" >
                    <option>请选择</option>
                    <?php foreach($mold_arr as $key => $item):?>
                    <option value="<?= $key?>"><?= $item?> </option>
                    <?php endforeach;?>
                    </select>
              </div>
              <div class="clearfix"></div>
          </div>     

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> 
        <a id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
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
		$('#admin-school-score-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
        $("#school_id").val('');
		$("#year").val('');
		$("#high_score").val('');
		$("#agv_score").val('');
		$("#low_score").val('');
		$("#diff_score").val('');
		$("#plan_count").val('');
    $("number").val('');
		$("#rank").val('');
		$("#batch_id").val('');
		$("#mold_id").val('');
		
	}
	else{
		$("#id").val(data.id);
		$("#school_id").val(data.school_id);
    	$("#year").val(data.year);
    	$("#high_score").val(data.high_score);
    	$("#agv_score").val(data.agv_score);
    	$("#low_score").val(data.low_score);
    	$("#diff_score").val(data.diff_score);
    	$("#plan_count").val(data.plan_count);
      $("number").val(data.number);
    	$("#rank").val(data.rank);
        $("#batch_id").val(data.batch_id);
		$("#mold_id").val(data.mold_id);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#school_id").attr({readonly:true,disabled:true});
      $("#year").attr({readonly:true,disabled:true});
      $("#high_score").attr({readonly:true,disabled:true});
      $("#agv_score").attr({readonly:true,disabled:true});
      $("#low_score").attr({readonly:true,disabled:true});
      $("#diff_score").attr({readonly:true,disabled:true});
      $("#plan_count").attr({readonly:true,disabled:true});
      $("#number").attr({readonly:true,disabled:true});
      $("#rank").attr({readonly:true,disabled:true});
      $("#batch_id").attr({readonly:true,disabled:true});
      $("#mold_id").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#school_id").attr({readonly:false,disabled:false});
      $("#year").attr({readonly:false,disabled:false});
      $("#high_score").attr({readonly:false,disabled:false});
      $("#agv_score").attr({readonly:false,disabled:false});
      $("#low_score").attr({readonly:false,disabled:false});
      $("#diff_score").attr({readonly:false,disabled:false});
      $("#plan_count").attr({readonly:false,disabled:false});
      $("#number").attr({readonly:false,disabled:false});
      $("#batch_id").attr({readonly:false,disabled:false});
      $("#mold_id").attr({readonly:false,disabled:false});
      $("#rank").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-school-score/view')?>",
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
				   url: "<?=Url::toRoute('admin-school-score/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
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
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
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
	$('#admin-school-score-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-school-score-form').unbind('submit').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-school-score/create')?>" : "<?=Url::toRoute('admin-school-score/update')?>";
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

 
</script>
<?php $this->endBlock(); ?>
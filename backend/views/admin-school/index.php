
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use backend\models\AdminSchool;
use yii\web\UrlManager;

$modelLabel = new \common\models\AdminSchool();
?>

<?php $this->beginBlock('header');  ?>

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
                <?php ActiveForm::begin(['id' => 'admin-school-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('admin-school/index')]); ?>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('name')?>:</label>
                      <input type="text" class="form-control" id="query[name]" name="query[name]"  value="<?=isset($query["name"]) ? $query["name"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('spec')?>:</label>
				   <select class="form-control" name="query[spec]">
					<option value="0">请选择：</option>
                    <?php foreach($cates[1]['children'] as $cate):?>
						 <option value="<?= $cate['id'] ?>" <?php if($query['spec']==$cate['id']):?>selected="selected"<?php endif;?>> <?= $cate['name']?></option>
                    <?php endforeach;?>
				  </select>
                  </div>
                  <div class="form-group" style="margin: 5px;">
                        <label><?=$modelLabel->getAttributeLabel('location')?>:</label>
                        <select  class="form-control" name="query[location]">
						 <option value="0">请选择：</option>
                          <?php foreach($cates[3]['children'] as $cate):?>
                                 <option value="<?= $cate['id'] ?>" <?php if($query['location']==$cate['id']):?>selected="selected"<?php endif;?>> <?= $cate['name']?></option>
                          <?php endforeach;?>
                        </select>
                  </div>
                  <div class="form-group" style="margin: 5px;">
                        <label><?=$modelLabel->getAttributeLabel('type')?>:</label>
                        <select class="form-control" name="query[type]">
						 <option value="0">请选择：</option>
                          <?php foreach($cates[2]['children'] as $cate):?>
                                 <option value="<?= $cate['id'] ?>"<?php if($query['type']== $cate['id']):?>selected="selected"<?php endif;?> > <?= $cate['name']?></option>
                          <?php endforeach;?>
                        </select>
                  </div>
                   <div class="form-group" style="margin: 5px;">
                        <label><?=$modelLabel->getAttributeLabel('batch')?>:</label>
                        <select class="form-control" name="query[batch]">
						 <option value="0">请选择：</option>
                          <?php foreach($cates[0]['children'] as $cate):?>
                                 <option value="<?= $cate['id'] ?>" <?php if($query['batch'] ==$cate['id']):?>selected="selected"<?php endif;?>> <?= $cate['name']?></option>
                          <?php endforeach;?>
                        </select>
                  </div>
                   <div class="form-group" style="margin: 5px;">
                        <label>科目</label>
                        <select class="form-control" name="query[mold]">
						 <option value="-1">请选择：</option>
                         <option value="0" <?php if($query['mold'] ==0):?>selected="selected"<?php endif;?>> 文科</option>
                         <option value="1" <?php if($query['mold'] ==1):?>selected="selected"<?php endif;?>> 理科</option>
                         <option value="2" <?php if($query['mold'] ==2):?>selected="selected"<?php endif;?>> 其他</option>
                        </select>
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
              echo '<th onclick="orderby(\'name\', \'desc\')" '.CommonFun::sortClass($orderby, 'name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name').'</th>';
              echo '<th onclick="orderby(\'success_rate\', \'desc\')" '.CommonFun::sortClass($orderby, 'success_rate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('success_rate').'</th>';
              echo '<th onclick="orderby(\'location\', \'desc\')" '.CommonFun::sortClass($orderby, 'location').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('location').'</th>';
              echo '<th onclick="orderby(\'batch\', \'desc\')" '.CommonFun::sortClass($orderby, 'batch').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('batch').'</th>';
              echo '<th onclick="orderby(\'type\', \'desc\')" '.CommonFun::sortClass($orderby, 'type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('type').'</th>';
              echo '<th onclick="orderby(\'type\', \'desc\')" '.CommonFun::sortClass($orderby, 'status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('status').'</th>';
              echo '<th onclick="orderby(\'spec\', \'desc\')" '.CommonFun::sortClass($orderby, 'spec').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spec').'</th>';
			  echo '<th onclick="orderby(\'mold\', \'desc\')" '.CommonFun::sortClass($orderby, 'mold').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('mold').'</th>';
			  echo '<th onclick="orderby(\'sort\', \'desc\')" '.CommonFun::sortClass($orderby, 'sort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sort').'</th>';
              echo '<th onclick="orderby(\'phone\', \'desc\')" '.CommonFun::sortClass($orderby, 'phone').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('phone').'</th>';
              echo '<th onclick="orderby(\'email\', \'desc\')" '.CommonFun::sortClass($orderby, 'email').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('email').'</th>';
              echo '<th onclick="orderby(\'website\', \'desc\')" '.CommonFun::sortClass($orderby, 'website').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('website').'</th>';
              echo '<th onclick="orderby(\'score\', \'desc\')" '.CommonFun::sortClass($orderby, 'score').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('score').'</th>';
            //echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
              // echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';

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
                echo '  <td>' . $model->name . '</td>';
                echo '  <td>' . $model->success_rate . '</td>';
                echo '  <td>' . $model->location . '</td>';
                echo '  <td>' . $model->batch . '</td>';
                echo '  <td>' . $model->type . '</td>';
                echo '  <td>' . ($model->status  == '1'?'是':'否' ) . '</td>';
                echo '  <td>' . $model->spec . '</td>';
                //echo '  <td>' . $model->intro . '</td>';
                echo '  <td>' . $model->mold . '</td>';
                echo '  <td>' . $model->sort . '</td>';
                echo '  <td>' . $model->phone . '</td>';
                echo '  <td>' . $model->email . '</td>';
                echo '  <td>' . $model->website . '</td>';
                echo '  <td class="view_score" data-id="'. $model->id .'">' . '<button type="button" class="btn btn-primary btn-sm">编辑分数</button>'. '</td>';
                //echo '  <td>' . $model->create_time . '</td>';
                // echo '  <td>' . $model->update_time . '</td>';
                echo '  <td class="center">';
				echo '      <a id="delete_btn" onclick="addAction(' . $model->id . ')" class="btn btn-info btn-sm" href="#"> <i class="glyphicon glyphicon-plus-sign icon-white"></i>增加分数</a>';
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

<div class="modal fade" id="add_dialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>分数列表</h3>
			</div>
			<div class="modal-body">
				<div id="name_div" class="form-group">
                    <form id="add_score_form">
                        <input type="hidden" class="form-control" id="school_id" name="school_id"  value=""/>
                        <table id="add_score" class="table table-striped">
                          <thead>
                            <tr>
                              <th>年份</th>
							                <th>最高分</th>
                              <th>最低分</th>
                              <th>省控线</th>
                              <th>分差</th>
                              <th>计划数</th>
                              <th>投档数</th>
                              <th>排位</th>
                              <th>批次</th>
                              <th>科目</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </form>
				</div>
			</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" id="add_line" style="float:left">加一行</button>
				 <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="add_dialog_ok" href="#" class="btn btn-primary">确定</a>
				</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-school-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-school/save")]); ?>

          <input type="hidden" class="form-control" id="id" name="id"  value=""/>
          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="AdminSchool[name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="success_rate_div" class="form-group">
              <label for="success_rate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("success_rate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="success_rate" name="AdminSchool[success_rate]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="location_div" class="form-group">
              <label for="location" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("location")?></label>
              <div class="col-sm-10">
				  <select id="location" class="form-control" name="AdminSchool[location]">
						 <option value="0">请选择：</option>
				  <?php foreach($cates[3]['children'] as $cate):?>
						 <option value="<?= $cate['id'] ?>"> <?= $cate['name']?></option>
				  <?php endforeach;?>
				  </select>
			  </div>
              <div class="clearfix"></div>
          </div>

          <div id="batch_div" class="form-group">
              <label for="batch" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("batch")?></label>
              <div class="col-sm-10">
				   <select id="batch" class="form-control" name="AdminSchool[batch]">
						 <option value="0">请选择：</option>
				  <?php foreach($cates[0]['children'] as $cate):?>
                        <option  value="<?= $cate['id'] ?>"> <?= $cate['name']?></option>
				  <?php endforeach;?>
				  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="type_div" class="form-group">
              <label for="type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("type")?></label>
              <div class="col-sm-10">
				   <select id="type"class="form-control"  name="AdminSchool[type]">
						<option value="0">请选择：</option>
				  <?php foreach($cates[2]['children'] as $cate):?>
						 <option value="<?= $cate['id'] ?>"> <?= $cate['name']?></option>
				  <?php endforeach;?>
				  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="action_id_div" class="form-group">
              <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
              <div class="col-sm-10">
                  <select id="status"  class="form-control" name="AdminSchool[status]">
                     <option value="-1">请选择：</option>
                    <option value="1">是</option>
                    <option value="0">否</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spec_div" class="form-group">
              <label for="spec" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spec")?></label>
              <div class="col-sm-10">
                  <!--<select id="spec" class="form-control" name="AdminSchool[spec]">-->
                      <!--<option value="0">请选择     ：</option>-->
				  <?php foreach($cates[1]['children'] as $cate):?>
                          <label class="checkbox-inline">
                              <input type="checkbox" class="spec" name="AdminSchool[spec][]" value="<?= $cate['id'] ?>" <?php if($query['spec'] != 0):?>selected="selected"<?php endif;?>>
                              <?= $cate['name']?>
                          </label>
						<!-- <option value="<?= $cate['id'] ?>"> <?= $cate['name']?></option>-->
				  <?php endforeach;?>
                  <!--</select>-->

              </div>
              <div class="clearfix"></div>
          </div>
          <div id="mold_div" class="form-group">
              <label for="mold" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("mold")?></label>
              <div class="col-sm-10">
				   <select id="mold" class="form-control" name="AdminSchool[mold]">
						<option  value="-1">请选择：</option>
						 <option value="0"> 文科</option>
						 <option value="1"> 理科</option>
						 <option value="2"> 其他</option>
				  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sort_div" class="form-group">
              <label for="sort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sort")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sort" name="AdminSchool[sort]" placeholder="排序" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="brief_intro_div" class="form-group">
              <label for="brief_intro" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("brief_intro")?></label>
              <div class="col-sm-10">
                 <?= CKEditor::widget([
							'editorOptions' => [
								'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
								'inline' => false, //по умолчанию false
							    'filebrowserImageUploadUrl' => Url::to(['admin-school/upload']),
							    'language' => 'zh-cn',
							],
							'name' => "AdminSchool[brief_intro]",
							'id' => 'brief_intro',
						]);

				  ?>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="intro_div" class="form-group">
              <label for="intro" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("intro")?></label>
              <div class="col-sm-10">
				  <?= CKEditor::widget([
							'editorOptions' => [
								'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
								'inline' => false, //по умолчанию false
							    'filebrowserImageUploadUrl' => Url::to(['admin-school/upload']),
							    'language' => 'zh-cn',
							],
							'name' => "AdminSchool[intro]",
							'id' => 'intro',
						]);

				  ?>
              </div>
              <div class="clearfix"></div>
          </div>
          <div id="intro_div" class="form-group">
              <label for="intro" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("professional_score")?></label>
              <div class="col-sm-10">
				  <?= CKEditor::widget([
							'editorOptions' => [
								'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
								'inline' => false, //по умолчанию false
							    'filebrowserImageUploadUrl' => Url::to(['admin-school/upload']),
							    'language' => 'zh-cn',
							],
							'name' => "AdminSchool[professional_score]",
							'id' => 'professional_score',
						]);

				  ?>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="phone_div" class="form-group">
              <label for="phone" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("phone")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="AdminSchool[phone]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="email_div" class="form-group">
              <label for="email" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="AdminSchool[email]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="website_div" class="form-group">
              <label for="website" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("website")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="website" name="AdminSchool[website]" placeholder="" />
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
    var batch_arr = new Array();
    var operate_type = '';
    <?php foreach($cates[0]['children'] as $cate):?>
        batch_arr[<?= $cate['id']?>] = "<?= $cate['name']?>"
    <?php endforeach?>
    var mold_arr = new Array();
    mold_arr[0] = "文科";
    mold_arr[1] = "理科";
    mold_arr[2] = "其他";

    function scoreRemove(obj)
    {
      obj.parent().parent('tr').remove()
    }
$(".view_score").click(function(e){
    operate_type = "edit";
    e.preventDefault();
    var id = $(this).attr('data-id');
    $("#school_id").val(id);
    $.ajax({
       type: "GET",
       url: "<?=Url::toRoute('admin-school/view-score')?>",
       data: {"id":id},
       cache: false,
       dataType:"json",
       error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("出错了，" + textStatus);
        },
       success: function(data){
            $("#add_score tbody").html('');
            $.each(data, function(i, n){
                var str = '<tr>'
                +'<input type="hidden" name="id[]" value="'+n.id+'">'
                +'<td><input type="text"  class="form-control" placeholder="年份"  name="year[]" value="'+n.year+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="最高分" name="high_score[]" value="'+n.high_score+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="最低分" name="low_score[]" value="'+n.low_score+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="省控线" name="agv_score[]" value="'+n.agv_score+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="分差" name="diff_score[]" value="'+n.diff_score+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="计划数" name="plan_count[]" value="'+n.plan_count+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="投档数" name="number[]" value="'+n.number+'"></td>'
                +'<td><input type="text" class="form-control" placeholder="排位" name="rank[]" value="'+n.rank+'"></td>'             
               ;

           str +="<td><select name='batch_id[]'>";
            var selected1 = '';

            for(var tmp in batch_arr){
                if (tmp == n.batch_id) {
                    selected1 = "selected=selected";
                }
                
                str += '<option '+ selected1 +' value="' + tmp + '">'+ batch_arr[tmp]+'</option>';
                selected1 = '';
            }
          
            str += "</select></td>"

            str +="<td><select name='mold_id[]'>";
            var selected2 = '';
            for(var tmp1 in mold_arr){
                if (tmp1 == n.mold_id) {
                    selected2 = "selected=selected";
                }
                str += '<option '+ selected2 +' value="' + tmp1 + '">'+ mold_arr[tmp1]+'</option>';
                selected2 = '';
            }
       
            str += "</select></td>";
            str += "</tr>";
            
                $("#add_score tbody").append(str);
            });
            //$("#add_dialog_ok").hide();
            $("#add_line").hide();
            $('#add_dialog').modal('show');
       }
    });
});

$('#add_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#add_score_form').submit();
});
 function addAction(id)
 {    
     operate_type = 'add';  
	 $("#school_id").val(id);
     $('#add_dialog').modal('show');
     $("#add_dialog_ok").show();
     $("#add_line").show();
     $("#add_score tbody").html('');
 }
   var str = '<tr>'
          +'<td><input  type="text" class="datepicker form-control"  name="year[]" placeholder="年份"  value=""></td>'
		  +'<td><input  type="text" class="form-control" placeholder="最高分" name="high_score[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="最低分" name="low_score[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="省控线" name="agv_score[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="分差" name="diff_score[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="计划数" name="plan_count[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="投档数" name="number[]" value=""></td>'
          +'<td><input  type="text" class="form-control" placeholder="排位" name="rank[]" value=""></td>'

           str +="<td><select name='batch_id[]'>";
          <?php foreach($cates[0]['children'] as $cate):?>
            str += '<option value="' + <?php echo $cate['id'] ?> + '">'+ "<?php echo $cate['name']?>"+'</option>';
	      <?php endforeach;?>
            str += "</select></td>"
            str += '<td><select name="mold_id[]"><option value="0">文科</option><option value="1">理科</option><option value="2">其他</option></select></td>'
            str += '<td><a class="btn btn-danger btn-sm" onclick="scoreRemove($(this));" href="javascript:;"><i class="glyphicon glyphicon-minus"></i></a></td>'
            +'</tr>';

 $('#add_line').click(function(){

     $("#add_score tbody").append(str);
});


$('#add_score_form').bind('submit', function(e) {
	e.preventDefault();
	var id = school_id;
	var action = "<?= Url::toRoute('admin-school/add-score')?>" ;
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	success: function(value)
    	{
        	if(value.errno == 0){
        		$('#add_dialog').modal('hide');
        		alert(value.message);
        		//window.location.reload();
        	}
        	else{alert(value.message);
				
        	}

    	}
    });
});

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
		$('#admin-school-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#name").val('');
		$("#success_rate").val('');
		$("#location").val('0');
		$("#batch").val('0');
		$("#type").val('0');
	    $("#status").val('-1');
		//$("#spec").val('0');
		$("#mold").val('-1');
		$("#sort").val('');
		$("#brief_intro").val('');
        $("#professional_score").val('');
		$("#intro").val('');
		$("#phone").val('');
		$("#email").val('');
		$("#website").val('');
		$("#score").val('');
		$("#create_time").val('');
		$("#update_time").val('');
		CKEDITOR.instances.brief_intro.setData('');
		CKEDITOR.instances.professional_score.setData('');
		CKEDITOR.instances.intro.setData('');
	}
	else{
		$("#id").val(data.id);
    	$("#name").val(data.name);
    	$("#success_rate").val(data.success_rate);
    	$("#location").val(data.location);
    	$("#batch").val(data.batch);
    	$("#type").val(data.type);
        $("#status").val(data.status);

        $("[class = spec]:checkbox").each(function (i, e) {
            for (var i = 0; i < data.spec.length; i++) {
                if ($(this).val() == data.spec[i]) {
                    $(this).attr("checked", true);
                }
            }
        });
        //$("#spec").val(data.spec);

        $("#mold").val(data.mold);
		$("#sort").val(data.sort);
		//$("#brief_intro").val(data.brief_intro);
        CKEDITOR.instances.brief_intro.setData(data.brief_intro);
		CKEDITOR.instances.intro.setData(data.intro);
		CKEDITOR.instances.professional_score.setData(data.professional_score);
    	//$("#intro").val(data.intro);
    	$("#phone").val(data.phone);
    	$("#email").val(data.email);
    	$("#website").val(data.website);
    	$("#score").val(data.score);
    	$("#create_time").val(data.create_time);
    	$("#update_time").val(data.update_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#success_rate").attr({readonly:true,disabled:true});
      $("#location").attr({readonly:true,disabled:true});
      $("#batch").attr({readonly:true,disabled:true});
      $("#type").attr({readonly:true,disabled:true});
      $("#status").attr({readonly:true,disabled:true});
      $("#spec").attr({readonly:true,disabled:true});
      $("#mold").attr({readonly:true,disabled:true});
	  $("#sort").attr({readonly:true,disabled:true});
	  $("#brief_intro").attr({readonly:true,disabled:true});
	  $("#professional_score").attr({readonly:true,disabled:true});
      $("#intro").attr({readonly:true,disabled:true});
      $("#phone").attr({readonly:true,disabled:true});
      $("#email").attr({readonly:true,disabled:true});
      $("#website").attr({readonly:true,disabled:true});
      $("#score").attr({readonly:true,disabled:true});
      $("#create_time").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#success_rate").attr({readonly:false,disabled:false});
      $("#location").attr({readonly:false,disabled:false});
      $("#batch").attr({readonly:false,disabled:false});
      $("#type").attr({readonly:false,disabled:false});
      $("#status").attr({readonly:false,disabled:false});
      $("#spec").attr({readonly:false,disabled:false});
        $("[class = spec]:checkbox").each(function (i, e) {
            if (data.length > 0 &&  data.spec.length > 0) {
                for (var i = 0; i < data.spec.length; i++) {
                    if ($(this).val() == data.spec[i]) {
                        $(this).attr("checked", true);
                    }
                }
            }
        });
      $("#mold").attr({readonly:false,disabled:false});
	  $("#sort").attr({readonly:false,disabled:false});
	  $("#brief_intro").attr({readonly:false,disabled:false});
	  $("#professional_score").attr({readonly:false,disabled:false});
      $("#intro").attr({readonly:false,disabled:false});
      $("#phone").attr({readonly:false,disabled:false});
      $("#email").attr({readonly:false,disabled:false});
      $("#website").attr({readonly:false,disabled:false});
      $("#score").attr({readonly:false,disabled:false});
      $("#create_time").attr({readonly:false,disabled:false});
      $("#update_time").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){

	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-school/view')?>",
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
				   url: "<?=Url::toRoute('admin-school/delete')?>",
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
	$('#admin-school-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-school-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-school/create')?>" : "<?=Url::toRoute('admin-school/update')?>";

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

    var $modalElement = this.$element;
    $(document).on('focusin.modal', function (e) {
        var $parent = $(e.target.parentNode);
        if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length
            &&
            !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
            $modalElement.focus()
        }
    });

</script>
<?php $this->endBlock(); ?>
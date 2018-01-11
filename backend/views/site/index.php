<?php
    use mihaildev\ckeditor\CKEditor;
    use yii\helpers\Url;
?>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
		<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">系统信息</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 200px">名称</th>
                  <th>信息</th>
                  <th style="width: 200px">说明</th>
                </tr>
                <?php 
                    $count = 1;
                    foreach($sysInfo as $info){
    			       echo '<tr>';
    			       echo '  <td>'. $count .'</td>';
    			       echo '  <td>'.$info['name'].'</td>';
    			       echo '  <td>'.$info['value'].'</td>';
    			       echo '  <td></td>';
    			       echo '</tr>';
    			       $count++;
    			   }
    			   ?>
        
              </table>   
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->
		</div>
		
		
	</div>
	<!-- /.row -->
	<!-- Main row --
	<div class="row">
        <div class="modal-dialog" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>首页图片管理</h3>
			</div>
		
<form method="post">
         <div class="modal-body">
		  <div id="brief_intro_div" class="form-group">
              <label for="brief_intro" class="col-sm-2 control-label">图片上传</label>
              <div class="col-sm-10">
                 <?= CKEditor::widget([
							'editorOptions' => [
								'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
								'inline' => false, //по умолчанию false
							    'filebrowserImageUploadUrl' => Url::to(['admin-school/upload']),
							    'language' => 'zh-cn',
							],
							'name' => "brief_intro",
							'id' => 'brief_intro',
						]);

				  ?>
              </div>
              <div class="clearfix"></div>
          </div>
          
                  <div class="form-group" style="margin: 5px;">
                      <label>图片1:</label>
                      <input type="text" class="form-control" id="img[name]" name="img[]"  value="<?=isset($img[0]) ? $img["0"] : "" ?>">
                  </div>
  <div class="form-group" style="margin: 5px;">
                      <label>图片2:</label>
                      <input type="text" class="form-control" id="img[name]" name="img[]"  value="<?=isset($img[1]) ? $img[1] : "" ?>">
                  </div>
  <div class="form-group" style="margin: 5px;">
                      <label>图片3:</label>
                      <input type="text" class="form-control" id="img[name]" name="img[]"  value="<?=isset($img[2]) ? $img[2] : "" ?>">
                  </div>
  <div class="form-group" style="margin: 5px;">
                      <label>图片4:</label>
                      <input type="text" class="form-control" id="img[name]" name="img[]"  value="<?=isset($img[3]) ? $img[3] : "" ?>">
                  </div>
<div class="modal-footer">
<input type="submit"></input>
			</div></form>
        </div></div></div>
	</div>
	<!-- /.row (main row) -->

</section>
<!-- /.content -->
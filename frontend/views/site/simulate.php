

<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->params['breadcrumbs'] =[
    [
        'label' => '筛选学校',
        'url' => ['site/lsucc'],
    ],
    [
        'label' => '志愿模拟',
        'url' => ['site/school-list',
            'batch' => app()->request->post('batch'),
            'mold' => app()->request->post('mold'),
        ],
    ],
    '志愿结果',
   
]
?>

<!-- header -->
<?php include 'header.php';?>
<!-- content -->

<div id="content">
    <div class="container">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;">
          <div class="row">
    <div class="span24 doc-content">
      <form class="form-horizontal">
        <div class="row show-grid" style="background:#13140D1A;">
          <div class="span8" style="width: 218px;padding-top: 6px;padding-left: 6px;">
                     <span  style="font-size: 28px;line-height: 1.2em;color: #000;font-weight: 600;">模拟志愿</span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <hr/>
<div class="row">
<div style="margin: 0 auto;">
  <div class="span12 offset3 doc-content" style="width:  888px;margin-left: 52px;">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th rowspan="3"></th>
            <th rowspan="3" style="text-align:center;">学校名称</th>
            <th colspan="7" style="text-align:center;">分差、计划数、排位变化对比</th>
          </tr>
          <tr>
            <?php foreach($years as $year):?>
            <th style="text-align:center;"><?= $year?><br>
			    
                  <strong style="color:red;font-size:10px;">分差</strong>
                   |
                   <strong style="color:#20B2AA;font-size:10px;">计划数</strong>
                  <br>
                   <strong style="color:#3CB371;font-size:10px;">排位</strong></td> 
            </th>
            <?php endforeach;?>
          </tr>
        </thead>
        <tbody>
          <tr></tr>
            <?php foreach($chart as $k => $item):?>
                <tr>
                <td style="text-align:center;"><?= $k+1?></td>
                <td style="text-align:center;"><?= $item['name']?></td>
                <?php foreach($item['data'] as $diff_score):?>
                   <td style="text-align:center;">
                   <?php if(!empty($diff_score['diff_score'])):?>
                   <strong style="color:red;"><?= $diff_score['diff_score'] ?></strong>
                   <?php else:?>
                    <strong style="color:red;">0</strong>
                   <?php endif;?>
                   |
                   <?php if(!empty($diff_score['plan_count'])):?>
                   <strong style="color:#20B2AA;"><?= $diff_score['plan_count']?></strong>
                  <?php else:?>
                    <strong style="color:#20B2AA;">0</strong>
                   <?php endif;?>
                   <br>
                   <?php if(!empty($diff_score['rank'])):?>
                   <strong style="color:#3CB371"><?= $diff_score['rank']?></strong></td> 
                   <?php else:?>
                    <strong style="color:#20B2AA;">0</strong>
                   <?php endif;?>
                <?php endforeach;?>
                </tr>   
            <?php endforeach;?>
        </tbody>
      </table>
  </div>
  <div id="c1"></div>
</div>
</div>
    </div>
</div>
</div>
</div>
<?php $this->beginBlock('footer');  ?>
<script>
      var data = <?= json_encode($chart1)?>;
      for(var i=0; i < data.length; i++) {
        var item = data[i];
        var datas = item.data;
        var months = <?= json_encode($years)?>;
        
        for(var j=0; j < datas.length; j++) {
          item[months[j]] = parseInt(datas[j]);
        }
        data[i] = item;
      }
      var Stat = G2.Stat;
      var Frame = G2.Frame;
      var frame = new Frame(data);
      frame = Frame.combinColumns(frame, <?= json_encode($years)?>,'分数','年份','name');
      var chart = new G2.Chart({
        id: 'c1',
        forceFit: true,
        height : 350,
        plotCfg: {
          margin: [20,90,60,60]
        }
      });
      chart.source(frame);
      chart.col('name',{alias: '学校'});
      chart.intervalDodge().position('年份*分数').color('name');
      chart.render();
      
      $('#canvas_2').css("top", null);
      $('#canvas_3').css("top", null);
    </script>
<?php $this->endBlock();  ?>
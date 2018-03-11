<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '贵州高考报考查询测算平台';
$this->params['breadcrumbs'] =[
    'school',
]
?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;float: null;">
                <div class="article">
				 <h4 style="font-size: 36px;line-height: 1.2em;margin-bottom: 10px;text-align:center;"><?= $school->name?></h4>
<div style="width:100%;height:auto;">
<script src="/frontend/web/js/jquery.tab.js"></script>

    <script type="text/javascript">

        $(function(){

           $("#div1").hide(); //先让div隐藏

            $("#span1").click(function(){

                  $("#div1").fadeIn("slow");//淡入淡出效果 显示div
				  

            });

            $("#span2").click(function(){

                     $("#div1").fadeOut("slow");//淡入淡出效果 隐藏div

            })

        });
		
		$(function(){

           $("#div3").hide(); //先让div隐藏

            $("#span3").click(function(){

                  $("#div3").fadeIn("slow");//淡入淡出效果 显示div
				  

            });

            $("#span4").click(function(){

                     $("#div3").fadeOut("slow");//淡入淡出效果 隐藏div

            })

        });

    </script>


<!-- <span style="cursor:pointer" id="span1"><h4>学校简介</h4></span>

 <div id="div1">

   <div class="right" style="background-color:#CDCDCD;"><span id="span2" style="cursor:pointer">关闭</span>

   </div>

   <div class="school-body"><?= mb_substr($school->intro,0,900000,"utf-8"); ?></div>


</div> -->


<span style="cursor:pointer" ><h4><a href="http://gaokao.chsi.com.cn/zsgs/zhangcheng/listVerifedZszc--method-index,lb-1.dhtml" target="_blank">招生简章>></a></h4></span>
<hr/>
<span style="cursor:pointer;margin-top:20px;" ><h4><a href="#" onclick="showContent();" style="color:blue;">学校简介</a></h4></span>
<hr/>
 <!-- <div id="div3"> -->

<!--    <div class="right" style="background-color:#CDCDCD;"><span id="span4" style="cursor:pointer">关闭</span>
   </div> -->

   <!-- <div class="school-body"><?= mb_substr($school->brief_intro,0,900000,"utf-8"); ?></div> -->


<!-- </div> -->

</div>
			<div id="outer">
<!-- 				<ul id="tab">
					<li class="current">招生简章</li>
				</ul> -->
				<div id="school-content">
					<ul style="display:block;">
					 <li><?= mb_substr($school->intro,0,500,"utf-8"); ?></li>
					</ul>
					<ul>
            <div style="display: none" id="schoolContent">
						<li><?= mb_substr($school->brief_intro,0,900000,"utf-8"); ?></li>
            </div>
					</ul>
					
				</div>
			</div>


<script>
	$(function(){
		window.onload = function()
		{
			var $li = $('#tab li');
			var $ul = $('#school-content ul');
						
			$li.mouseover(function(){
				var $this = $(this);
				var $t = $this.index();
				$li.removeClass();
				$this.addClass('current');
				// $ul.css('display','none');
				$ul.eq($t).css('display','block');
			})
		}
	});
  function showContent(){
    var i=document.getElementById("schoolContent");
    if (i.style.display == "none") {  
      i.style.display = "block";     
    }else{     
      i.style.display = "none";     
    }   
  }
</script>             
                    <div>               
<div class="row">
                        <div class="" style="margin:0 auto;width:620px;">
                        <p>2010-2016年录取分数线情况</p>
                        <table cellspacing="0" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                              	<th>年份	</th>
                              	<th>最高分</th>
                              	<th>平均分</th>
                              	<th>省控线</th>
                              	<th>分差</th>
                              	<th>计划数</th>
                              	<th>排位	</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                              <tr>
                              	<td><?= $score['year']?></td>
                              	<td><?= $score['high_score']?></td>
                              	<td><?= $score['agv_score']?></td>
                              	<td><?= $score['low_score']?></td>
                              	<td><?= $score['diff_score']?></td>
                              	<td><?= $score['plan_count']?></td>
                              	<td><?= $score['rank']?></td>
                              </tr>
                              <?php endforeach;?>
                              <?php endif;?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="" style="margin:0 auto;width:620px;">
                        <p>2010-2016年录取分数线情况</p><a class="see_professional_score" style="float:left;">查看该校专业分数</a>
                        <table cellspacing="0" class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <th>年份</th>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                                <th><?= $score['year']?></th>
                              <?php endforeach;?>
                              <?php endif;?>
                              </tr>

                              <tr>
                                <th>最低录取分数线</th>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                                <th><?= $score['low_score']?></th>
                              <?php endforeach;?>
                              <?php endif;?>
                              </tr>

                              <tr>
                                <th>省控线</th>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                                <th><?= $score['agv_score']?></th>
                              <?php endforeach;?>
                              <?php endif;?>
                              </tr>

                              <tr>
                                <th>计划数</th>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                                <th><?= $score['plan_count']?></th>
                              <?php endforeach;?>
                              <?php endif;?>
                              </tr>

                              <tr>
                                <th>实际投档数</th>
                              <?php if(!empty($scores)):?>
                              <?php foreach ($scores as $score):?>
                                <th><?= $score['number']?></th>
                              <?php endforeach;?>
                              <?php endif;?>
                              </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- 曲线图 -->
                    <div>
                            <div class="detail-section" style="width:300px;float:left;">
                                <div id="canvas" style="">
                                </div>
                                
                            </div>

                            <div class="detail-section"style="width:300px;float:left;">
                                <div id="canvas1" style="">
                                </div>
                            </div>

                            <div class="detail-section"style="width:300px;float:left;">
                                <div id="canvas2" style="">
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('footer');  ?>
<script type="text/javascript">
    var data =<?= $diff_score ?>; // G2 对数据源格式的要求，仅仅是 JSON 数组，数组的每个元素是一个标准 JSON 对象。
    // Step 1: 创建 Chart 对象
    var chart = new G2.Chart({
      id: 'canvas', // 指定图表容器 ID
      width : 350, // 指定图表宽度
      height : 200,// 指定图表高度
    });
    // Step 2: 载入数据源
    chart.source(data, {
      year: {
        alias: '年份' // 列定义，定义该属性显示的别名
      },
      diff_score: {
        alias: '分差'
      }
    });
    // Step 3：创建图形语法，绘制柱状图，由 genre 和 sold 两个属性决定图形位置，genre 映射至 x 轴，sold 映射至 y 轴
    chart.line().position('year*diff_score').color('#FF6347')
    // Step 4: 渲染图表
    chart.render();

    var data =<?= $plan_count ?>; // G2 对数据源格式的要求，仅仅是 JSON 数组，数组的每个元素是一个标准 JSON 对象。
    // Step 1: 创建 Chart 对象
    var chart1 = new G2.Chart({
      id: 'canvas1', // 指定图表容器 ID
      width : 350, // 指定图表宽度
      height : 200,// 指定图表高度
    });
    // Step 2: 载入数据源
    chart1.source(data, {
      year: {
        alias: '年份' // 列定义，定义该属性显示的别名
      },
      plan_count: {
        alias: '计划数'
      }
    });
    // Step 3：创建图形语法，绘制柱状图，由 genre 和 sold 两个属性决定图形位置，genre 映射至 x 轴，sold 映射至 y 轴
    chart1.line().position('year*plan_count').color('#8B0000')
    // Step 4: 渲染图表
    chart1.render();

     var data =<?= $rank ?>; // G2 对数据源格式的要求，仅仅是 JSON 数组，数组的每个元素是一个标准 JSON 对象。
    // Step 1: 创建 Chart 对象
    var chart2 = new G2.Chart({
      id: 'canvas2', // 指定图表容器 ID
      width : 350, // 指定图表宽度
      height : 200,// 指定图表高度
    });
    // Step 2: 载入数据源
    chart2.source(data, {
      year: {
        alias: '年份' // 列定义，定义该属性显示的别名
      },
      rank: {
        alias: '排位数'
      }
    });
    // Step 3：创建图形语法，绘制柱状图，由 genre 和 sold 两个属性决定图形位置，genre 映射至 x 轴，sold 映射至 y 轴
    chart2.line().position('year*rank').color('#68228B')
    // Step 4: 渲染图表
    chart2.render();

    //添加样式
    // $('#canvas_2').css({"padding-left":"80px"});
    // $('#canvas_3').css({"padding-left":"80px"});
    // $('#canvas_5').css({"padding-left":"80px"});
    // $('#canvas_6').css({"padding-left":"80px"});
    // $('#canvas_8').css({"padding-left":"80px"});
    // $('#canvas_9').css({"padding-left":"80px"});

    $(".see_professional_score").click(function () {
        $.ajax({
            'url' : '<?= \yii\helpers\Url::toRoute('site/get-professional-score')?>',
            'dataType' : 'json',
            'data' : 'schoolId=' + <?= $school['id']?>,
            'type' : 'get',
            'success': function (res) {
                if (res.code == 0) {
                } else {
                    alert(res.message);
                }
            }
        });
    });
</script>
<?php $this->endBlock();  ?>
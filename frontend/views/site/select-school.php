<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
?>
<!-- header -->
<div class="clear"></div>
<div id="content">
    <div class="list-banner"><img src="/frontend/web/images/list-banner.jpg" alt=""></div>
    <div class="main">
        <div class="container">
            <h3>志愿模拟</h3>
            <div class="main-moni">
                <form id="submitForm" action="<?= Url::toRoute('site/simulate')?>" method="post">
                    <div class="choose-school">
                        <h4><?= in_array(5, $data['batchIds']) ? '一' : '二' ?>本平行志愿</h4>
                        <?php foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $item): ?>
                            <?php
                            $gray = '';
                            if (in_array(7, $data['batchIds'])) {
                                if ($data['batch_2'] < $item) {
                                    $gray = 'gray';
                                }
                            }
                            ?>
                            <div class="list <?= $gray ?>">
                                <div class="left"><span>第<?= $item ?>平行志愿</span>
                                    <input type="text" value="" name="schoolName[]" placeholder="第<?= $item ?>平行志愿"/>
                                    <input type="hidden" value="" name="school[]"/>
                                </div>
                                <div class="btn-more" data-val="<?= $item ?>"><a href="javascript:vido(0)">更多学校</a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="school-list">
                                    <form id="compareForm<?=$item ?>" action="<?= Url::toRoute('site/compare-school')?>" method="post">
                                        <div class="close-btn"><a href="javascript:vido(0)" class="">
                                                <span style="float: right;">关闭</span>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="school-list-box">
                                            <?php if (!empty($data['schools'][$item])):?>
                                            <?php foreach ($data['schools'][$item] as $school): ?>
                                                <div>
                                                    <a href="javascript:vido(0)"><i>加入填报</i></a>
                                                    <input type="checkbox"
                                                     name="checkSchool[]"
                                                     value="<?= $school['name'] ?>" data-val="<?= $school['id'] ?>"/><?= $school['name'] ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <?php else:?>
                                            暂无学校数据
                                            <?php endif;?>
                                        </div>
                                        <div class="clearfix"></div>
<!--                                         <div class="db-btn">
                                            <a href="javascript:"  data-submit="compareForm<?=$item ?>" onclick="chkschool1(<?=$item ?>)">加入对比</a>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <script>

                            $(".btn-more").click(function () {
                                $(".school-list").hide();
                                $(this).siblings(".school-list").show();
                                var item = $(this).attr('data-val');


                            })
                            $(".school-list a").click(function () {
                                var strval = $(this).siblings("input").val();
                                var idVal = $(this).siblings("input").attr('data-val');

                                $(this).parents(".list").find("input[type='text']").val(strval);
                                $(this).parents(".list").find("input[type='hidden']").val(idVal);
                            })
                            $(".school-list .close-btn a").click(function () {
                                $(".school-list").hide();

                            })
                        </script>
                        <div class="moni-btn"><a onclick="chkschool();">
                                <button>确定</button>
                            </a></div>
                        <p style="text-align: center">温馨提示：灰色志愿为老三本院校</p>

                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<div class="clear"></div>
<!--版权-->
<script>
    function chkschool() { //jquery获取复选框值
        var chk_value = [];
        $('input[name="school[]"]').each(function () {
            chk_value.push($(this).val());
        });
        if (chk_value.length == 0) {
            alert(chk_value.length == 0 ? '你还没有填写志愿！' : chk_value);
            return false;
        }
        $("#submitForm").submit();
    }
  function chkschool1($item){ //jquery获取复选框值
    var chk_value =[];
    $('input[name="checkSchool[]"]:checked').each(function(){
        chk_value.push($(this).val());
    });
    if (chk_value.length == 0) {
        alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
        return false;
    }
    var id = "compareForm"+$item;
    $("#"+id).submit();
    }

    //侧边工具栏
    Do.ready(function (t) {
        var n = $("#J-g-dish");

        function scrollTop() {
            $("#J-g-dish-gotop").on("click", function (e) {
                e.preventDefault();
                $("html, body").animate({
                    scrollTop: 0
                }, 300)
            })
        }

        function preventClick() {
            n.on("click", ".wx a.icon", function (t) {
                t.preventDefault()
            }).on("click", ".faq a.icon", function (t) {
                t.preventDefault()
            })
        }

        if (n[0]) {
            scrollTop();
            preventClick();
        }
        //
        $(".submit01").click(function () {

            var grade = $("#grade").val();
            var patrn = /^[0-9]*[1-9][0-9]*$/;

            if (grade == '' || grade == null) {
                alert("请输入分数!");
            }
            else if (patrn.exec(grade) == null) {
                alert("请输入正确的分数!");
            }
            else {
                $(".fencha-box").show();
            }
        });
        $(".close-btn").click(function () {
            $(".fencha-box").hide();
        })


    })

</script>
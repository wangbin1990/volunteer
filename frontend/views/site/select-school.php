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
                  <form id="submitForm" action="simulate" method="post">
                    <div class="choose-school">
                         <h4>一本平行志愿</h4>
                         <div class="list">
                              <div class="left"><span>第一平行志愿</span><input type="text" value="第一天平行志愿" name="school[]"placeholder="第一天平行志愿" /></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="">加入对比</a>
                                     </div>
                                </div>
                           </div>

                          
                          <div class="list">
                              <div class="left"><span>第二平行志愿</span><input type="text" class="schoolval" name="school[]" placeholder="第二平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="">加入对比</a>
                                     </div>
                              </div>
                          </div>
                          <div class="list">
                              <div class="left"><span>第三平行志愿</span><input type="text"  name="school[]" placeholder="第三平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="">加入对比</a>
                                     </div>
                                </div>
                          </div>
                          <div class="list">
                              <div class="left"><span>第四平行志愿</span><input type="text"  name="school[]" placeholder="第四平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="javascript:vido(0)">加入对比</a>
                                     </div>
                                </div>
                          </div>
                          <div class="list">
                              <div class="left"><span>第五平行志愿</span><input type="text"  name="school[]" placeholder="第五平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="javascript:vido(0)">加入对比</a>
                                     </div>
                                </div>
                          </div>
                          <div class="list gray">
                              <div class="left"><span>第六平行志愿</span><input type="text"  name="school[]" placeholder="第六平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学1"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学2"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="javascript:vido(0)">加入对比</a>
                                     </div>
                                </div>
                          </div>
                          <div class="list gray">
                              <div class="left"><span>第七平行志愿</span><input type="text"  name="school[]" placeholder="第七平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                             <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学71"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学72"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="javascript:vido(0)">加入对比</a>
                                     </div>
                                </div>
                          </div>
                          <div class="list gray">
                              <div class="left"><span>第八平行志愿</span><input type="text"  name="school[]" placeholder="第八平行志愿" ></div>
                              <div class="btn-more"><a href="javascript:vido(0)">更多学校</a></div>
                              <div class="clearfix"></div>
                              <div class="school-list">
                                  <div class="close-btn"><a href="javascript:vido(0)" class=""><button>关闭</button></a> <div class="clearfix"></div></div>
                                    <div class="school-list-box">
                                        <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学81"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学82"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学3"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学4"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学5"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学6"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学7"/>北京大学</div> 
                                         <div><a href="javascript:vido(0)"><i>加入填报</i></a> <input type="checkbox" name="fruit" value="北京大学8"/>北京大学</div> 
                                    </div>  
                                     <div class="clearfix"></div>
                                     <div class="db-btn">
                                         <a href="javascript:vido(0)">加入对比</a>
                                     </div>
                                </div>
                          </div>
                            <script>
                            
                                  $(".btn-more").click(function(){
                                    $(".school-list").hide();
                                    $(this).siblings(".school-list").show();
                                  })
                                  $(".school-list a").click(function(){
                                    var strval= $(this).siblings("input").val();
                  
                                    $(this).parents(".list").find("input[type='text']").val(strval);
                                  })
                                  $(".school-list .close-btn a").click(function(){
                                    $(".school-list").hide();

                                  })
                            </script>
                            <div class="moni-btn"><a onclick="chkschool();"><button>确定</button></a></div>
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
  function chkschool(){ //jquery获取复选框值
    var chk_value =[];
    $('input[name="school[]"]').each(function(){
        chk_value.push($(this).val());
    });
    if (chk_value.length == 0) {
      alert(chk_value.length==0 ?'你还没有填写志愿！':chk_value);
      return false;
    }
    $("#submitForm").submit();
    }

    //侧边工具栏
    Do.ready(function(t) {
        var n =$("#J-g-dish");
        function scrollTop() {
            $("#J-g-dish-gotop").on("click", function(e) {
                e.preventDefault();
               $("html, body").animate({
                   scrollTop: 0
               }, 300)
            })
        }
        function preventClick() {
            n.on("click", ".wx a.icon", function(t) {
                t.preventDefault()
            }).on("click", ".faq a.icon", function(t) {
                t.preventDefault()
            })
        }
        if(n[0]){
            scrollTop();
            preventClick();
        }
        //
        $(".submit01").click(function(){
          
            var grade =$("#grade").val();
            var patrn = /^[0-9]*[1-9][0-9]*$/;

           if(grade==''||grade==null){
             alert("请输入分数!");
           }
           else if(patrn.exec(grade)== null){
              alert("请输入正确的分数!");
           }
           else{
             $(".fencha-box").show();
           }
           });
         $(".close-btn").click(function(){
             $(".fencha-box").hide();
         })


    })

</script>
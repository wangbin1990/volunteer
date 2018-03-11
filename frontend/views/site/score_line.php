                        <div class="" style="margin:0 auto;width:620px;">
                        <p>历年分数线</p>
                        <table cellspacing="0" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                              	<th>年份	</th>
                              	<th>类别</th>
                              	<th>科目</th>
                                <th>分数线</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($score_line)):?>
                              <?php foreach ($score_line as $score):?>
                              <tr>
                              	<td><?= $score['year']?></td>
                              	<td>
                                <?php if($score['batch_no'] == 1):?>
                                  一本
                                <?php else:?>
                                  二本  
                                <?php endif;?>
                                  </td>
                                <td>
                                  <?php if($score['mold'] == 1):?>
                                  理科
                                <?php else:?>
                                  文科 
                                <?php endif;?>
                                </td>
                              	<td><?= $score['score']?></td>
                              </tr>
                              <?php endforeach;?>
                              <?php endif;?>
                            </tbody>
                        </table>
                        </div>
                    </div>
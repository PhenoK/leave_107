<? include("inc/header.php"); ?>
    <? include("inc/navi.php"); ?>
        <? include("inc/sidebar.php"); ?>
            <?  if($_GET["serialno"] == "")
                    $serialno = "";
                else
                    $serialno = $_GET["serialno"]; ?>
<style>
  h3{
    font-family: "微軟正黑體";
  }
  li{
    font-family: "微軟正黑體";
  }
  table{
    font-family: "微軟正黑體";
  }

</style>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid" >
    <? include ("inc/page-header.php"); ?>
    <div id="serialno" style="display: none;"><?=$serialno?></div>
    <div class="panel panel-primary">
        <div class="panel-heading" style="text-align:left">
            非請假調補課申請單填寫
        </div>
        <div class="panel-body panel-height">
                <div class="row">
                    <div align="center">
                        <div class='form-group'>
                            <div class="col-md-6">請選擇目前學年度:
                                <select class='form-control' style='width:auto; display: inline-block;' id="class_year" name='class_year'></select>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class="col-md-6">請選擇學期:
                                <select class='form-control' style='width:auto; display: inline-block;' id="class_acadm" name='class_acadm'>
                                    <option selected disabled value = '' class='text-hide'>請選擇學期</option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="panel-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <font STYLE="font-family:微軟正黑體">老師本次已填寫之記錄</font><font color="red">(僅限於進修部課程)</font>
                        </div>
                        <div class="table-responsive">
                                <div class="form-group">
                                    <div id="_content">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="text-align:left">
                                國立彰化師範大學調補課申請單填寫作業(<font color="red">請每班各填寫一份，僅限於進修部課程</font>)
                        </div>
                        <div class="panel-body panel-height">
                        <form class="form-horizontal" role="form" name="no_holiday" id="no_holiday_form" action="" method="post">
                            <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <td class="col-md-2 td1" align="center">科目名稱</td>
                                <td class="col-md-4">
                                    <select class='form-control' style='width:auto; display: inline-block;' data-style= 'btn-default'  id='subject_name' name='subject_name'></select>
                                    <font size='2' color='darkred'>(如果沒有選項，表示您學年與學期選錯了，請返回上一步) </font>
                                </td>
                                <td class="col-md-2 td1" align="center">上課班別</td>
                                <td class="col-md-4 " id='class_name'><font></font></td>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <td class="col-md-2 td1" align="center">原上課日期</td>
                                <td class="col-md-4">
                                    <div class='form-group'>
                                        <div class='col-md-12'>
                                            <input type='text' class="form-control" id='origin_time' name="origin_time" readonly="true">
                                        </div>
                                    </div>
                                </td>

                                <td class="col-md-2 td1" align="center">原上課節次等</td>
                                <td class="col-md-4" id="scr_period"></td>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <td class="col-md-2 td1" align="center">調補課日期</td>
                                <td class="col-md-4">
                                    <div class='form-group'>
                                        <div class='col-md-12'>
                                            <input type='text' class="form-control" id='change_time' name="change_time" readonly="true">
                                        </div>
                                    </div>
                                </td>

                                <td class="col-md-2 td1" align="center">補課節次</td>
                                <td class="col-md-4" >
                                <div class='form-group'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            第<select class='form-control' style='width:auto; display: inline-block;' name='class_section2_1' id='class_section2_1'></select>節~
                                            第<select class='form-control' style='width:auto; display: inline-block;' id='class_section2_2' name='class_section2_2'></select>節
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <td class="td1" align="center">補課教室</td>
                                <td colspan="3">
                                    <div class='form-group'>
                                        <input type="text" class="form-control" name="class_room" id="class_room">
                                    </div>
                                </td>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <td class="td1" align="center">備註</td>
                                <div class='form-group'>
                                    <td colspan="3">
                                        <input type="text" class="form-control" name="class_memo" id="class_memo">
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <div class='form-group'>
                                    <td colspan="4" align="center">
                                        <button type="submit" class="btn btn-primary" name="action" id="store" disabled="true">存入簽核檔並離開或被退重送</button>
                                        <button type="submit" class="btn btn-primary" name="action" id="insert" disabled="true">本班資料儲存</button>
                                    </td>
                                </div>
                            </tr>
                            </thead>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--修改頁面-->
            <div class="modal fade" id="ChangeModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="ModalLabel2">紀錄修改</h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div  id="class-modal">
                            </div>
                        </div>


                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="panel-body" id="data_modify">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="text-align:left">
                                            國立彰化師範大學調補課申請單填寫作業(<font color="red">請每班各填寫一份，僅限於進修部課程</font>)
                                    </div>
                                    <div class="panel-body panel-height">
                                    <form class="form-horizontal" role="form" name="update_form" id="update_form" action="" method="post">
                                        <table class="table table-bordered" >
                                        <thead>
                                        <tr>
                                            <td class="col-md-2 td1" align="center">科目名稱</td>
                                            <td class="col-md-4">
                                                <select class='form-control' style='width:auto; display: inline-block;' data-style= 'btn-default'  id='edit_subject_name' name='edit_subject_name'></select>
                                                <font size='2' color='darkred'>(如果沒有選項，表示您學年與學期選錯了，請返回上一步) </font>
                                            </td>
                                            <td class="col-md-2 td1" align="center">上課班別</td>
                                            <td class="col-md-4 " id='edit_class_name'><font></font></td>
                                        </tr>
                                        </thead>

                                        <thead>
                                        <tr>
                                            <td class="col-md-2 td1" align="center">原上課日期</td>
                                            <td class="col-md-4">
                                                <div class='form-group'>
                                                    <div class='col-md-12'>
                                                        <input type='text' class="form-control" id='edit_origin_time' name="edit_origin_time" readonly="true">
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="col-md-2 td1" align="center">原上課節次等</td>
                                            <td class="col-md-4" id="edit_scr_period"></td>
                                        </tr>
                                        </thead>

                                        <thead>
                                        <tr>
                                            <td class="col-md-2 td1" align="center">調補課日期</td>
                                            <td class="col-md-4">
                                                <div class='form-group'>
                                                    <div class='col-md-12'>
                                                        <input type='text' class="form-control" id='edit_change_time' name="edit_change_time" readonly="true">
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="col-md-2 td1" align="center">補課節次</td>
                                            <td class="col-md-4" >第<select class='form-control' style='width:auto; display: inline-block;' name='edit_class_section2_1' id='edit_class_section2_1'></select>節~第<select class='form-control' style='width:auto; display: inline-block;' id='edit_class_section2_2' name='edit_class_section2_2'></select>節
                                            </td>
                                        </tr>
                                        </thead>

                                        <thead>
                                        <tr>
                                            <td class="td1" align="center">補課教室</td>
                                            <td colspan="3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="edit_class_room" id="edit_class_room" value="" size="25" maxlength="30"><font size="4">
                                            </div>
                                            </td>
                                        </tr>
                                        </thead>

                                        <thead>
                                        <tr>
                                            <td class="td1" align="center">備註</td>
                                            <td colspan="3">
                                                <input type="text" class="form-control" name="edit_class_memo" id="edit_class_memo">
                                                <font size="4">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="center" id="update">
                                            </td>
                                        </tr>
                                        </thead>
                                        </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                關閉
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning">
              <i class="fa fa-warning">
                注意!
                <ol>
                  <li>
                    本功能限進修學院。
                  </li>
                  <li>
                    請選對學年度及學期別。
                  </li>
                  <li>
                    離開或重送前請記得先儲存，<font color='red'>請務必按存入簽核並離開</font>，否則後續承辦人無法簽核
                  </li>
                </ol>
              </i>
            </div>
          </div>
      </div>
    </form>
    </div>

  </div>
    </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<? include("inc/footer.php"); ?>

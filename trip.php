<? include("inc/header.php"); ?>
    <? include("inc/navi.php"); ?>
        <? include("inc/sidebar.php");?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <? include ("inc/page-header.php"); ?>
                      <form class="form-horizontal" role="form" name="form1" id="form1" action="" method="post" target="right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="message">
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        國民旅遊名單
                                    </div>

                                    <div class="panel-body">




                                              <!--<fieldset>-->
                                                  <div class="form-group">

                                                      <!--link rel="stylesheet" href="style.css"-->
                                                      <div>
                                                        <H3>國民旅遊名單</H3>
                                                        <table id="trip_dealing" class="table table-striped table-bordered" width="100%" cellspacing="0"></table>
                                                      </div>
                                                  </div>
                                              <!--</fieldset>-->
                                        <hr>
                                        <div class="form-group">

                                            <!--link rel="stylesheet" href="style.css"-->
                                            <div>
                                              <H3>已取消國民旅遊名單</H3>
                                              <table id="trip_canceled" class="table table-striped table-bordered" width="100%" cellspacing="0"></table>
                                            </div>
                                        </div>





                                      </div>


                                    <!--<div class="panel-footer">
                                    </div>-->
                                </div>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                      </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            <? include("inc/footer.php"); ?>

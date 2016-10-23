$( // 表示網頁完成後才會載入
    function() {
        $("body").tooltip({
            selector: "[title]"
        });
        $.ajax({
            url: 'ajax/p_search_overtime_idx_ajax.php',
            data: { oper: 'qry_dept' },
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                var row0 = "<option selected disabled class='text-hide'>請選擇單位</option>";
                $('#qry_dept').append(row0);
                for (var i = 0; i < JData.DEPT_NO.length; i++) {
                    var row = "<option value=" + JData.DEPT_NO[i] + ">" + JData.DEPT_FULL_NAME[i] + "</option>";
                    $('#qry_dept').append(row);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
        });

        $.ajax({
            url: 'ajax/p_search_overtime_idx_ajax.php',
            data: { oper: 'qry_year' },
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                var row0 = "<option selected disabled class='text-hide'>請選擇年份</option>";
                $('#qry_year').append(row0);
                for (var i = 0; i < JData.DEPT_NO.length; i++) {
                    var row = "<option value=" + JData.DEPT_NO[i] + ">" + JData.DEPT_FULL_NAME[i] + "</option>";
                    $('#qry_year').append(row);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
        });


        $('#qry_dept').change( // 抓取區域選完的資料
            function(e) {
                if ($(':selected', this).val() !== '') {
                    CRUD(0); //query
                }
            }
        );

        $('#qry_year').change( // 抓取區域選完的資料
            function(e) {
                if ($(':selected', this).val() !== '') {
                    CRUD(0); //query
                }
            }
        );
    }
);


function CRUD(oper, id) {
    id = id || ''; //預設值
    if (oper == 3){
      if (!confirm("是否確定要刪除?"))
        return false;
    }

    $.ajax({
        url: 'ajax/p_search_overtime_idx_ajax.php',
        data: {
            oper: oper,
            dept_id: $('#qry_dept').val() || '1',
        },
        type: 'POST',
        dataType: "json",
        success: function(JData) {
            if (JData.error_code)
                //toastr["error"](JData.error_message);
                message(JData.error_message, "danger", 5000);
            else {
                if (oper == "0") { //查詢
                    $('#_content').empty();
                    for (var i = 0; i < JData.EMPL_NO.length; i++) {
                        var row = "<tr>";
                        // 人員代號
                        row = row + "<td><input value=" + JData.EMPL_NO[i] + " name='empl_no" + JData.EMPL_NO[i] + "' id='empl_no" + JData.EMPL_NO[i] + "' type='text' class='form-control'></td>";
                        // 姓名
                        row = row + "<td><input value=" + JData.EMPL_CHN_NAME[i] + " name='empl_name" + JData.EMPL_CHN_NAME[i] + "' id='empl_name" + JData.EMPL_CHN_NAME[i] + "' type='text' class='form-control'></td>";
                        // 加班記錄
                        row = row + "<td><button type='button' class='btn-info' name='modify' id='detail' value=" + JData.EMPL_NO[i] + " onclick='showOvertime(" + JData.EMPL_NO[i] + ", \"" + JData.EMPL_CHN_NAME[i] + "\")' title='加班記錄'> <i class='fa fa-info'></i> </button>";
                        // 修改儲存、刪除按鈕
                        row = row + "    <button type='button' class='btn-success' name='modify' id='modify' value=" + JData.EMPL_NO[i] + " onclick='CRUD(2," + JData.EMPL_NO[i] + ")' title='修改儲存'> <i class='fa fa-save'></i> </button>";
                        row = row + "    <button type='button' class='btn-danger' name='delete' id='delete' onclick='CRUD(3," + JData.EMPL_NO[i] + ")'><i class='fa fa-times' title='刪除'></i></button></td>";
                        row = row + "</tr>";
                        $('#_content').append(row);
                    }
                    //新增列
                    var row2 = "<tr class='info'>";
                    row2 = row2 + "<td><input name='empl_no' id='empl_no' type='text' class='form-control' placeholder='人員代號'></td>";
                    row2 = row2 + "<td><input name='empl_name' id='empl_name' type='text' class='form-control' placeholder='姓名'></td>";
                    row2 = row2 + "<td><button class='btn-primary' type='button' name='new' id='new' onclick='CRUD(1)' title='新增'> <i class='fa fa-plus'></i></button></td>";
                    row2 = row2 + "</tr>";
                    $('#_content').append(row2);
                } else if (oper == 1) { //新增
                    toastr["success"]("資料新增成功!");
                    CRUD(0); //reload
                } else if (oper == 2) { //修改
                    toastr["success"]("資料修改成功!");
                    CRUD(0); //reload
                } else if (oper == 3) { //刪除
                    toastr["success"]("資料刪除成功!");
                    CRUD(0); //reload
                }
            }
        },
        beforeSend: function() {
            $('#loading').show();
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);
        }
    });
}

function showOvertime(empl_no, empl_name){
    // 彈出加班詳細資料
    $("#modal-form").modal("show");
}

$( // 表示網頁完成後才會載入
    function() {
        $("body").tooltip({
            selector: "[title]"
        });

        // 查詢單位
        $.ajax({
            url: 'ajax/overtime_data_ajax.php',
            data: {
              oper: 'qry_year'
            },
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                var row0 = "<option selected disabled class='text-hide'>請選擇年份</option>";
                $('#qry_year').append(row0);
                for (var y = 99; y <= JData.YEAR[0]; y++) {
                    var row = "<option value=" + y + ">" + y + "</option>";
                    $('#qry_year').append(row);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        });

        $('#qry_year').change( // 抓取年份資料
            function(e) {
                if ($(':selected', this).val() !== '') {
                    CRUD(0); // 查詢加班記錄
                }
            }
        );
    }
);

function CRUD(oper) {
    if (oper == 3){
      if (!confirm("是否確定要刪除?"))
        return false;
    }

    $.ajax({
        url: 'ajax/overtime_data_ajax.php',
        data: {
            oper: oper,
            empl_name: $('#empl_name').text(),
            empl_no: $('#empl_no').text(),
            qry_year: $('#qry_year').val() || '1'
        },
        type: 'POST',
        dataType: "json",
        success: function(JData) {
            if (JData.error_code)
                //toastr["error"](JData.error_message);
                message(JData.error_message, "danger", 5000);
            else {
                if (oper == "0") { //查詢
                    $('#_overtime-data').empty();
                    if (JData.EMPL_NO.length == 0) {
                        $('#_overtime-data').append("<tr><td colspan='6'>目前尚無加班資料<td></tr>");
                    }
                    for (var i = 0; i < JData.EMPL_NO.length; i++) {
                        var row = "<tr>";
                        // 加班日期
                        row = row + "<td>" + JData.OVER_DATE[i] + "</td>";
                        // 加班起始時間
                        row = row + "<td>" + JData.DO_TIME_1[i] + "</td>";
                        // 加班結束時間
                        row = row + "<td>" + JData.DO_TIME_2[i] + "</td>";
                        // 目前剩餘時數（input: 可修改）
                        row = row + "<td><input value='" + JData.NOUSE_TIME[i] + "' type='text' class='form-control'></td>";
                        // 到期日期（input: 可修改）
                        row = row + "<td><input value='" + JData.DUE_DATE[i] + "' type='text' class='form-control'></td>";
                        // 修改儲存按鈕
                        row = row + "<td><button type='button' class='btn-success' name='modify' id='modify' title='修改儲存'><i class='fa fa-save'></i> </button></td>";
                        row = row + "</tr>";
                        $('#_overtime-data').append(row);
                    }
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

$(function(){
  var group = $(".root").sortable({
    group: 'nested',
    onMousedown: function(cEl, _super, e){
      if (cEl.children('ol').children('li').length)
      {
        toastr['warning']('父節點不可被移動');
        return false;
      }
      else
        return true;
    },
    onCancel: function (cEl, container, _super)
    {
      return confirm("此動作可能無法復原，你確定要拖曳嗎？");
    },
    onDrop: function (cEl, container, _super) {
      var o_id = cEl.attr('id');
      var n_id = cEl.parent().parent().attr('id');
      if (n_id === undefined)
        n_id = String.fromCharCode($('.root > li').index(cEl) + 65);
      else {
        var index = $('#' + n_id + ' > ol > li').index(cEl) + 1;
        if (index < 10)
          n_id = n_id + '0' + index;
        else
          n_id = n_id + index;
      }
      $.ajax({
        url: 'ajax/updateNode.php',
        type: 'POST',
        data: {o_id: o_id, n_id: n_id},
        success: function(result){
          toastr["success"]("成功~~");
          console.log(result);
          cEl.attr({
            id: n_id
          });
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          toastr["error"]("失敗 QAQ");
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
      });
      _super(cEl, container);
    }
  });
  /*
  var group = $(".root").sortable({
    items: 'li',
    placeholder: 'placeholder',
    revert: 200,
    cursor: 'move',
    onMousedown: function(cEl, _super, e){
      if (cEl.children('ol').children('li').length)
      {
        toastr['warning']('父節點不可被移動');
        return false;
      }
      else
        return true;
    },
    onDrop: function (cEl, container, _super) {
      var o_id = cEl.attr('id');
      var n_id = cEl.parent().parent().attr('id');
      var index = $('#' + n_id + ' > ol > li').index(cEl) + 1;
      if (index < 10)
        n_id = n_id + '0' + index;
      else
        n_id = n_id + index;
      $.ajax({
        url: '/ajax/updateNode.php',
        type: 'POST',
        data: {o_id: o_id, n_id: n_id},
        success: function(result){
          toastr["success"]("成功~~");
          console.log(result);
          cEl.attr({
            id: n_id
          });
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          toastr["error"]("失敗 QAQ");
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
      });
    },
    onDragStart: function(cEl, container, _super, event){
      $('.placeholder').height(cEl.height());
    }
  });
  */

  $('#add-btn').click(function(event) {
    $type = '';
    if ($('#add-type').prop("checked"))
      $type = '1';
    //$.post('../ajax/insertNode.php', {id: $('#id').val(), name: $('#name').val(), url: $('#url').val(), type: $('#type').val(), img: $('#img').val()}, function(result){alert(result)});
    $.ajax({
      url: 'ajax/insertNode.php',
      type: 'POST',
      data: {id: $('#add-id').val(), name: $('#add-name').val(), url: $('#add-url').val(), type: $type, img: $('#add-img').val()},
      success: function(result){
        toastr["success"]("成功~~");
        console.log(result);
        var text = "<li id='" + $('#add-id').val() + "' url='" + $('#add-url').val() + "' type='" + $('#add-type').val() + "'>\r\n<span><i class='fa $folder_img fa-fw'></i> " + $('#add-name').val() + "</span><span class='right'><button class='edit-opener btn btn-info btn-xs'>編輯</button> <button class='delete btn btn-danger btn-xs'>刪除</button></span>";
        if ($('#add-url').val() === '')
          text += "<ol></ol>";
        if ($('#add-id').val().length > 2)
          $('#' + $('#add-id').val().slice(0, -2) + ' > ol').append(text);
        else
          $('.root').append(text);
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        toastr["error"]("失敗 QAQ");
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        var text = "<li id='" + $('#add-id').val() + "' url='" + $('#add-url').val() + "' type='" + $('#add-type').val() + "'>\r\n<span><i class='fa $folder_img fa-fw'></i> " + $('#add-name').val() + "</span><span class='right'><button class='edit-opener btn btn-info btn-xs'>編輯</button> <button class='delete btn btn-danger btn-xs'>刪除</button></span>";
        if ($('#add-url').val() === '')
          text += "<ol></ol>";
        if ($('#add-id').val().length > 2)
          $('#' + $('#add-id').val().slice(0, -2) + ' > ol').append(text);
        else
          $('.root').append(text);
      }
    });
    $("#modal-add").modal("hide");
  });

  $('#edit-btn').click(function(event) {
    $type = '';
    if ($('#edit-type').prop("checked"))
      $type = '1';
    $.ajax({
      url: 'ajax/updateNode.php',
      type: 'POST',
      data: {id: $('#edit-id').val(), name: $('#edit-name').val(), url: $('#edit-url').val(), type: $type, img: $('#edit-img').val()},
      success: function(result){
        toastr["success"]("成功~~");
        console.log(result);
        $('#' + $('#edit-id').val() + ' > span:not(.right)').html("<i class='fa " + $('#edit-img').val() + " fa-fw'></i> " + $('#edit-name').val());
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        toastr["error"]("失敗 QAQ");
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        $('#' + $('#edit-id').val() + ' > span:not(.right)').html("<i class='fa " + $('#edit-img').val() + " fa-fw'></i> " + $('#edit-name').val());
      }
    });
    $("#modal-edit").modal("hide");
  });

  $("#add-opener").click(function() {
    $("#modal-add").modal("show");
  });

  $(".edit-opener").click(function() {
    $("#modal-edit .modal-title").html($(this).parent().parent().attr('id') + " - 編輯節點");
    $("#edit-id").val($(this).parent().parent().attr('id'));
    $("#edit-name").val($(this).parent().prev().text().slice(1));
    $("#edit-url").val($(this).parent().parent().attr('url'));
    $("#edit-type").prop('checked', $(this).parent().parent().attr('type'));
    $("#edit-img").val($(this).parent().prev().children('i').attr('class').slice(3, -6));
    $("#modal-edit").modal("show");
  });

  $(".delete").click(function(event) {
    var id = $(this).parent().parent().attr('id');
    $.ajax({
      url: 'ajax/deleteNode.php',
      type: 'POST',
      data: {id: id},
      success: function(result){
        toastr["success"]("成功~~");
        console.log(result);
        $('#' + id).remove();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        toastr["error"]("失敗 QAQ");
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        $('#' + id).remove();
      }
    });
  });
});
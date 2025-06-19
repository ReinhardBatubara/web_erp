<div id="stockout_toolbar" style="padding-bottom: 2px;">
  <form id="stockout_search_form2" method="post" novalidate onsubmit="return false;" style="margin-bottom: 0px;">
    <label class="field_label"> STO : </label>
    <input type="text" 
           class="easyui-validatebox" 
           id="stockout_number_s" 
           style="width: 80px"
           onkeypress="if (event.keyCode === 13) {
                 stockout_search2();
               }"
           name="number"
           />
    <label class="field_label">Date: </label>
    <input type="text" 
           size="11" 
           class="easyui-datebox" 
           id="stockout_datefrom_s" 
           data-options="formatter:myformatter,parser:myparser"
           name="datefrom"
           />
    <label class="field_label">-</label>
    <input type="text" 
           size="11" 
           class="easyui-datebox" 
           id="stockout_dateto_s" 
           data-options="formatter:myformatter,parser:myparser"
           name="dateto"
           />
    <label class="field_label">MW/Nota : </label>
    <input type="text" 
           class="easyui-validatebox" 
           id="stockout_mw_s"  
           style="width: 100px"
           onkeypress="if (event.keyCode === 13) {
                 stockout_search2();
               }"
           name="mw_or_nota"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stockout_search2()"></a>
    <?php
    if ($this->session->userdata('department') == 9) {
      ?>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stockout_add()">Add</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="stockout_add2()">Direct Add From JO</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add3" plain="true" onclick="stockout_add_from_nota()">Add From Nota</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stockout_edit()">Edit</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stockout_delete()">Delete</a>
      <?php
    }
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="stockout_print()"> Print</a>
    <a id="stockout_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
  </form>
</div>
<table id="stockout"></table>
<script type="text/javascript">
  $(function() {
    $('#stockout').datagrid({
      url: '<?php echo site_url('stockout/get') ?>',
      method: 'post',
      border: false,
      singleSelect: true,
      fit: true,
      rownumbers: true,
      fitColumns: false,
      pagination: true,
      striped: true,
      sortName: 'id',
      sortOrder: 'desc',
      toolbar: '#stockout_toolbar',
      columns: [[
          {field: 'chck', checkbox: true},
          {field: 'number', title: 'STO NO', width: 90, align: 'center', sortable: "true"},
          {field: 'date', title: 'Date', formatter: myFormatDate, width: 80, align: 'center', sortable: "true"},
          {field: 'employee_outby', title: 'Out By', width: 150, halign: 'center', sortable: "true"},
          {field: 'mw_number', title: 'MW NO / NOTA NO', width: 110, align: 'center', sortable: "true"},
          {field: 'request_date', title: 'Request Date', formatter: myFormatDate, width: 100, align: 'center', sortable: "true"},
          {field: 'employee_requestby', title: 'Request By', width: 150, halign: 'center', sortable: "true"},
          {field: 'subsection', title: 'Dept/Sub Section', width: 150, halign: 'center', sortable: "true"},
          {field: 'status', title: 'Status', width: 100, halign: 'center', sortable: "true"},
          {field: 'remark', title: 'Remark', width: 200, halign: 'center', sortable: "true"}

        ]],
      onSelect: function(value, row, index) {
        $('#stockoutdetail').datagrid({
          url: '<?php echo site_url('stockoutdetail/get') ?>',
          queryParams: {
            stockoutid: row.id
          }
        });
      }
    }).datagrid('getPager').pagination({
      pageList: [30, 50, 70, 90, 110]
    });

    $('#stockout_menu_search').tooltip({
      position: 'bottom',
      content: $('<div></div>'),
      showEvent: 'click',
      hideEvent: 'none',
      deltaX: -150,
      onUpdate: function(content) {
        content.panel({
          width: 320,
          border: true,
          title: 'Search',
          href: base_url + 'stockout/search_form'
        });
      },
      onShow: function() {
        var t = $(this);
        t.tooltip('tip').unbind().bind('mouseenter', function() {
          t.tooltip('show');
        });
      }
    });
  });
</script>
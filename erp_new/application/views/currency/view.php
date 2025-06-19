<div id="currency_toolbar" style="padding-bottom: 0;">
    <form id="currency_search_form" onsubmit="currency_search();return false;">
    Code : <input type="text" size="12" class="easyui-validatebox" name='curr' id="currency_curr_s" onkeypress="if (event.keyCode === 13) {
                currency_search();
            }"/>    
    Description : <input type="text" size="20" class="easyui-validatebox"  name='desc' id="currency_desc_s" onkeypress="if (event.keyCode === 13) {
                currency_search();
            }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="currency_search()"></a>
    <?php
    if (in_array('add', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="currency_add()">Add</a>
        <?php
    }if (in_array('edit', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="currency_edit()">Edit</a>
        <?php
    }if (in_array('delete', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="currency_delete()">Delete</a>
        <?php
    }
    ?>
        </form>
</div>
<table id="currency" data-options="
       url:'<?php echo site_url('currency/get') ?>',
       method:'post',
       title:'Currency',
       border:true,
       singleSelect:true,
       fit:true,
       striped:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       toolbar:'#currency_toolbar'">
    <thead>
        <tr>
            <th field="curr" width="100" align="center">Code</th>            
            <th field="desc" width="400" halign="center">Description</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#currency').datagrid({});
    });
</script>
<?php
$this->load->view('currency/add');
?>


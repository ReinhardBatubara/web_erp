<div id="model-detail-layout_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="model_detail_layout_add" onclick="model_detail_layout_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="model_detail_layout_delete" onclick="model_detail_layout_delete()">Delete</a>
</div>
<table id="model-detail-layout" 
       style="width:700px;height:350px"
       title="Detail Layout" 
       singleSelect="true" 
       fit="true" 
       border="false" 
       fitColumns="true" 
       remoteSort="false"
       url="<?php echo site_url('model/get_detail_layout') ?>" 
       pagination="true"
       toolbar="#model-detail-layout_toolbar">
    <thead>
        <tr>
            <th field="imagename" width="400">Image</th>
            <th field="title" width="200">Title</th>
        </tr>
    </thead>
</table> 

<script>
    var cardview = $.extend({}, $.fn.datagrid.defaults.view, {
        renderRow: function(target, fields, frozen, rowIndex, rowData) {
            var cc = [];
            cc.push('<td colspan=' + fields.length + ' style="padding:10px 5px;border:0;">');
            if (!frozen) {
                var img = rowData.imagename;
                cc.push('<img src="files/model/detaillayout/' + img + '" style="width:150px;float:left">');
                cc.push('<div style="float:left;margin-left:20px;">');
                for (var i = 1; i < fields.length; i++) {
                    var copts = $(target).datagrid('getColumnOption', fields[i]);
                    cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + rowData[fields[i]] + '</p>');
                }
                cc.push('</div>');
            }
            cc.push('</td>');
            return cc.join('');
        }
    });
    $(function() {
        $('#model-detail-layout').datagrid({
            view: cardview
        });
    });
</script>
<style type="text/css">
    .c-label{
        display:inline-block;
        width:100px;
        font-weight:bold;
    }
</style>
<?php
$this->load->view('model/detaillayout/add');

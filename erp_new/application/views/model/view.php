<div id="model_toolbar" style="padding-bottom: 0px;">
    Code/Name : <input type="text" size="15" class="easyui-validatebox" id="model_cat_s" onkeyup="if (event.keyCode == 13) {
                model_search_s()
            }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="model_search_s()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="model_add()" id="btn_model_add">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="model_edit()" id="btn_model_edit">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="model_delete()" id="btn_model_delete">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-copy" plain="true" onclick="model_copy()" id="btn_model_copy">Copy</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="model_close()" id="btn_model_close">Close / Revision</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-open" plain="true" onclick="model_open()" id="btn_model_open">Open</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-complete" plain="true" onclick="model_complete()" id="btn_model_complete">Complete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-generate" plain="true" onclick="model_generate_bom()" id="btn_model_generate_bom">Re/Generate BOM</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" onclick="model_view_bom()">View BOM</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="model_print()">Print</a>
    <a id="model_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;"></a>
</div>
<table id="model" data-options="   
       url:'<?php echo site_url('model/get') ?>',
       method:'post',
       border:false,
       rownumbers: true,
       fitColumns: false,
       fit: true,
       singleSelect: true,
       pagination: true,
       pageSize: 30,
       pageList: [30, 50, 70, 90, 110],
       idField: 'id',
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#model_toolbar'">
    <thead data-options="frozen:true">
        <tr>
            <th field="id" width="20" halign="center" sortable="true">ID</th>
            <th field="code" width="70" halign="center" sortable="true">Item Code</th>
            <th field='originalcode' width="80" halign="center" sortable="true">Ori. Code</th>
            <th field="name" width="120" halign="center" sortable="true">Item Name</th>    
        </tr>
    </thead>
    <thead>
        <tr>                            
            <th field="modelcategory" width="80" align="center" rowspan="2" sortable="true">Category</th>
            <th field="finishing" width="120" halign="center" rowspan="2">Finishing</th>
            <th field="material" width="120" halign="center" rowspan="2">Material</th>
            <th field="top" width="80" halign="center" rowspan="2">Top</th>
            <th field="mirrorglass" width="80" halign="center" rowspan="2">Mirror / Glass</th>
            <th field="foam" width="80" halign="center" rowspan="2">Foam</th>
            <th field="interliner" width="80" halign="center" rowspan="2">Interliner</th>
            <th field="fabric" width="80" halign="center" rowspan="2">Fabric</th>
            <th field="furring" width="80" halign="center" rowspan="2">Furring</th>
            <th field="accessories" width="80" halign="center" rowspan="2">Accessories</th>                            
            <th align="center" colspan="3">Item Size (MM)</th>
            <th align="center" colspan="3">Item Size (INC)</th>
            <th align="center" colspan="3">Packing size 1 (MM)</th>
            <th align="center" colspan="3">Packing size 1 (INC)</th>
            <th align="center" colspan="3">Packing size 2 (MM)</th>
            <th align="center" colspan="3">Packing size 2 (INC)</th>
            <th field="employee_created" width="120" halign="center" rowspan="2">Created By</th>
        </tr>
        <tr>
            <th field="itemsize_mm_w" width="50" align="center">W</th>
            <th field="itemsize_mm_d" width="50" align="center">D</th>
            <th field="itemsize_mm_h" width="50" align="center">H</th>
            <th field="itemsize_inc_w" width="50" align="center">W</th>
            <th field="itemsize_inc_d" width="50" align="center">D</th>
            <th field="itemsize_inc_h" width="50" align="center">H</th>
            <th field="packagingsize_mm_w" width="50" align="center">W</th>
            <th field="packagingsize_mm_d" width="50" align="center">D</th>
            <th field="packagingsize_mm_h" width="50" align="center">H</th>
            <th field="packagingsize_inc_w" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="packagingsize_inc_d" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">D</th>
            <th field="packagingsize_inc_h" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">H</th>
            <th field="packagingsize2_mm_w" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="packagingsize2_mm_d" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">D</th>
            <th field="packagingsize2_mm_h" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">H</th>
            <th field="packagingsize2_inc_w" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="packagingsize2_inc_d" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">D</th>
            <th field="packagingsize2_inc_h" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">H</th>
        </tr>
    </thead>    
</table>
<script type="text/javascript">
    var model_id = 0;
    $(function () {
        $('#model').datagrid({
            onLoadSuccess: function (data) {
                if (data.total === '1') {
                    $(this).datagrid('selectRow', 0);
                } else {
                    $(this).datagrid('selectRecord', model_id);
                }
            },
            rowStyler: function (index, row) {
                if (row.open === 'f') {
                    return 'background-color:#ffecec;'; // return inline style                            
                }
                if (row.complete === '1') {
                    return 'background-color:#ceff46;'; // return inline style
                }
            },
            onSelect: function (value, row, index) {
                var model_tab = $('#tt-model').tabs('getSelected');
                var tab_index = $('#tt-model').tabs('getTabIndex', model_tab);

                switch (tab_index) {
                    case 0:
                        $('#solidwood').treegrid('load', {modelid: row.id});
                        break;
                    case 1:
                        $('#plywood').treegrid('load', {modelid: row.id});
                        break;
                    case 2:
                        $('#mirror').datagrid('load', {modelid: row.id});
                        break;
                    case 3:
                        $('#hardware').datagrid('load', {modelid: row.id});
                        break;
                    case 4:
                        $('#upholstry').datagrid('load', {modelid: row.id});
                        break;
                    case 5:
                        $('#modelfinishingseen').datagrid('load', {modelid: row.id});
                        break;
                    case 6:
                        $('#modelfinishingunseen').datagrid('load', {modelid: row.id});
                        break;
                    case 7:
                        $('#finishingtop').datagrid('load', {modelid: row.id});
                        break;
                    case 8:
                        $('#packaging').treegrid('load', {modelid: row.id});
                        break;
                    case 9:
                        $('#process').datagrid('load', {modelid: row.id});
                        break;
                    case 10:
                        $('#model_additionalmaterial').datagrid('load', {modelid: row.id});
                        break;
                    case 11:
                        $('#model-detail-layout').datagrid('load', {modelid: row.id});
                        break;
                    default:
                }

                //if (model_id !== row.id) {

                var images = '';
                if (row.images === '') {
                    images = 'no-images.jpg';
                } else {
                    images = row.images;
                }
                //alert(images);
                //$('#image-item').attr('src', images);

                $.get(base_url + 'model/load_image/' + images, function (content) {
                    $('#temp_image_model').empty();
                    $('#temp_image_model').append(content);
                });
                model_id = row.id;
                //}
                if (row.open == 't') {
                    $('#btn_model_edit').linkbutton('disable');
                    $('#btn_model_delete').linkbutton('disable');
                    $('#btn_model_generate_bom').linkbutton('disable');
                    $('#btn_model_open').linkbutton('disable');
                    $('#btn_model_close').linkbutton('enable');

                    //Solid Wood                     
                    $('#solidwood_addpath').linkbutton('disable');
                    $('#solidwood_children').linkbutton('disable');
                    $('#solidwood_edit').linkbutton('disable');
                    $('#solidwood_delete').linkbutton('disable');
                    $('#solidwood_make_as_path').linkbutton('disable');
                    $('#solidwood_make_as_child').linkbutton('disable');

                    //Play Wood
                    $('#plywood_add').linkbutton('disable');
                    $('#plywood_children').linkbutton('disable');
                    $('#plywood_edit').linkbutton('disable');
                    $('#plywood_delete').linkbutton('disable');
                    $('#plywood_make_as_path').linkbutton('disable');
                    $('#plywood_make_as_child').linkbutton('disable');

                    //Mirror
                    $('#mirror_add').linkbutton('disable');
                    $('#mirror_edit').linkbutton('disable');
                    $('#mirror_delete').linkbutton('disable');

                    //Hardware
                    $('#hardware_add').linkbutton('disable');
                    $('#hardware_add_new_material').linkbutton('disable');
                    $('#hardware_edit').linkbutton('disable');
                    $('#hardware_delete').linkbutton('disable');

                    //Upholstry                    
                    $('#upholstry_add').linkbutton('disable');
                    $('#upholstry_edit').linkbutton('disable');
                    $('#upholstry_delete').linkbutton('disable');

                    //Finishing Seen Face
                    $('#finishingseen_add').linkbutton('disable');
                    $('#finishingseen_edit').linkbutton('disable');
                    $('#finishingseen_delete').linkbutton('disable');

                    //Finishing UnSeen Face
                    $('#finishingunseen_add').linkbutton('disable');
                    $('#finishingunseen_edit').linkbutton('disable');
                    $('#finishingunseen_delete').linkbutton('disable');

                    //Packing
                    $('#packaging_add').linkbutton('disable');
                    $('#packaging_edit').linkbutton('disable');
                    $('#packaging_delete').linkbutton('disable');

                    //Process
                    $('#process_add').linkbutton('disable');
                    $('#process_edit').linkbutton('disable');
                    $('#process_delete').linkbutton('disable');


                    //Additional Material
                    $('#additionalmaterial_add').linkbutton('disable');
                    $('#additionalmaterial_edit').linkbutton('disable');
                    $('#additionalmaterial_delete').linkbutton('disable');

                    //Layout
                    $('#model_detail_layout_add').linkbutton('disable');
                    $('#model_detail_layout_delete').linkbutton('disable');
                } else {
                    $('#btn_model_edit').linkbutton('enable');
                    $('#btn_model_delete').linkbutton('enable');
                    $('#btn_model_generate_bom').linkbutton('enable');
                    $('#btn_model_open').linkbutton('enable');
                    $('#btn_model_close').linkbutton('disable');


                    //Solid Wood                     
                    $('#solidwood_addpath').linkbutton('enable');
                    $('#solidwood_children').linkbutton('enable');
                    $('#solidwood_edit').linkbutton('enable');
                    $('#solidwood_delete').linkbutton('enable');
                    $('#solidwood_make_as_path').linkbutton('enable');
                    $('#solidwood_make_as_child').linkbutton('enable');

                    //Play Wood
                    $('#plywood_add').linkbutton('enable');
                    $('#plywood_children').linkbutton('enable');
                    $('#plywood_edit').linkbutton('enable');
                    $('#plywood_delete').linkbutton('enable');
                    $('#plywood_make_as_path').linkbutton('enable');
                    $('#plywood_make_as_child').linkbutton('enable');

                    //Mirror
                    $('#mirror_add').linkbutton('enable');
                    $('#mirror_edit').linkbutton('enable');
                    $('#mirror_delete').linkbutton('enable');

                    //Hardware
                    $('#hardware_add').linkbutton('enable');
                    $('#hardware_add_new_material').linkbutton('enable');
                    $('#hardware_edit').linkbutton('enable');
                    $('#hardware_delete').linkbutton('enable');

                    //Upholstry                    
                    $('#upholstry_add').linkbutton('enable');
                    $('#upholstry_edit').linkbutton('enable');
                    $('#upholstry_delete').linkbutton('enable');

                    //Finishing Seen Face
                    $('#finishingseen_add').linkbutton('enable');
                    $('#finishingseen_edit').linkbutton('enable');
                    $('#finishingseen_delete').linkbutton('enable');

                    //Finishing UnSeen Face
                    $('#finishingunseen_add').linkbutton('enable');
                    $('#finishingunseen_edit').linkbutton('enable');
                    $('#finishingunseen_delete').linkbutton('enable');

                    //Packing
                    $('#packaging_add').linkbutton('enable');
                    $('#packaging_edit').linkbutton('enable');
                    $('#packaging_delete').linkbutton('enable');

                    //Process
                    $('#process_add').linkbutton('enable');
                    $('#process_edit').linkbutton('enable');
                    $('#process_delete').linkbutton('enable');

                    //Additional Material
                    $('#additionalmaterial_add').linkbutton('enable');
                    $('#additionalmaterial_edit').linkbutton('enable');
                    $('#additionalmaterial_delete').linkbutton('enable');

                    //Layout
                    $('#model_detail_layout_add').linkbutton('enable');
                    $('#model_detail_layout_delete').linkbutton('enable');
                }
            }
        });
        //        $('#model_menu_search').tooltip({
        //            position: 'bottom',
        //            content: function () {
        //                return $('#model_dialog_search');
        //            },
        //            showEvent: 'click',
        //            onShow: function () {
        //                var t = $(this);
        //                t.tooltip('tip').unbind().bind('mouseenter', function () {
        //                    t.tooltip('show');
        //                });
        //            }
        //        });

        $('#model_menu_search').tooltip({
            content: $('<div></div>'),
            showEvent: 'click',
            showDelay: 10,
            modal: true,
            onUpdate: function (content) {
                content.panel({
                    width: 300,
                    border: false,
                    title: 'Search',
                    href: base_url + 'model/load_search_form'
                });
            },
            onShow: function () {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function () {
                    t.tooltip('show');
                });
            }
        });
    });
</script>
<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Goods Receive">
        <div id="goodsreceive_toolbar" style="padding-bottom: 2px;">
            <form id="goodsreceive_search_form2" method="post" novalidate onsubmit="return false;" style="margin-bottom: 0px">
                <label class="field_label">GR NO : </label>
                <input type="text"
                       class="easyui-validatebox" 
                       name="number" 
                       id="gr_number_s" 
                       style="width: 80px"
                       onkeyup="if (event.keyCode === 13) {
                                   goodsreceive_search2();
                               }" 
                       />
                <label class="field_label">Date: </label>
                <input type="text" size="13" class="easyui-datebox" name="datefrom" id="gr_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                <label class="field_label">-</label>
                <input type="text" size="13" class="easyui-datebox" name="dateto" id="gr_dateto_s" data-options="formatter:myformatter,parser:myparser"/>        
                <label class="field_label">Vendor :</label>
                <input type="text" name="vendorid" panelWidth="200" id="gr_vendor_id_s" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>',
                       onSelect:function(row){
                       goodsreceive_search2();
                       }" mode="remote" style="width: 80px">
                <label class="field_label">No SJ : </label>
                <input type="text"  style="width: 80px" class="easyui-validatebox" name="no_sj" id="gr_no_sj_s" onkeyup="if (event.keyCode === 13) {
                            goodsreceive_search2();
                        }" />
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="goodsreceive_search2()"></a>
                <?php
                if ($this->session->userdata('department') == 9) {
                    ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="goodsreceive_add()">Add</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="goodsreceive_edit()">Edit</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="goodsreceive_delete()">Delete</a>
                    <?php
                }
                ?>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-report" plain="true" onclick="goodsreceive_report()">report</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="goodsreceive_print()"> Print</a>
                <a id="goodsreceive_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;"></a>

            </form>
        </div>
        <table id="goodsreceive" data-options="  
               method:'post',
               border:true,       
               singleSelect:true,
               fit:true,
               pageSize:30,
               pageList: [30, 50, 70, 90, 110],
               rownumbers:true,
               fitColumns:true,
               striped:true,
               pagination:true,
               sortName:'id',
               sortOrder:'desc',
               toolbar:'#goodsreceive_toolbar'">
            <thead>
                <tr>
                    <th field="id" hidden="true"></th>
                    <th field="chck" checkbox="true"></th>
                    <th field="number" width="90" halign="center" sortable="true">GR NO</th>            
                    <th field="date" width="80" align="center" sortable="true" formatter="myFormatDate">Date</th>
                    <th field="vendor" width="150" halign="center" sortable="true">Supplier/Vendor</th>
                    <th field="no_sj" width="120" halign="center" sortable="true">D.O Number</th>
                    <th field="do_date" width="80" align="center" formatter="myFormatDate">D.O Date</th>
                    <th field="received" width="80" halign="center" sortable="true">Received By</th>
                    <th field="checked" width="100" halign="center" sortable="true">Checked By</th>
                    <th field="remark" width="300" halign="center" sortable="true">Remark</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#goodsreceive').datagrid({
                    url: '<?php echo site_url('goodsreceive/get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#goodsreceivedetail').datagrid({
                            url: '<?php echo site_url('goodsreceivedetail/get') ?>',
                            queryParams: {
                                goodsreceiveid: rowData.id
                            }
                        });
                    }
                });

                $('#goodsreceive_menu_search').tooltip({
                    position: 'bottom',
                    content: $('<div></div>'),
                    showEvent: 'click',
                    hideEvent: 'none',
                    deltaX: -150,
                    onUpdate: function (content) {
                        content.panel({
                            width: 320,
                            border: true,
                            title: 'Search',
                            href: base_url + 'goodsreceive/search_form'
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
    </div>
    <div region="south" split="true" style="height:50%;border: none;">
        <?php $this->load->view('goodsreceive/detail/view'); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/goodsreceive.js')?>"></script>
<?php
//$this->load->view('goodsreceive/add');
$this->load->view('goodsreceive/edit');

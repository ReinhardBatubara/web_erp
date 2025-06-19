<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Quotation">
        <div id="quotation_toolbar" style="padding-bottom: 0px;">
            <form id="quotation_form_search2" style="margin-bottom: 0px">
                QT NO : 
                <input type="text" 
                       size="12" 
                       name="number"
                       class="easyui-validatebox" 
                       onkeyup="if (event.keyCode === 13) {
                                   quotation_search2()
                               }"/>  
                Date From :
                <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                To :
                <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="quotation_search2()"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="quotation_add()">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="quotation_edit()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="quotation_delete()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="quotation_print('print')">Print</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="quotation_print('excel')">Excel</a>                
            </form>
        </div>
        <table id="quotation" data-options="  
               method:'post',
               border:true,       
               singleSelect:true,
               fit:true,
               pageSize:30,
               pageList: [30, 50, 70, 90, 110],
               rownumbers:true,
               fitColumns:false,
               striped:true,
               pagination:true,
               sortName:'id',
               sortOrder:'desc',
               toolbar:'#quotation_toolbar'">
            <thead>
                <tr>
                    <th field="number" width="120" halign="center" sortable="true">QT NO</th>            
                    <th field="date" width="80" align="center" formatter="myFormatDate" sortable="true">Date</th>
                    <th field="to" width="100" halign="center">To</th>
                    <th field="company" width="200" halign="center" sortable="true">Company</th>
                    <th field="currency" width="80" halign="center" sortable="true">Currency</th>
                    <th field="note" width="200" halign="center">Note</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#quotation').datagrid({
                    url: '<?php echo site_url('quotation/get') ?>',
                    onSelect: function (rowIndex, rowData) {
                        $('#quotationdetail').datagrid('reload', {
                            quotationid: rowData.id
                        });
                    }
                });
            });
        </script>
    </div>
    <div region="south" split="true" style="height:250px;border: none;" title="Item" collapsible="false">
        <?php $this->load->view('quotation/detail/view'); ?>
    </div>
</div>
<script src="<?php echo base_url() ?>js/quotation.js"></script>

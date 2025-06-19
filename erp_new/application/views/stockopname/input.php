<form id="stockopname_input_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">            
        <tr>
            <td width="25%"><strong>Date </strong></td>
            <td width="75%">
                <input type="hidden" name="id"/>
                <input class="easyui-datebox" type="text" style="width:50%" name="date" data-options="formatter:myformatter,parser:myparser">
            </td>
        </tr>
        <?php
        if ($this->session->userdata('department') == 9 || $this->session->userdata('id') == 'admin') {
            if ($this->session->userdata('optiongroup') == -1 || $this->session->userdata('id') == 'admin') {
                ?>
                <tr>
                    <td><strong>Warehouse </strong></td>
                    <td>
                        <input id="opname_warehouseid51" 
                               name="warehouseid" 
                               class="easyui-combobox"
                               url="<?php echo site_url('warehouse/get')?>"
                               style="width: 50%;" panelHeight="auto" required="true" 
                               valueField="id"
                               textField="name"
                               />
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <input type="hidden" id="warehouseid" name="warehouseid" value="<?php echo $this->session->userdata('optiongroup') ?>" />
                <?php
            }
        }
        ?>
        <tr>
            <td><strong>Description</strong></td>
            <td><textarea type="text" name="description" class="easyui-validatebox" style="width: 100%;height: 40px" required="true"></textarea></td>
        </tr>
    </table>        
</form>

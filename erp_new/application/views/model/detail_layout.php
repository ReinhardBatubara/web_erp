<div id="tt-model" 
     class="easyui-tabs" 
     fit='true'
     tabPosition='top'
     tabHeight='18'
     scrollIncrement='50'
     scrollDuration='200'>
    <div title="SOLID WOOD" 
         href="<?php echo site_url('solidwood') ?>"
         data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#solidwood').treegrid('load', {modelid: row.id});
         }
         }"></div>
    <div title="PLYWOOD / MDF" href="<?php echo site_url('plywood') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#plywood').treegrid('load', {modelid: row.id});
         }
         }"></div>
    <div title="MIRROR / GLASS" href="<?php echo site_url('mirror') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#mirror').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="HARDWARE" href="<?php echo site_url('hardware') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#hardware').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="UPHOLSTRY & ACCESSORIES" href="<?php echo site_url('upholstry') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#upholstry').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="FINISHING SEEN FACES" href="<?php echo site_url('modelfinishingseen') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#modelfinishingseen').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="FINISHING BACK & UNSEEN" href="<?php echo site_url('modelfinishingunseen') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#modelfinishingunseen').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="FINISHING TOP" href="<?php echo site_url('finishingtop') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#finishingtop').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="PACKAGING" href="<?php echo site_url('packaging') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#packaging').treegrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="PROCESS" href="<?php echo site_url('process') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#process').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="ADDITIONAL MATERIAL" href="<?php echo site_url('additionalmaterial') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#model_additionalmaterial').datagrid('reload', {modelid: row.id});
         }
         }"></div>
    <div title="LAYOUT DETAIL" href="<?php echo site_url('model/layout_detail') ?>" data-options="onLoad:function(){
         var row = $('#model').datagrid('getSelected');
         if(row !== null){
         $('#model-detail-layout').datagrid('reload', {modelid: row.id});
         }
         }"></div>
</div>
<script>
    var sl_wd_std = 0;
    $('#tt-model').tabs({
//        onLoad: function (panel) {
//            var model_tab = $('#tt-model').tabs('getSelected');
//            var tab_index = $('#tt-model').tabs('getTabIndex', model_tab);
//            var row = $('#model').datagrid('getSelected');
//            if (row != null) {
//                switch (tab_index) {
//                    case 0:
//                        $('#solidwood').treegrid('load', {modelid: row.id});
//                        break;
//                    case 1:
//                        $('#plywood').treegrid('load', {modelid: row.id});
//                        break;
//                    case 2:
//                        $('#mirror').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 3:
//                        $('#hardware').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 4:
//                        $('#upholstry').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 5:
//                        $('#modelfinishingseen').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 6:
//                        $('#modelfinishingunseen').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 7:
//                        $('#finishingtop').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 8:
//                        $('#packaging').treegrid('reload', {modelid: row.id});
//                        break;
//                    case 9:
//                        $('#process').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 10:
//                        $('#model_additionalmaterial').datagrid('reload', {modelid: row.id});
//                        break;
//                    case 11:
//                        $('#model-detail-layout').datagrid('reload', {modelid: row.id});
//                        break;
//                    default:
//                }
//            }
//        },
        onSelect: function (title, index) {
            var row = null;
            if ($('#model').length > 0) {
                var row = $('#model').datagrid('getSelected');
            }
            if (row != null) {
                switch (index) {
                    case 0:
                        if (sl_wd_std != 0) {
                            $('#solidwood').treegrid('load', {modelid: row.id});
                        }
                        sl_wd_std = 1;
                        break;
                    case 1:
                        $('#plywood').treegrid('load', {modelid: row.id});
                        break;
                    case 2:
                        $('#mirror').datagrid('reload', {modelid: row.id});
                        break;
                    case 3:
                        $('#hardware').datagrid('reload', {modelid: row.id});
                        break;
                    case 4:
                        $('#upholstry').datagrid('reload', {modelid: row.id});
                        break;
                    case 5:
                        $('#modelfinishingseen').datagrid('reload', {modelid: row.id});
                        break;
                    case 6:
                        $('#modelfinishingunseen').datagrid('reload', {modelid: row.id});
                        break;
                    case 7:
                        $('#finishingtop').datagrid('reload', {modelid: row.id});
                        break;
                    case 8:
                        $('#packaging').datagrid('reload', {modelid: row.id});
                        break;
                    case 9:
                        $('#process').datagrid('reload', {modelid: row.id});
                        break;
                    case 10:
                        $('#model_additionalmaterial').datagrid('reload', {modelid: row.id});
                        break;
                    case 11:
                        $('#model-detail-layout').datagrid('reload', {modelid: row.id});
                        break;
                    default:
                }
            }
        }
    });
</script>
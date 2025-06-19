<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PT. Ebako Furniture</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script type="text/javascript">
            var base_url = '<?php echo base_url() ?>index.php/';
            var userid = '<?php echo $this->session->userdata('id') ?>';
            var department = '<?php echo $this->session->userdata('department') ?>';
            var user_option_group = '<?php echo $this->session->userdata('optiongroup') ?>';
            var temp_index = 0;

//            document.onmousedown=disableclick;
//            status="Right Click Disabled";
//            function disableclick(event)
//            {
//                if(event.button==2)
//                {
//                    return true;    
//                }
//            }

        </script>
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="easyui2/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="easyui2/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="easyui2/jquery.min.js"></script>
        <script type="text/javascript" src="easyui2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="easyui2/datagrid-detailview.js"></script>
        <script type="text/javascript" src="easyui2/datagrid-groupview.js"></script>
<!--        <script type="text/javascript" src="easyui/jquery.panel.js"></script>-->
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript" src="js/jquery.key.js"></script>
        <script type="text/javascript" src="js/key.press.js"></script>
        <script type="text/javascript" >
            var check_session;
            function CheckForSession() {
                var str = "chksession=true";
                jQuery.ajax({
                    type: "POST",
                    url: base_url + "home/check_session",
                    data: str,
                    cache: false,
                    success: function (res) {
                        if (res === "1") {
                            clearInterval(check_session);
                            alert('Your session expired!');
                            location.reload();
                        }
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        clearInterval(check_session);
                        alert('Your session expired!');
                        location.reload();
                    }
                });
            }
//            check_session = setInterval(CheckForSession, 500000);
        </script>
        <script type="text/javascript" src="js/ajaxfileupload.js"></script>
    </head>
    <body class="easyui-layout" id="bodydata">
        <div data-options="region:'north'" border='false' class="header" style="height: 5px">

        </div>
        <div data-options="region:'west',split:true,collapsible:true" title="Main Menu" style="width: 15%;padding-left: 3px;background:#eff3f8;">
            <br/>
            <span style="font-size: 12px;font-weight: bold;">PT. EBAKO FURNITURE</span>
            <ul class="easyui-tree" lines='true' animate="true" style="padding-left: 0;padding-top: 5px;">
                <?php
                foreach ($menu_group as $result) {
                    $user_menu = $this->model_user->select_menu_user($result->menugroupid, $this->session->userdata('id'));
                    ?>
                    <li iconCls="<?php echo $result->icon_menu ?>" data-options="state:'closed'">
                        <span><b><?php echo $result->menugroupname ?></b></span>
                        <ul>
                            <?php foreach ($user_menu as $result2) { ?>
                                <li iconCls="<?php echo $result2->icon ?>"><a href="javascript:void(0)" style="text-decoration: underline;font-weight: bold" onclick="addTab('<?php echo $result2->label ?>', '<?php echo $result2->scriptmenu ?>')"><?php echo $result2->label ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>                    
                    <?php
                }
                if ($this->session->userdata('id') != 'beacukai') {
                    ?>
                    <li iconCls="<?php echo $result->icon_menu ?>" data-options="state:'closed'">
                        <span><b>User & Privilege</b></span> 
                        <ul>
                            <?php if ($this->session->userdata('id') == 'admin') { ?>
                                <li iconCls="icon-users"><a href="javascript:void(0)" style="text-decoration: underline;font-weight: bold" onclick="addTab('Users', 'users')">Users</a></li>
                            <?php } ?>
                            <li iconCls="icon-change-password"><a href="javascript:void(0)" style="text-decoration: underline;font-weight: bold" onclick="users_change_password_by_admin('<?php echo $this->session->userdata('id') ?>')">Change Password</a></li>
                            <li iconCls="icon-logout"><a href="index.php/home/logout" style="text-decoration: underline;font-weight: bold">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div region="center" border="false">
            <div id="tt" class="easyui-tabs"  data-options="fit:true,tabHeight:20">
                <div title="Home">
                    <div class="easyui-panel" fit="true" title="Dashboard">
                        <div class="container" style="padding: 1px;width: 100%">
                            <div>
                                <center>
                                    <!--<img src='<?php echo base_url() . "/files/logo-no-backgroung.png" ?>' style="max-height: 60px;max-width: 60px;border: none;margin-top: 15px"/><br/>-->
                                    <span style="font-size: 13px;font-weight: bold;">PT. EBAKO FURNITURE</span><br/>
                                    <strong>Welcome</strong><br/>
                                    <?php echo $this->session->userdata('name') . "(" . $this->session->userdata('id') . ") | " ?>
                                </center>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('item/order_recommendation') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('item/on_purchase') ?>">
                                    </div>
                                </div>
                            </div>

                            <!--Costing-->
                            <div class="row">
                                <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('costing/product_without_price') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('salesorder/unpaid_downpayment') ?>">
                                    </div>
                                </div>
                            </div>

                            <!--Marketing-->
                            <!--                            <div class="row">
                                                            <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                                                <div class="easyui-panel" fit="true"
                                                                     href="<?php echo site_url('salesorder/unpaid_downpayment') ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" style="min-height: 250px;margin-top: 10px">
                                                                <div class="easyui-panel" fit="true"
                                                                     href="<?php echo site_url('salesorder/must_shipping') ?>">
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--PPIC & Production-->
                            <div class="row">
                                <div class="col-xs-12" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('joborder/critical') ?>"> <!-- Critical Sales Order -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('joborder/critical_jo') ?>"><!-- Critical Job Order -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12" style="min-height: 250px;margin-top: 10px">
                                    <div class="easyui-panel" fit="true"
                                         href="<?php echo site_url('joborder/view_outsource_outstanding') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-options="region:'south',split:true,border:false,maxHeight:20" class="footer" style="height: 20px;">
            <center>Created By Jumadi Simangunsong 2025</center>
        </div>
        <div id="user_dialog"></div>
        <div id="global_dialog"></div>
        <div id="rpt_preview"></div>        
        <?php
        $this->load->view('item/dialogsearch');
        ?>
    </body>
</html>

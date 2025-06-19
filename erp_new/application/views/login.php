<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8" />
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script type="text/javascript" src="easyui/jquery.min.js"></script>
        <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    </head>
    <body>
    <center>
        <div class="lg-container">
            <div style="width: 100%;">                
                <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="bgcolor:#FFFFFF;">
                    <tr>                        
                        <td width="100%" colspan="2" style="border-bottom: 1px #FFFFFF solid;" align="center">
                            <span style="font-size: 32px;text-shadow: inherit; color: #002166; font-weight: bold;font-family: Georgia,'Times New Roman',Times,serif;letter-spacing:5px">
                                ERP
                            </span><br/>
                            <span style="color: #002166;font-size: 13px;font-style:inherit;font-weight: bold;">Ebako Resource Planning V 2.0</span>

                        </td>                        
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding: 5px;">
                            <span style="color: #HHHHHH;font-size: 16px;letter-spacing: 3px;font-weight: bold;padding: 10px;font-family: Georgia,'Times New Roman',Times,serif;">PT. Ebako Nusantara
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80%" align="center" valign="top">
                            <form id="lg-form" name="lg-form" method="post" action="<?php echo site_url('home/login') ?>" onsubmit="return $(this).form('validate')">
                                <table width='95%' border='0'>
                                    <tr>
                                        <td align='right' widh="30%"><label for="username" style="color: #002166;">Username : </label></td>
                                        <td width="70%"><input type="text" tabindex="1" name="username" required="true" size="20"></td>
                                    </tr>
                                    <tr>
                                        <td align='right'><label for="password" style="color: #002166;">Password : </label></td>
                                        <td><input type="password" tabindex="2" name="password" required="true" size="20"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td align="center"><button type="submit" id="login">Login</button></td>
                                    </tr>
                                </table>
                            </form><br/>
                        </td>
                        <td width="20%" valign="top">
                            <img src="css/key.png" style="border: none;max-width: 100%;max-height: 100%;width: 100%;height: 100%"/>
                        </td>
                    </tr>
                </table>
            </div> 
        </div>
    </center>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <!--
    ##     ## ########    ###    ########  
    ##     ## ##         ## ##   ##     ## 
    ##     ## ##        ##   ##  ##     ## 
    ######### ######   ##     ## ##     ## 
    ##     ## ##       ######### ##     ## 
    ##     ## ##       ##     ## ##     ## 
    ##     ## ######## ##     ## ########  
    -->
    <link rel="stylesheet/less" type="text/css" href="<?php echo HttpPath.GEN_PUBLIC_PATH?>/Stylesheets/text-editor.less" />
    <script src="<?php echo HttpPath.GEN_PUBLIC_PATH?>JS/less-1.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo HttpPath.GEN_PUBLIC_PATH?>JS/jquery-1.10.2.min.js" type="text/javascript"></script>
	
    <link rel="stylesheet" type="text/css" href="<?php echo HttpPath.GEN_PUBLIC_PATH?>JS/redactor/redactor.css">
    <script src="<?php echo HttpPath.GEN_PUBLIC_PATH?>JS/redactor/redactor.min.js" type="text/javascript"></script>
    <script src="<?php echo HttpPath.GEN_PUBLIC_PATH?>JS/text-editor.js" type="text/javascript"></script>
	

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Email Template - Geometric</title>
	<style type="text/css">
	a:hover { color: #09F !important; text-decoration: underline !important; }
	a:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }
	a:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }
	</style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">
<!--
########   #######  ########  ##    ## 
##     ## ##     ## ##     ##  ##  ##  
##     ## ##     ## ##     ##   ####   
########  ##     ## ##     ##    ##    
##     ## ##     ## ##     ##    ##    
##     ## ##     ## ##     ##    ##    
########   #######  ########     ##    
-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">
    <tr>
        <td>
            <!--email container-->
            <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">
                <tr>
                    <td>
                        <!--header-->
                        <table cellspacing="0" border="0" cellpadding="0" width="624">
                            <tr>
                                <td valign="top"> <img src="/public/exTemplate/spacer-top.jpg" height="12" width="624" />
                                    <!--top links-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td valign="middle" width="221">
                                                <p style="font-size: 12px; font-family: Helvetica, Arial, sans-serif; color: #333; margin: 0px;">Is this email not displaying correctly?</p>
                                            </td>
                                            <td valign="top" width="285">
                                                <p style="font-size: 12px; font-family: Helvetica, Arial, sans-serif; color: #333; margin: 0px;">
                                                    <webversion id="vw" style="float: left; padding: 5px; -webkit-border-radius: 3px; font-weight: bold; text-decoration: none; color: #333; -khtml-border-radius: 3px; background: #e9e8e8; -moz-border-radius: 3px; border-radius: 3px;">View it in a web browser</webversion>
                                                </p>
                                            </td>
                                            <td valign="top" width="118">
                                                <p style="font-size: 12px; font-family: Helvetica, Arial, sans-serif; color: #333; margin: 0px;">
                                                    <forwardtoafriend id="ff" style="float: left; padding: 5px; -webkit-border-radius: 3px; font-weight: bold; text-decoration: none; color: #FFF; -khtml-border-radius: 3px; background: #4b98d7; -moz-border-radius: 3px; border-radius: 3px;">Forward to a friend</forwardtoafriend>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/top links-->
                                    <!--line break-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td valign="top" width="624">
                                                <p><img src="/public/exTemplate/line-break.jpg" height="10" width="624" /></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/line break-->
                                    <!--header content-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td>
                                                <h1 class="mm-editable mm-text-small" style="color: #333; margin: 0px; font-weight: normal; font-size: 60px; font-family: Helvetica, Arial, sans-serif;">ABC Newsletter</h1>
                                                <h2 style="color: #333; margin: 0px; font-weight: normal; font-size: 30px; font-family: Helvetica, Arial, sans-serif;">//
                                                    <currentmonthname> <currentyear>
                                                </h2>
                                            </td>
                                            <td id="issue" valign="top" style="background-image: url('images/issue-no.jpg'); background-color: #4b98d7; background-repeat: no-repeat; background-position: top; width: 109px; height: 109px;" bgcolor="#4b98d7">
                                                <!--number-->
                                                <table width="104" align="right" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="52" height="73" valign="bottom"><img align="right" src="/public/exTemplate/no.jpg" width="43" height="35"></td>
                                                        <td width="52" valign="bottom">
                                                            <h3 class="mm-editable mm-text-small" style="margin: 0px; padding:0; font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #FFF;">12</h3>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!--/number-->
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/header content-->
                                </td>
                            </tr>
                        </table>
                        <!--/header-->
                        <!--line break-->
                        <table cellspacing="0" border="0" cellpadding="0" width="624">
                            <tr>
                                <td height="50" valign="middle" width="624"><img src="/public/exTemplate/line-break-2.jpg" height="13" width="624" /></td>
                            </tr>
                        </table>
                        <!--/line break-->
                        <!--email content-->
                        <table cellspacing="0" border="0" id="email-content" cellpadding="0" width="624">
                            <tr>
                                <td>
                                    <!--section 1-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td>
                                                <p class="mm-editable mm-text-image" style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/img1.jpg" height="286" alt="image dsc" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="622" /></p>
                                                <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/spacer-ten.jpg" height="10" width="624" /></p>
                                                <h2 class="mm-editable mm-text-small" style="font-size: 36px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Lorem ipsum dolor sit amet</h2>
                                                <p class="mm-editable mm-text-big" style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. <a href="#" style="color: #4b98d7; text-decoration: none;">Phasellus</a> a ipsum a risus volutpat placerat in nec mauris. Fusce sit amet enim erat, in sagittis arcu. <a href="#" style="color: #4b98d7; text-decoration: none;">Aliquam dolor dolor</a>, semper id tempor et, varius pulvinar tellus. Maurtis commodo urna at dui bibendum quis euismod velit egestas. Vestibulum ante ipsum primis in faucibus orci luctus et.</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/section 1-->
                                    <!--line break-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td height="30" valign="middle" width="624"><img src="/public/exTemplate/line-break-2.jpg" height="13" width="624" /></td>
                                        </tr>
                                    </table>
                                    <!--/line break-->
                                    <!--section 2-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td>
                                                <h3 style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Featured Items</h3>
                                                <img src="/public/exTemplate/line-break.jpg" height="10" width="624" />
                                                <table class="mm-editable mm-section mm-dupelicatable mm-removable" cellspacing="0" border="0" cellpadding="8" width="100%" style="margin-top: 10px;">
                                                    <tr>
                                                        <td valign="top" class="mm-editable mm-dupelicatable mm-removable mm-text-big">
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/img2.jpg" height="108" alt="img2" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="138" /></p>
                                                            <h4 style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 12px 0px;">Lorem ipsum dolor sit amet</h4>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. Phasellus a ipsum a risus volutpat placerat in nec mauris. Fusce sit</p>
                                                        </td>
                                                        <td valign="top" class="mm-editable mm-dupelicatable mm-removable mm-text-big">
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/img3.jpg" height="108" alt="img3" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="138" /></p>
                                                            <h4 style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 12px 0px;">Lorem ipsum dolor sit amet</h4>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. Phasellus a ipsum a risus volutpat placerat in nec mauris. Fusce sit</p>
                                                        </td>
                                                        <td valign="top" class="mm-editable mm-dupelicatable mm-removable mm-text-big">
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/img4.jpg" height="108" alt="img4" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="138" /></p>
                                                            <h4 style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 12px 0px;">Lorem ipsum dolor sit amet</h4>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. Phasellus a ipsum a risus volutpat placerat in nec mauris. Fusce sit</p>
                                                        </td>
                                                        <td valign="top" class="mm-editable mm-dupelicatable mm-removable mm-text-big">
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/img5.jpg" height="108" alt="img5" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="138" /></p>
                                                            <h4 style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 12px 0px;">Lorem ipsum dolor sit amet</h4>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. Phasellus a ipsum a risus volutpat placerat in nec mauris. Fusce sit</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/section 2-->
                                    <!--line break-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td height="30" valign="middle" width="624"><img src="/public/exTemplate/line-break-2.jpg" height="13" width="624" /></td>
                                        </tr>
                                    </table>
                                    <!--/line break-->
                                    <!--section 3-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td>
                                                <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"></p>
                                                <h3 style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Latest News Articles</h3>
                                                <!--line break-->
                                                <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                    <tr>
                                                        <td height="35" valign="top"> <img src="/public/exTemplate/line-break.jpg" height="10" width="624" /> </td>
                                                    </tr>
                                                </table>
                                                <!--/line break-->
                                                <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                    <tr>
                                                        <td valign="top" width="378" class="mm-editable mm-text-big">
                                                            <h3 style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Lorem ipsum dolor sit amet</h3>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. <a href="#" style="color: #4b98d7; text-decoration: none;">Phasellus</a> a ipsum a risus volutpat placerat in nec mauris. Fusce sit amet enim erat, in sagittis arcu. <a href="#" style="color: #4b98d7; text-decoration: none;">Aliquam dolor dolor</a>, semper id tempor et, varius pulvinar tellus. Maurtis commodo urna at dui bibendum quis euismod velit egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere <a href="#" style="color: #4b98d7; text-decoration: none;">Read more ›</a></p>
                                                        </td>
                                                        <td valign="top" width="246" class="mm-editable mm-text-image"><img src="/public/exTemplate/img6.jpg" align="right" height="239" alt="img6" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333; float: right;" width="217" /></td>
                                                    </tr>
                                                </table>
                                                <!--line break-->
                                                <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                    <tr>
                                                        <td height="40" valign="middle"> <img src="/public/exTemplate/line-break.jpg" height="10" width="624" /> </td>
                                                    </tr>
                                                </table>
                                                <!--/line break-->
                                                <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                    <tr>
                                                        <td valign="top" width="378" class="mm-editable mm-text-big">
                                                            <h3 style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Lorem ipsum dolor sit amet</h3>
                                                            <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. <a href="#" style="color: #4b98d7; text-decoration: none;">Phasellus</a> a ipsum a risus volutpat placerat in nec mauris. Fusce sit amet enim erat, in sagittis arcu. <a href="#" style="color: #4b98d7; text-decoration: none;">Aliquam dolor dolor</a>, semper id tempor et, varius pulvinar tellus. Maurtis commodo urna at dui bibendum quis euismod velit egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere <a href="#" style="color: #4b98d7; text-decoration: none;">Read more ›</a></p>
                                                        </td>
                                                        <td valign="top" width="246" class="mm-editable mm-text-image"><img src="/public/exTemplate/img7.jpg" align="right" height="239" alt="img7" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333; float: right;" width="217" /></td>
                                                    </tr>
                                                </table>
                                                <!--line break-->
                                                <div class="mm-editable mm-dupelicatable mm-removable mm-temp">
                                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                        <tr>
                                                            <td height="40" valign="middle"> <img src="/public/exTemplate/line-break.jpg" height="10" width="624" /> </td>
                                                        </tr>
                                                    </table>
                                                    <!--/line break-->
                                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                                        <tr>
                                                            <td valign="top" width="378" class="mm-editable mm-text-big">
                                                                <h3 style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">Lorem ipsum dolor sit amet</h3>
                                                                <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. <a href="#" style="color: #4b98d7; text-decoration: none;">Phasellus</a> a ipsum a risus volutpat placerat in nec mauris. Fusce sit amet enim erat, in sagittis arcu. <a href="#" style="color: #4b98d7; text-decoration: none;">Aliquam dolor dolor</a>, semper id tempor et, varius pulvinar tellus. Maurtis commodo urna at dui bibendum quis euismod velit egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere <a href="#" style="color: #4b98d7; text-decoration: none;">Read more ›</a></p>
                                                            </td>
                                                            <td valign="top" width="246" class="mm-editable mm-text-image"><img src="/public/exTemplate/img8.jpg" align="right" height="239" alt="img8" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333; float: right;" width="217" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/section 3-->
                                    <!--line break-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td height="30" valign="middle" width="624"><img src="/public/exTemplate/line-break-2.jpg" height="13" width="624" /></td>
                                        </tr>
                                    </table>
                                    <!--/line break-->
                                    <!--footer-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="624">
                                        <tr>
                                            <td>
                                                <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">You’re receiving this newsletter because you’ve subscribed to our Newsletter. 
                                                    Not interested anymore?
                                                    <unsubscribe style="color: #4b98d7; text-decoration: none;">Unsubscribe instantly.</unsubscribe>
                                                    <br />
                                                    <br />
                                                    Copyright &copy; 2010 ABC Industries.</p>
                                                <p style="font-size: 17px; line-height: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"><img src="/public/exTemplate/spacer-ten.jpg" height="10" width="624" /></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--/footer-->
                                </td>
                            </tr>
                        </table>
                        <!--/email content-->
                    </td>
                </tr>
            </table>
            <!--/email container-->
        </td>
    </tr>
</table>
<!--/100% body table-->
</body>
</html>
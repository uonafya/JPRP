<!---->
<!--/**-->
<!-- * Created by IntelliJ IDEA.-->
<!-- * User: banga-->
<!-- * Date: 22/09/15-->
<!-- * Time: 10:16-->
<!-- */-->
<!-- -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mailbox-MIMI
    </h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Mailbox</a></li>
        <li class="active">inbox-list</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" id="compose-mail-btn">Compose Mail</a>

                            <div class="space-25"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list m-b-md" style="padding: 0 list-style-type:none">
                                <li><a href="<?php echo base_url(); ?>message/index" class="btn"> <i
                                            class="fa fa-inbox "></i> Inbox <span
                                            class="label label-warning pull-right">4</span> </a></li>
                                <li><a id="sent-items-btn" class="btn"> <i class="fa fa-envelope-o"></i> Send Mail</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 animated fadeInRight message-section">
                <div class="mail-box-header">

                    <form method="get" action="index.html" class="pull-right mail-search">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name="search" placeholder="Search email">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                    <h2>
                        Inbox (4)
                    </h2>

                    <div class="mail-tools tooltip-demo m-t-md">
                        <div class="btn-group pull-right">
                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                        </div>
                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"
                                title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh
                        </button>
                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Mark as read"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Move to trash"><i class="fa fa-trash-o"></i></button>

                    </div>
                </div>
                <div class="mail-box">

                    <table class="table table-hover table-mail">
                        <tbody>
                        <tr class="unread">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="">Anna
                                    Smith</a></td>
                            <td class="mail-subject"><a href="<?php echo base_url(); ?>message/mail_detail">Lorem ipsum
                                    dolor noretek imit set.</a></td>
                            <td class=""><i class="fa fa-paperclip"></i></td>
                            <td class="text-right mail-date">6.10 AM</td>
                        </tr>
                        <tr class="unread">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks" checked>
                            </td>
                            <td class="mail-ontact"><a href="<?php echo base_url(); ?>message/mail_detail">Jack
                                    Nowak</a></td>
                            <td class="mail-subject"><a href="<?php echo base_url(); ?>message/mail_detail">Aldus
                                    PageMaker including versions of Lorem Ipsum.</a></td>
                            <td class=""></td>
                            <td class="text-right mail-date">8.22 PM</td>
                        </tr>
                        <tr class="read">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="mail_detail.html">Facebook</a> <span
                                    class="label label-warning pull-right">Clients</span></td>
                            <td class="mail-subject"><a href="mail_detail.html">Many desktop publishing packages and web
                                    page editors.</a></td>
                            <td class=""></td>
                            <td class="text-right mail-date">Jan 16</td>
                        </tr>
                        <tr class="read">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="mail_detail.html">Mailchip</a></td>
                            <td class="mail-subject"><a href="mail_detail.html">There are many variations of passages of
                                    Lorem Ipsum.</a></td>
                            <td class=""></td>
                            <td class="text-right mail-date">Mar 22</td>
                        </tr>
                        <tr class="read">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="mail_detail.html">Alex T.</a> <span
                                    class="label label-danger pull-right">Documents</span></td>
                            <td class="mail-subject"><a href="mail_detail.html">Lorem ipsum dolor noretek imit set.</a>
                            </td>
                            <td class=""><i class="fa fa-paperclip"></i></td>
                            <td class="text-right mail-date">December 22</td>
                        </tr>
                        <tr class="read">
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="mail_detail.html">Monica Ryther</a></td>
                            <td class="mail-subject"><a href="mail_detail.html">The standard chunk of Lorem Ipsum
                                    used.</a></td>
                            <td class=""></td>
                            <td class="text-right mail-date">Jun 12</td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!--sent Items-->
<div id="sent-items" style="display: none">
    <div class="mail-box-header">

        <form method="get" action="index.html" class="pull-right mail-search">
            <div class="input-group">
                <input type="text" class="form-control input-sm" name="search" placeholder="Search email">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Search
                    </button>
                </div>
            </div>
        </form>
        <h2>
            Sent Items
        </h2>

        <div class="mail-tools tooltip-demo m-t-md">
            <div class="btn-group pull-right">
                <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
            </div>
            <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i
                    class="fa fa-trash-o"></i></button>

        </div>
    </div>
    <div class="mail-box">

        <table class="table table-hover table-mail">
            <tbody>
            <tr class="unread">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks">
                </td>
                <td class="mail-ontact"><a href="<?php echo base_url(); ?>message/mail_detail">Anna Smith</a></td>
                <td class="mail-subject"><a href="<?php echo base_url(); ?>message/mail_detail">Lorem ipsum dolor
                        noretek imit set.</a></td>
                <td class=""><i class="fa fa-paperclip"></i></td>
                <td class="text-right mail-date">6.10 AM</td>
            </tr>
            <tr class="unread">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks" checked>
                </td>
                <td class="mail-ontact"><a href="<?php echo base_url(); ?>message/mail_detail">Jack Nowak</a></td>
                <td class="mail-subject"><a href="<?php echo base_url(); ?>message/mail_detail">Aldus PageMaker
                        including versions of Lorem Ipsum.</a></td>
                <td class=""></td>
                <td class="text-right mail-date">8.22 PM</td>
            </tr>
            <tr class="read">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks">
                </td>
                <td class="mail-ontact"><a href="mail_detail.html">Facebook</a> <span
                        class="label label-warning pull-right">Clients</span></td>
                <td class="mail-subject"><a href="mail_detail.html">Many desktop publishing packages and web page
                        editors.</a></td>
                <td class=""></td>
                <td class="text-right mail-date">Jan 16</td>
            </tr>
            <tr class="read">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks">
                </td>
                <td class="mail-ontact"><a href="mail_detail.html">Mailchip</a></td>
                <td class="mail-subject"><a href="mail_detail.html">There are many variations of passages of Lorem
                        Ipsum.</a></td>
                <td class=""></td>
                <td class="text-right mail-date">Mar 22</td>
            </tr>
            <tr class="read">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks">
                </td>
                <td class="mail-ontact"><a href="mail_detail.html">Alex T.</a> <span
                        class="label label-danger pull-right">Documents</span></td>
                <td class="mail-subject"><a href="mail_detail.html">Lorem ipsum dolor noretek imit set.</a></td>
                <td class=""><i class="fa fa-paperclip"></i></td>
                <td class="text-right mail-date">December 22</td>
            </tr>
            <tr class="read">
                <td class="check-mail">
                    <input type="checkbox" class="i-checks">
                </td>
                <td class="mail-ontact"><a href="mail_detail.html">Monica Ryther</a></td>
                <td class="mail-subject"><a href="mail_detail.html">The standard chunk of Lorem Ipsum used.</a></td>
                <td class=""></td>
                <td class="text-right mail-date">Jun 12</td>
            </tr>
            </tbody>
        </table>


    </div>
</div>

<!--Compose Mail-->
<div id="compose-mail" style="display: none">

    <div class="mail-box-header">
        <div class="pull-right tooltip-demo">
            <a href="<?php echo base_url(); ?>message/index" class="btn btn-danger btn-sm" data-toggle="tooltip"
               data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
        </div>
        <h2>
            Compose mail
        </h2>
    </div>
    <div class="mail-box">


        <div class="mail-body">

            <form class="form-horizontal" method="post" action="<?php echo base_url();?>message/save_mail" >
                <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                    <div class="col-sm-5"><input type="text" name="receiver"  title="receiver's  username" placeholder="admin"
                                                 class="form-control" required ></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                    <div class="col-sm-5"><input type="text" name="subject" placeholder="Hello" title="Subject of the Message"
                                                 class="form-control" value="" required></div>
                </div>

                <div class="form-group"><label class="col-sm-2 control-label">Message:</label>

                    <div class="col-sm-6">
                        <textarea class="form-control" name="content" required rows="15" id="comment"></textarea>
                    </div>
                </div>

                <div class="col-md-offset-2">
                    <button type="submit" class="btn btn-success"><i class="fa fa-reply"></i>Send</button>
                </div>
            </form>

        </div>

    </div>
</div>


<!--Message Details -->
<div id="message-details" style="display: none">
    <div class="mail-box-header">
        <div class="pull-right tooltip-demo">
            <a href="mail_compose.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
               title="Reply"><i class="fa fa-reply"></i> Reply</a>
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
               title="Move to trash"><i class="fa fa-trash-o"></i> </a>
        </div>
        <h2>
            View Message
        </h2>

        <div class="mail-tools tooltip-demo m-t-md">


            <h3>
                <span class="font-noraml">Subject: </span>Aldus PageMaker including versions of Lorem Ipsum.
            </h3>
            <h5>
                <span class="pull-right font-noraml">10:15AM 02 FEB 2014</span>
                <span class="font-noraml">From: </span>alex.smith@corporation.com
            </h5>
        </div>
    </div>
    <div class="mail-box">


        <div class="mail-body">
            <p>
                Hello Jonathan!
                <br/>
                <br/>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer
                took a galley of type and scrambled it to make a type <strong>specimen book.</strong>It was
                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                Ipsum. It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining
                essentially unchanged.
            </p>

            <p>
                It was popularised in the 1960s with the release <a href="#" class="text-navy">Letraset sheets</a>
                containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
            </p>

            <p>
                There are many variations of passages of <strong>Lorem Ipsum</strong>Lorem Ipsum available, but the
                majority have suffered alteration in some form, by injected humour, or randomised words which don't
                look even slightly believable. If you are going to use a passage of.
            </p>
        </div>

        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-reply"></i> Reply</a>
        </div>

    </div>
</div>

<!--Content-header compose mail-->
<div class="content-header-compose-mail" style="display: none">
    <h1>
        Mailbox
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Mailbox</a></li>
        <li class="active">compose Mail</li>
    </ol>
</div>

<!--Content-header sent mails-->
<div class="content-header-sent-items"  style="display: none">
    <h1>
        Mailbox
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Mailbox</a></li>
        <li class="active">sent items</li>
    </ol>
</div>

<!--Content-header message details-->
<div class="content-header-message-details" style="display: none">
    <h1>
        Mailbox
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Mailbox</a></li>
        <li class="active">message detail</li>
    </ol>
</div>



<!-- jQuery 2.0.2 -->
<script src="<?php echo base_url(); ?>/style/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>/style/js/bootstrap.min.js" type="text/javascript"></script>
<!--Main js libs-->
<script src="<?php echo base_url(); ?>js/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>js/slimscroll/jquery.slimscroll.min.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url(); ?>js/iCheck/icheck.min.js"></script>

<script>
    $(window).load(function () {
        $('#sent-items').hide();
        $('#compose-mail').hide();
        $('#message-details').hide();
    });

    $(document).ready(function () {
        $('#sent-items-btn').click(function () {
            $('.message-section').empty();
            var data = $("#sent-items").html();
            $('.message-section').append(data);

            $('.content-header').empty();
            var header = $(".content-header-sent-items").html();
            $('.content-header').append(header);
        });

        $('#compose-mail-btn').click(function () {
            $('.message-section').empty();
            var data = $("#compose-mail").html();
            $('.message-section').append(data);

            $('.content-header').empty();
            var header = $(".content-header-compose-mail").html();
            $('.content-header').append(header);
        });
    });
</script>


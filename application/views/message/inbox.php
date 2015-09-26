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
        Mailbox-<?php echo $this->session->userdata('username'); ?>
    </h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Mailbox</a></li>
        <li class="active">inbox-list</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box-header col-md-12">
        <?php if ($right) {
            echo '<h1 class="return-message" style="float: left; margin-left: 30%; margin-top: 0.2%; font-size: 18px; color: green">' . $error_message . '</h1>';
        } ?>

    </div>
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

                    <table id="inbox-mail-table" class="table table-hover table-mail">
                        <tbody>
                         <?php if ($received_mails!=false): ?>
                
                            <?php foreach ($received_mails as $mail): ?>
                                <tr class="unread mail-item" id="<?php echo $mail->message_id; ?>" data-sender="<?php echo $mail->sender_username; ?>" 
                                data-receiver="<?php echo $mail->receiver_username; ?>" data-content="<?php echo $mail->message_content; ?>"
                                data-subject="<?php echo $mail->message_subject; ?>" data-timestamp="<?php echo $mail->timestamp;?>">

                                <td class="check-mail">
                                    <input type="checkbox" class="i-checks">
                                </td>
                                <td class="mail-contact text-info"><?php echo $mail->sender_username; ?></td>
                                <td class="mail-subject text-warning"><?php echo substr($mail->message_subject,0,20); ?></td>
                                <td class=""><?php echo substr($mail->message_content,0,30); ?>...</td>
                                <td class="text-right mail-date text-success"><?php echo $mail->timestamp; ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>

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

        <table id="sent-mail-table" class="table table-hover table-mail">
            <tbody>
            <?php if ($sent_mails!=false): ?>
                
                <?php foreach ($sent_mails as $mail): ?>
                    <tr class="unread mail-item" id="<?php echo $mail->message_id; ?>" data-sender="<?php echo $mail->sender_username; ?>" 
                    data-receiver="<?php echo $mail->receiver_username; ?>" data-content="<?php echo $mail->message_content; ?>"
                    data-subject="<?php echo $mail->message_subject; ?>" data-timestamp="<?php echo $mail->timestamp;?>">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><?php echo $mail->receiver_username; ?></td>
                    <td class="mail-subject"><?php echo substr($mail->message_subject,0,20); ?></td>
                    <td class=""><?php echo substr($mail->message_content,0,30); ?>...</td>
                    <td class="text-right mail-date"><?php echo $mail->timestamp; ?></td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
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


<!--Received Message Details -->
<div id="inbox-message-detail" style="display: none">
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


            <h4>
                <span class="font-noraml">Subject: </span> <span id="message-subject">Aldus PageMaker including versions of Lorem Ipsum.</span>
            </h4>
            <h5>
                <span class="pull-right font-noraml" id="message-timestamp">10:15AM 02 FEB 2014</span>
                <span class="font-noraml">From: </span> <span id="message-sender">alex.smith@corporation.com</span>
            </h5>
        </div>
    </div>
    <div class="mail-box">


        <div class="mail-body">
            <p id="message-content">
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
        </div>

        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-reply"></i> Reply</a>
        </div>

    </div>
</div>

<!--Sent Message Details -->
<div id="sent-message-detail" style="display: none">
    <div class="mail-box-header">
        <div class="pull-right tooltip-demo">
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
               title="Move to trash"><i class="fa fa-trash-o"></i> </a>
        </div>
        <h2>
            View Message
        </h2>

        <div class="mail-tools tooltip-demo m-t-md">


            <h4>
                <span class="font-noraml">Subject: </span> <span id="message-subject">Aldus PageMaker including versions of Lorem Ipsum.</span>
            </h4>
            <h5>
                <span class="pull-right font-noraml" id="message-timestamp">10:15AM 02 FEB 2014</span>
                <span class="font-noraml">To: </span> <span id="message-receiver">alex.smith@corporation.com</span>
            </h5>
        </div>
    </div>
    <div class="mail-box">


        <div class="mail-body">
            <p id="message-content">
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
        </div>

        <div class="mail-body text-right tooltip-demo">
         <!--    <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-reply"></i> Reply</a> -->
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
<div class="content-header-message-detail" style="display: none">
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

    // Hide error/Success message after 5 seconds
        setTimeout(function() {
             $('.return-message').fadeOut('fast');
        }, 5000);
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


        // Load
         $('body').delegate('#inbox-mail-table .mail-item', 'click', function (event) {

            $('.message-section').empty();
            var data = $("#inbox-message-detail").html();
            $('.message-section').append(data);

            $('.content-header').empty();
            var header = $(".content-header-message-detail").html();
            $('.content-header').append(header);

            //add message contents
            $('#message-subject').empty();
            var subject=$(this).closest('tr').data('subject');
            $('#message-subject').text(subject);

            $('#message-sender').empty();
            var sender=$(this).closest('tr').data('sender');
            $('#message-sender').text(sender);

            $('#message-timestamp').empty();
            var timestamp=$(this).closest('tr').data('timestamp');
            $('#message-timestamp').text(timestamp);

            $('#message-content').empty();
            var content=$(this).closest('tr').data('content');
            $('#message-content').text(content);
        });
    // Load Sent Item Message details
         $('body').delegate('#sent-mail-table .mail-item', 'click', function (event) {

            $('.message-section').empty();
            var data = $("#sent-message-detail").html();
            $('.message-section').append(data);

            $('.content-header').empty();
            var header = $(".content-header-message-detail").html();
            $('.content-header').append(header);

            //add message contents
            $('#message-subject').empty();
            var subject=$(this).closest('tr').data('subject');
            $('#message-subject').text(subject);

            $('#message-receiver').empty();
            var receiver=$(this).closest('tr').data('receiver');
            $('#message-receiver').text(receiver);

            $('#message-timestamp').empty();
            var timestamp=$(this).closest('tr').data('timestamp');
            $('#message-timestamp').text(timestamp);

            $('#message-content').empty();
            var content=$(this).closest('tr').data('content');
            $('#message-content').text(content);
        });
    });
</script>


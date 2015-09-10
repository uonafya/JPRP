<link rel="stylesheet" href="<?php echo base_url(); ?>/style/js/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/style/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/style/date/css/default.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/style/bootstrap-dialog/css/base.css" type="text/css">

<script src="<?php echo base_url(); ?>/style/js/jquery-1.10.2.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>/style/js/jquery-ui.js"></script>

<div id="results"></div>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Update <?php echo $mechanism->mechanism_name; ?> Details
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Mechanism Management</a></li>
        <li class="active">Update Mechanism</li>
    </ol>
</section>

<section class="content">

    <form class="donor_form" id="Mechanism_details" action="<?php echo base_url('mechanisms/update_mechanism') ?>"
          method="post" style="margin-left: -30px ">
        <ul>
            <li>
                <h2>Mechanism Details </h2>
                <span class="required_notification">* Denotes Required Field</span>
            </li>
            <li>
                <label for="name">Mechanism Name:</label>
                <input type="text" name="mechanism_name" id="" value="<?php echo $mechanism->mechanism_name; ?>"
                       placeholder="9171 - South Rift Valley" required pattern="{10,}"/>
                <span class="form_hint">Mechanism Name Must Be Of Atleast 10 Characters</span>
            </li>
            <li>
                <label for="name">Datim ID:</label>
                <input type="text" name="datim_id" id="" readonly value="<?php echo $mechanism->datim_id; ?>"
                       placeholder="11243" pattern="[1-9][0-9]{4,}"/>
                <!-- <span class="form_hint">Mechanism ID Must Be Of Atleast 4 Integer Character Long</span> -->
            </li>
            <li>
                <label for="name">Partner Name:</label>
                <input type="text" name="partner_name" id="" value="<?php echo $mechanism->partner_name; ?>"
                       placeholder="South Rift Valley VCT" required pattern="{10,}"/>
                <span class="form_hint">Partner Name Must Be Of Atleast 10 Characters</span>
            </li>
            <li>
                <label for="name">KePMS ID:</label>
                <input type="text" name="kepms_id" id="" value="<?php echo $mechanism->mechanism_id; ?>"
                       placeholder="124" pattern="[1-9][0-9]{1,}"/>
                <span class="form_hint">KePMS ID Must Be Of Atleast 1 Integer Character Long</span>
            </li>
            <li>
                <label for="name">Mechanism Start Date:</label>
                <input type="text" name="start_date" id="start_date" value="<?php echo $mechanism->start_date; ?>"
                       required pattern="\d{4}-\d{1,2}-\d{1,2}" placeholder="yyyy-mm-dd"/>
                <span class="form_hint">Date format must be yyyy-mm-dd</span>
            </li>
            <li>
                <label for="name">Mechanism End Date:</label>
                <input type="text" name="end_date" id="end_date" value="<?php echo $mechanism->end_date; ?>" required
                       pattern="\d{4}-\d{1,2}-\d{1,2}" placeholder="dd-mm-yyyy"/>
                <span class="form_hint">Date format must be yyyy-mm-dd</span>
            </li>
            <li style="margin-left: 20%; width: 100%">
                <button class="submit" type="submit">Submit</button>
            </li>
        </ul>

    </form>

</section>


<script type="text/javascript">

    $(document).ready(function () {

        $("#start_date").datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            numberOfMonths: 1,
            altFormat: "mm-dd-yy",
            onClose: function (selectedDate) {
                $("#end_date").datepicker("option", "minDate", selectedDate);
            }
        });

        $("#end_date").datepicker({
            defaultDate: "+4w",
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            numberOfMonths: 1,
            altFormat: "mm-dd-yy",
            onClose: function (selectedDate) {
                $("#start_date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

</script>


<link rel="stylesheet" href="<?php echo base_url(); ?>/style/date/css/default.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/style/bootstrap-dialog/css/base.css" type="text/css">


<script type="text/javascript" src="<?php echo base_url(); ?>/style/date/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/style/date/js/core.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/style/bootstrap-dialog/js/jquery-impromptu.js"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>/style/js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url(); ?>/style/js/plugins/datatables/jquery.dataTables.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/style/js/plugins/datatables/dataTables.bootstrap.js"
        type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/style/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>/style/js/AdminLTE/demo.js" type="text/javascript"></script>
 
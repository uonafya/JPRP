                <link rel="stylesheet" href="<?php echo base_url(); ?>/style/js/jquery-ui.css">
                
                <script src="<?php echo base_url(); ?>/style/js/jquery-1.11.3.min.js"></script>    
                    
                    <style>    
                    /* === Button Style === */
                    button.submit {
                        background-color: #68b12f;
                        background: -webkit-gradient(linear, left top, left bottom, from(#68b12f), to(#50911e));
                        background: -webkit-linear-gradient(top, #68b12f, #50911e);
                        background: -moz-linear-gradient(top, #68b12f, #50911e);
                        background: -ms-linear-gradient(top, #68b12f, #50911e);
                        background: -o-linear-gradient(top, #68b12f, #50911e);
                        background: linear-gradient(top, #68b12f, #50911e);
                        border: 1px solid #509111;
                        border-bottom: 1px solid #5b992b;
                        border-radius: 3px;
                        -webkit-border-radius: 3px;
                        -moz-border-radius: 3px;
                        -ms-border-radius: 3px;
                        -o-border-radius: 3px;
                        box-shadow: inset 0 1px 0 0 #9fd574;
                        -webkit-box-shadow: 0 1px 0 0 #9fd574 inset ;
                        -moz-box-shadow: 0 1px 0 0 #9fd574 inset;
                        -ms-box-shadow: 0 1px 0 0 #9fd574 inset;
                        -o-box-shadow: 0 1px 0 0 #9fd574 inset;
                        color: white;
                        font-weight: bold;
                        padding: 6px 20px;
                        text-align: center;
                        text-shadow: 0 -1px 0 #396715;
                    }
                    button.submit:hover {
                        opacity:.85;
                        cursor: pointer; 
                    }
                    button.submit:active {
                        border: 1px solid #20911e;
                        box-shadow: 0 0 10px 5px #356b0b inset; 
                        -webkit-box-shadow:0 0 10px 5px #356b0b inset ;
                        -moz-box-shadow: 0 0 10px 5px #356b0b inset;
                        -ms-box-shadow: 0 0 10px 5px #356b0b inset;
                        -o-box-shadow: 0 0 10px 5px #356b0b inset;
                        
                    }       
                    
                    div.dataTables_filter input {
                        height: 30px;
                        width: 17em;
                    }
                </style>


				<script>
					
                    function programdelete(data, name){
                        //alert(data);
                        var temp = {
                            state0: {
                                title:'Delete '+name,
                                html:'Do you want to Delete '+name+' Program?',
                                buttons: { Cancel: false, Submit: true },
                                focus: 1,
                                submit:function(e,v,m,f){ 
                                    if(!v)
                                        $.prompt.close();
                                    else { 
                                    	//alert("robin");
                                        form_url = "<?php echo base_url('programmanager/deleteprogram')?>"+"/"+data; 
                                            alert(form_url);
                                        $.ajax({ 
                                            url: form_url, 
                                            dataType: 'text', 
                                            type: 'post', 
                                            success: function( data, textStatus, jQxhr ){ 
                                                $('#response').html(data);
                                                $.prompt.goToState('state1');//go forward 
                                            }, 
                                            error: function( jqXhr, textStatus, errorThrown ) {
                                                console.log( errorThrown ); 
                                            }
                                        });
                                    }
                                    return false; 
                                }
                            },
                            state1: {
                                title: name+' Delete Confirmation',
                                html:'<p id="response"></p>',
                                buttons: {Finish: 1 },
                                focus: 0,
                                submit:function(e,v,m,f){
                                    if(v==1)
                                        window.location.reload(true); //Refresh page to reflect the changes
                                    else  $.prompt.close();//close dialog
                                    return false; 
                                }
                            }
                        };

                        $.prompt(temp,{
                            close: function(e,v,m,f){
                                if(v !== undefined){
                                    window.location.reload(true);
                                }
                            },
                            classes: {
                                    box: '',
                                    fade: '',
                                    prompt: '',
                                    close: '',
                                    title: 'lead',
                                    message: '',
                                    buttons: '',
                                    button: 'btn',
                                    defaultButton: 'btn-primary'
                            }
                        });
                    }					
					
					
				</script>





                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Programs
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Programs</a></li>
                        <li class="active">Programs</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Programs </h3>
                                    <?php if($program_right){echo  '<h1 style="float: left; margin-left: 15%; margin-top: 0.2%; font-size: 18px; color: red">'.$error_message.'</h1>'; } ?>
                                    <?php if($program_right){echo  '<a href="'.base_url('programmanager/createprogram').'" class="btn btn-primary btn-sm" style="float: right; margin-right: 10%; margin-top: 0.2%; font-size: 14px; color: white">Create Program</a>'; } ?>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="programs-table" class="table table-bordered table-striped" >                                    	
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Program ID</th>
                                            <th style="width:10%">Program UID</th>
                                            <th style="width:25%">Program Name</th>
                                            <th style="width:20%">Program Shortname</th>
                                            <th style="width:25%">Program Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                    	    if ($programs!='') {
                                                foreach ($programs as $row ) {
                                                    echo "<tr class='grade_tr' data-id='".$row->program_id."' data-name='".$row->program_name."'>";
                                                    echo "<td>$row->program_id</td>";
                                                    echo "<td>$row->uid</td>";
                                                    echo "<td>$row->program_name</td>";
													echo "<td>$row->program_shortname</td>";
                                                    echo "<td>$row->program_description</td>";
                                                    //echo "<td><a href='".base_url('programmanager/viewprogram/'.$row->program_id)."'/>View</a>&nbsp&nbsp ";
													//if($program_right){echo "<a href='".base_url('programmanager/editprogram/'.$row->program_id)."' style='color:green'/> Edit</a>  &nbsp&nbsp ";};
                                                    //if($attribution_right){echo "<a href='#' onclick=\"programdelete('$row->program_id','$row->program_name')\"  style='color:red'/> Delete</a> &nbsp&nbsp ";}; 
													//if($attribution_right){echo "<a href='".base_url('programmanager/program_data_attribution'.$row->program_id)."' style='color:purple'/> Attribute</a> ";};
                                                    //echo " </td>";
                                                    echo "</tr>";
                                                }  
											}

                                    	
                                    	?>
                                    </tbody>
    
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
 

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#programs-table').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true
                });
            });
        </script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/style/bootstrap-dialog/css/base.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url(); ?>/style/bootstrap-dialog/js/jquery-impromptu.js"></script>              
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>/style/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url(); ?>/style/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/style/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>/style/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url(); ?>/style/js/AdminLTE/demo.js" type="text/javascript"></script>
        

<!-- Pop over Class -->

<style type="text/css">

/*table{
    -moz-user-select: none;
}
*/
.contextMenu {
      position: absolute;
      font-size: 9pt;
      color: #000;
      border: 1px solid #ddd;
      padding-left: 4px;
      padding-right: 4px;
      width: 60px;
      max-height: 400px;
      overflow-y: auto;
      background-color: #f7f7f7;
      display: none;
      z-index: 9;
      filter: alpha(opacity=98);
      opacity: 0.98;
      border-bottom-left-radius: 3px;
      border-bottom-right-radius: 3px;
      box-shadow: #ccc 0 1px 1px 0;
}

.contextMenuItemActive{
  background-color: #246BA1 !important;
  color: #fff !important;
}

</style>
        






<div id="contextMenuID" class="contextMenu" style="width: 200px; display:block;" >
<button type="button" class="close" id="btn-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<br/>
<ul class="" style="list-style-type:none">
	<?php
		echo '<li class=""><a href="#" id="view"><i class="fa fa-plus"></i> View</a></li> <br>';
		if($program_right){echo '<li class=""><a href="#" id="update"><i class="fa fa-edit"></i> Update</a></li> <br>';};
		if($program_right){echo '<li class=""><a href="#" id="delete" onclick=""><i class="fa fa-trash-o"></i> Delete</a></li> <br>';};
        if($attribution_right){echo '<li class=""><a href="#" id="attribute"><i class="fa fa-plus"></i> Attribute</a></li> <br>';}; 
		if($attribution_right){echo '<li class=""><a href="#" id="description"><i class="fa fa-info-circle"></i> Show details</a></li>';}; 
	?>	
</ul>
</div>


        

        
 <!--  -->
    <script>

        $(document).ready(function() {
        	$("#contextMenuID").hide();
            $('#programs-table').DataTable(); 


            $('body').delegate('#programs-table .grade_tr', 'click', function (event) {
            	
            	
                var menuHeight = $('.contextMenu').height();
                var menuWidth = $('.contextMenu').width();
                var winHeight = $(window).height();
                var winWidth = $(window).width();

                var pageX = event.pageX;
                var pageY = event.pageY;

                if( (menuWidth + pageX) > winWidth ) {
                  pageX -= menuWidth;
                }

                if( (menuHeight + pageY) > winHeight ) {
                  pageY -= menuHeight;

                  if( pageY < 0 ) {
                    pageY = event.pageY;
                  }
                }

                var mouseCoordinates = {
                    x : pageX,
                    y : pageY
                };


                $("#contextMenuID").show();
                $("#contextMenuID").css({"top":mouseCoordinates.y,"left":mouseCoordinates.x});
                
                $("tbody tr").removeClass("contextMenuItemActive");
                $(this).addClass("contextMenuItemActive");
                var id = $(this).closest('tr').data('id');
                var name = $(this).closest('tr').data('name');
                 document.getElementById("view").href="<?php echo base_url();?>"+"programmanager/viewprogram/"+id;
                 document.getElementById("update").href="<?php echo base_url();?>"+"programmanager/editprogram/"+id;
                 document.getElementById("delete").setAttribute('onclick',"programdelete('"+id+"','"+name+"')");
                 document.getElementById("view").href="<?php echo base_url();?>"+"programmanager/viewprogram/"+id;

            });

            $("#btn-dismiss, thead, tfoot").click(function () {

                 $("#contextMenuID").hide(100);
                 $("tr").removeClass("contextMenuItemActive");

             })

        });
        
    </script>        
 
@extends('layouts.default')
@section('title', 'Users')
@section('content')
<?php //echo "<pre>";print_r($data['users']); echo "</pre>";die; ?>
<div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Users Management</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              
                <!-- <a href="javascript: void(0);" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Buy Admin Now</a> -->
                <ol class="breadcrumb">
                    <li>  
                    <button type="button" class="btn btn-info btn-outline waves-effect waves-light" data-toggle="modal" data-target="#add-contact"><i class="fa fa-plus"></i> Add Folder</button>
					 <button type="button" class="btn btn-info btn-outline waves-effect waves-light" data-toggle="modal" data-target="#add-contact"><i class="fa fa-plus"></i> Add File</button>
                    
                </ol>
            </div>
            <!-- /.col-lg-12 -->
            </div>
<div class="row" id="filters" style="display: none;">
    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Tickets Filteration</h3>
                         

                            <form class="form-horizontal" action="#" method="GET">
                            <div class="row">
                             <div class="col-sm-3">
                                    <h5 class="m-t-30 m-b-10">Name</h5>
                                   <input type="text" class="form-control" name="fname" value="{{ Request::get('fname') }}">
                                </div>
                                
                                 <div class="col-sm-3">
                                    <h5 class="m-t-30 m-b-10">Email</h5>
                                   <input type="text" class="form-control" name="femail" value="{{ Request::get('femail') }}">
                                </div>
                                  <div class="col-sm-3">
                                    <h5 class="m-t-30 m-b-10">Department</h5>
                                   <input type="text" class="form-control" name="fdepartment" value="{{ Request::get('fdepartment') }}">
                                </div>
                                 
                              
                                <div class="col-sm-3 pull-right text-right">
 <h5 class="m-t-30"></h5>
                          <button id="deselect-all" class="btn btn-info btn-outlinef" href="#">Apply Filter</button>
                          <a id="refresh" class="btn btn-warning btn-outline" href="#">Reset</a>
                         </div>
                            </div>
                         
                           <!--   <div class="row">
                                <div class="col-md-4 pull-right text-right">
 <h5 class="m-t-30"></h5>
                          <button id="deselect-all" class="btn btn-info btn-outline" href="#">Apply Filter</button>
                          <a id="refresh" class="btn btn-warning btn-outline" href="#">Reset</a>
                         </div>
                         </div> -->
                         </form>
                        </div>
                    </div>
</div>
            <div class="row">
            <div class="col-md-12">
            <div class="white-box">
            <h3 class="box-title">Users List </h3>
            <div class="scrollable">
                <div class="table-responsive">
				<div align="center">
				@if(Session::has('message'))<div class="alert alert-success fade in alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button>
	  {{ Session::get('message') }}
	    	</div>@endif
			
		

				<div class="alert alert-success fade in alert-dismissible" style="color:green;display:none" id="updatedSucess">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button> Record Updated Sucessfully</div>
				
				<div class="alert alert-danger fade in alert-dismissible" style="color:green;display:none" id="updatedSucess1">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button> Record Deleted Sucessfully</div>
		
		<div class="alert alert-success fade in alert-dismissible" style="color:green;display:none" id="insert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button> Record Add Sucessfully</div>
		
		
				<!--<span style="color:green;display:none" id="insert"> Record Add Sucessfully</span>-->
				
				</div>
							 
			 				 
					 <div class="table-responsive">
					 
                                              
								
								<table id="datatable_user" class="table m-t-30 table-hover contact-list display nowrap" data-page-size="10">
                        <thead>
						
                            <tr>
                                <th>No</th>
                                <th>Name</th>
								
                                <th>Quantity</th>
                               
                              <th>Mobile</th>
								
                                <th class="nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $i=1; ?>
						@foreach($data['users'] as $key => $user)
				
                            <tr class="footable-even" style="display: table-row;" id="row_{{ $user->id }}">
                                <td><span class="footable-toggle"></span><?php echo $i++;?></td>
                                <td>
                                    <a href="#"> {{ $user->name }}</a>
                                </td>
								
                                <td>{{ $user->quantity }}</td>
                               
                                <td>{{ $user->rate }}</td>
                               
                            
								 <td>
								
								 <a href = 'javascript:void(0);' class="deleteProduct btn btn-danger btn-outline btn-circle btn-lg m-r-5" onclick="deleteFunc('{{ $user->id }}');" data-confirm="Are you sure you want to delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                 <!--<button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>-->
                                </td>
                            </tr>
                       @endforeach
                            
                        </tbody>
						
				
		

						
                    </table>
                </div>
				</div>
            </div>
            </div>
            </div>
            </div>
			
				 
			
			 
@endsection
			
@section('script')

<link rel="stylesheet" href="{{url('public/assets/admin/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css')}}" />

<script src="{{url('public/assets/admin/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
<script id="datatablecode">
ajaxDataTableScript();
function ajaxDataTableScript(){
	$('#datatable_user').DataTable({
		"oLanguage": {

	"sSearch": "Filter:"

	},
	'aoColumnDefs': [{
	        'bSortable': false,
	        'aTargets': ['nosort']
	    }]
	//dom: 'Bfrtip',
	// "bSort": false, 
	});

}

</script>

								
      <script type="text/javascript">

	$(document).ready(function() {	
		

	$('#files').change(function(e) {
	var filename = e.target.files[0].name;
	$(".fileupload span").html(filename);
	if (filename == "") {
	$(".fileupload span").text('No File Choosen');
	}
	});
				
			$(".btn-submit").click(function(e){
				$("#datatable_user").dataTable().fnDestroy();
			e.preventDefault();
			var _token = $("input[name='_token']").val();
			var name = $("input[name='name']").val();
			var email = $("input[name='email']").val();
			var password = $("input[name='password']").val();
			var phone = $("input[name='phone']").val();
			var deparment = $("input[name='deparment']").val();
			var stime = $("#stime option:selected").val()
			var supervisor = $("#supervisor option:selected").val();
			var role = $("#role option:selected").val()
			var extension_id = $("input[name='extension_id']").val();
			var image = $("input[name='image']").val();
        $('.updateloader').show();
			$.ajax({
			url: "{{url('users')}}",
			type:'POST',
			data: {_token:_token, name:name, email:email, password:password, phone:phone, deparment:deparment, stime:stime, supervisor:supervisor, role:role, extension_id:extension_id, image:image},
		
			success: function(data) {
			
			if(data.code ==200)
					{
					$('#datatable_user').html(data.html);
					$("#add-contact").modal('hide');
					$('#insert').show();
					ajaxDataTableScript();
					$('#updatedSucess').hide();
					$('#updatedSucess1').hide();
					
                    setTimeout(function(){
					  $('.updateloader').hide();
					}, 400);
					}
			
			
			
			else{
			alert("Not Add");
			$('.updateloader').hide();
			}
			
			}
			
			});

			}); 
		
			});
			
			

				function modalFunc(id,email)
				{

				$.ajax({
				url: "{{url('edituser')}}",
				type:'get',
				data : {id:id},
				beforeSend:function(){
				    $('.updateloader').show();
				     },
				success: function(data) {
				$('#edit').modal();
				$('#edit').html(data.html);
				$('.updateloader').hide();
				}
				});
				}

					function editFunc(id)
					{$("#datatable_user").dataTable().fnDestroy();
					var name = document.getElementById('name').value;
					var email = document.getElementById('email').value;
					var phone = document.getElementById('phone').value;
					var ext = document.getElementById('ext').value;
					var shifttime = document.getElementById('shifttime').value;
					var supervisor = document.getElementById('supervisor').value;
		            var updaterole = document.getElementById('updaterole').value;
		            var extension_id = document.getElementById('extension_id').value;
					
					$.ajax({
					url: "{{url('edituserdata')}}",
					type:'get',
					data : {id:id,name:name,email:email,phone:phone,ext:ext,shifttime:shifttime,supervisor:supervisor,updaterole:updaterole,extension_id:extension_id},
					beforeSend:function(){
				    $('.updateloader').show();
				     },
					success: function(data) {   
					if(data.code == 200)
					{
                   
					$("#datatable_user").html(data.html);	
					$('#updatedSucess').show();
					$("#edit").modal('hide');
					ajaxDataTableScript();
				 setTimeout(function(){
                            $('.updateloader').hide();
                }, 300);

					}else{
					alert('error');
					}
					}
					});
					}
					
					
				function deleteFunc(id)
				{
					$("#datatable_user").dataTable().fnDestroy();
				var r = confirm("Are you sure you want to delete");
				if(r == true)
				{
				$.ajax({
				url: "deleteuser/"+id,
				type:'get',
				data : {id:id},
				beforeSend:function(){
				    $('.updateloader').show();
				     },
				success: function(data) {
				if(data==1)
				{
				$('#row_'+id).hide();
				$('#updatedSucess1').show();
				$('#delete').show();
				
				ajaxDataTableScript();
				 setTimeout(function(){
                            $('.updateloader').hide();
                }, 300);
				}
				else{
				alert("Not Deleted");
				}

				}
				});
				}

				else
				{
				window.location="users";           
				}

				}
				
				
			$(".btn-outlinef").click(function(e){
			e.preventDefault();
    $("#datatable_user").dataTable().fnDestroy();
			var fname = $("input[name='fname']").val();
			var femail = $("input[name='femail']").val();
			var fdepartment = $("input[name='fdepartment']").val();
			var fsupervisor=$('#fsupervisor').val();
			var fstime=$('#fstime').val();
			
		
            $.ajax({
                url: "{{url('user-filter')}}",
                method:'get',
                data : {fname:fname,femail:femail,fdepartment:fdepartment,fsupervisor:fsupervisor,fstime:fstime},
				beforeSend: function(data){
				$('.updateloader').show();
				},
                success: function(data) { 				
                    if(data.code == 200) {
                  
                        $("#datatable_user").html(data.html);

						ajaxDataTableScript();

				 setTimeout(function(){
                           $('.updateloader').hide();
                }, 300);
                    }else{
						
					$('.updateloader').hide();
                    }
                }
            });
    }); 
				
				
				

$(".filtertemplate").click(function(){
$("#filters").slideToggle();
});
		</script>		
      @endsection

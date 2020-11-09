@extends('layouts.default')
@section('title', 'User-roles')
@section('content')

<div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Roles</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <!--   <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button> -->
                <!-- <a href="javascript: void(0);" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Buy Admin Now</a> -->
                <ol class="breadcrumb">
                    <li> <button type="button" class="btn btn-info btn-outline" data-toggle="modal" data-target="#add-contact"><i class="fa fa-plus"></i> Add Role</button></li>
                     <li> <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-info btn-outline">Download Excel xls</button></a></li>
                </ol>
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
            <div class="white-box">
            <h3 class="box-title">Roles listing</h3>
			<h2 class="loader" style="display:none;">Please Waite work in Progress</h2>
			<div align="center">
			<div class="alert alert-success fade in alert-dismissible" id="insert" style="display:none">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button>
		Record Add Sucessfully</div>
		
		<div class="alert alert-success fade in alert-dismissible" id="updatedSucess" style="display:none">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button>
		Record Updated Sucessfully</div>
		
		<div class="alert alert-danger fade in alert-dismissible" id="updatedSucess1" style="display:none">
	    <button type="button" class="close" data-dismiss="alert" aria-label="close" title="close">x</button>
		Record Deleted Sucessfully</div>

		
			</div>	
            <div class="scrollable">
                <div class="table-responsive">
                  
								
								
								<table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list footable-loaded footable" data-page-size="10">
                        <thead>
                            <tr>
                                <th class="footable-sortable">No<span class="footable-sort-indicator"></span></th>
                                <th class="footable-sortable">Role Title</th>
                                <th class="footable-sortable">Created date<span class="footable-sort-indicator"></span></th>
                                <th class="nosort footable-sortable">Action<span class="footable-sort-indicator"></span></th>
                            </tr>
                        </thead>
                        <tbody>
						@if(count($rolesmaster)>0)
						<?php $i=1 ;?>
						@foreach ($rolesmaster as $role)
                            <tr class="footable-even" style="display: table-row;" id="row_{{ $role->id }}">
                                <td><?php echo $i++;?></td>
                                <td>{{ $role->role }}</td>
                                <td>{{ date('d-m-Y', strtotime($role->created_at)) }}</td>
								
								<!--<td><button class="edit-modal btn btn-info" data-id="{{$role->id}}"
                    data-name="{{$role->role}}">-->
					
							 <td>
							 <button class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="modalFunc({{$role->id}})">
                    <span class="fa fa-edit"></span> </button>
					<a href = 'javascript:void(0);' class="btn btn-danger btn-outline btn-circle btn-lg m-r-5" onclick="deleteFunc('{{ $role->id }}');" data-confirm="Are you sure you want to delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
								  </td>
                            </tr>
                        @endforeach
												@else
					<tr>
						<td colspan="10"><i>No Data Found</i></td>
					</tr>
				@endif 
                        </tbody>
                     
                    </table>
                </div>
            </div>
            </div>
            </div>
            </div>













  <div id="add-contact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
									
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Add New Role</h4> </div>
                                            <div class="modal-body">
                                                <form  action="" method="post" enctype="multipart/form-data" id="sendmemessage1">
												<input type ="hidden" name ="_token" value ="<?php echo csrf_token(); ?>">
		{{ csrf_field() }}
		<input type ="hidden" name ="status" value ="1">
                                                    <div class="form-group">
                                                        <div class="col-md-12 m-b-20">
                                                            <input type="text" class="form-control" placeholder="Role Title" name="role" required> </div>
                                                        
                                                        
                                                    </div>
													
				<!--<div class="ajax-loader">
				<img src="{{ url('public/loader.gif') }}" class="img-responsive" />
				</div>-->
                                                    
													<div class="form-group">
                                                        <div class="col-md-12 m-b-20 text-right">
                                                         <button type="button" class="btn btn-success btn-submit">Submit</button>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                        </div>
													 </form>
                                               <div class="clearfix"></div>
                                            </div>
                                           
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
								
							                    <div id="add-contact1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                </div>	

@endsection



@section('script')
<script src="{{url('public/assets/admin/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script> 


<script>
				$(document).ready(function() {
					$(".btn-submit").click(function(e){
					e.preventDefault();
					var _token = $("input[name='_token']").val();
					var role = $("input[name='role']").val();
					var status = $("input[name='status']").val();
					$('.updateloader').show();
				
					$.ajax({
					url: "userRoles",
					type:'POST',
					
					data: {_token:_token, role:role,status:status},
					success: function(data) {
					//
					if(data.code ==200)
					{
					$('#demo-foo-addrow').html(data.html);
					$("#add-contact").modal('hide');
					$('#insert').show();
					$('#updatedSucess').hide();
					$('#updatedSucess1').hide();
  //setTimeout(function(){
                 
					ajaxDataTableScript();
				//	}, 300);
					
					
                    setTimeout(function(){
                 
					  $('.updateloader').hide();
					}, 400);
					}
					//$('#demo-foo-addrow').DataTable().reload();
					
					}
					
					});


					}); 

				});






			function modalFunc(id)
			{

				$.ajax({
				url: "{{url('editrole')}}",
				type:'get',
               
				data : {id:id},
				success: function(data) {

				$("#add-contact1").modal();
				$("#add-contact1").html(data.html);
				}
				});
				}


							
			function editFunc(role,id)
			{
				$("#demo-foo-addrow").dataTable().fnDestroy();

				$.ajax({
				url: "{{url('editroledata')}}",
				type:'get',
				data : {id:id,role:role},
				beforeSend:function(){
				$('.loader').show();
				},
				success: function(data) {
				$('.loader').hide();
				if(data.code ==200)
				{
				$('#demo-foo-addrow').html(data.html);
				ajaxDataTableScript();
				$('#updatedSucess').show();
				$("#add-contact1").modal('hide');
				$('#updatedSucess1').hide();
				$('#insert').hide();
				}else{
				alert(data.message);
				}
				}
				});
			}
			
			function deleteFunc(id)
			{$("#demo-foo-addrow").dataTable().fnDestroy();
				var r = confirm("Are you sure you want to delete");
				if(r == true)
				{
				$.ajax({
				url: "deleterole/"+id,
				type:'get',
				data : {id:id},
				beforeSend: function(data){
$('.updateloader').show();

				},
				success: function(data) {
				if(data==1)
				{
				$('#row_'+id).hide();
				$('#updatedSucess1').show();
				ajaxDataTableScript();
				$('#updatedSucess').hide();
				$('#insert').hide();

setTimeout(function(){
					  $('.updateloader').hide();
					}, 100);
				}
				else{
				alert("Not Deleted");
				}

				}
				});
				}

				else
				{
				window.location="userRoles";           
				}

			}


</script>
@endsection

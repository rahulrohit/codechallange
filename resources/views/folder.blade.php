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
                    <a href="{{('folder')}}" class="btn btn-info btn-outline waves-effect waves-light"><i class="fa fa-plus"></i> Add Folder</a>
					 <a href="{{('files')}}" class="btn btn-info btn-outline waves-effect waves-light"><i class="fa fa-plus"></i> Add Files</a>

                </ol>
            </div>
            <!-- /.col-lg-12 -->
            </div>

            <div class="row">
            <div class="col-md-12">
            <div class="white-box">
            <h3 class="box-title">Folder List </h3>
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
								
                               
                                <th class="nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $i=1; ?>
						@foreach($data['users'] as $key => $user)
				
                            <tr class="footable-even" style="display: table-row;" id="row_{{ $user->id }}">
                                <td><span class="footable-toggle"></span><?php echo $i++;?></td>
                                <td>
                                    <a href="viewfolder/{{ $user->id }}"> {{ $user->name }}</a>
                                </td>
								
                              
								 <td>
								
								 <a href ="{{ route('folder.delete',$user->id) }}" class="deleteProduct btn btn-danger btn-outline btn-circle btn-lg m-r-5" > <i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
	
      @endsection

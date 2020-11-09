@extends('layouts.default')
@section('title', 'Users')
@section('content')
<?php //echo "<pre>";print_r($data['users']); echo "</pre>";die; ?>

<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Folder</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            <!-- <a href="javascript: void(0);" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Buy Admin Now</a> -->
          <!--   <ol class="breadcrumb">
                <li>  <button type="submit" class="btn btn-info btn-outline waves-effect waves-light"><span class="btn-label"><i class="fa fa-paper-plane-o"></i></span> Save Information</button></li>
            </ol> -->
        </div>
        <!-- /.col-lg-12 -->
        </div>

            <div class="row">


            <div class="col-md-12">
                        <div class="white-box">
        
              <h3 class="box-title">Add Folder  </h3>
                
            <div class="box-body">
                   <form action="{{ action('FolderController@store') }}" method="post" enctype="multipart/form-data" id="leadForm">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                
                                <div class="row">
                                    <div class="col-sm-12 m-b-20">
                                        <label>Folder</label>
                                        <input type="text" class="form-control" name="folder" placeholder="Folder Name"> 
                                    </div>
                                    
                                </div>

                                
    <button type="submit" class="btn btn-info btn-outline waves-effect waves-light"><span class="btn-label"><i class="fa fa-paper-plane-o"></i></span> Save</button>
                            <div class="clearfix"></div>
                        
                  
					
					
                    </form>
					
                </div>
            </div>
            </div>
</div>
			
@endsection
			
@section('script')

<link rel="stylesheet" href="{{url('public/assets/admin/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css')}}" />
<link rel="stylesheet" href="{{url('public/assets/admin/plugins/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}" />
<script src="{{url('public/assets/admin/plugins/bower_components/bootstrap-datetimepicker/moment-with-locales.js')}}"></script>
<script src="{{url('public/assets/admin/plugins/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{url('public/assets/admin/js/jquery.validate.js')}}"></script>
<script>

function sendData(){
        var folder = $("#folder").val();
    }
        $('#leadForm').validate({
            rules :{
						
						folder: { required: true}, 				
            },
            messages :{

						
						folder : 'Enter folder name',
            },
			
            submitHandler: function(form) {
                form.sendData();
            }

        });

   

    </script>
			
@endsection

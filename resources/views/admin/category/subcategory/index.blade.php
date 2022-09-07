@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SubCategory</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    @if (Session::get('message'))
                         $notification = array('messege' => 'SubCategory Deleted!', 'alert-type' => 'success');
                    @endif
                    <ol class="breadcrumb float-sm-right">
                     <button class="btn btn-primary" data-toggle="modal" data-target="#NewSubCategoryModal">+ Add New</button>
                    </ol>
                </div>
                </div>
            </div>
        </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            All Categories List Here
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table  class="table table-bordered table-striped table-sm" id="SubCategoryList">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th> SubCategory Name</th>
                                        <th> SubCategory Slug</th>
                                        <th> Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </div> 
            </div>
        </div>
    </section> 
    
    <!-- subcategory insert modal -->
    <div class="modal fade" id="NewSubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New SubCategory</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('subcategory.store')}}" method="POST" id="NewSubCategoryForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{$row->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name">SubCategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" required>
                        <small id="emailHelp" class="form-text text-muted">This is your sub category.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" id="SubmitBtn" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    

    <!-- subcategory Edit modal -->

    <div class="modal fade" id="EditSubCategoryModal" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('sucategory.update')}}" method="Post" enctype="multipart/form-data" id="EditSubCategoryForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{$row->id}}" id="IDEdit">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subcategory_name">SubCategory Name</label>
                        <input type="text" class="form-control" id="EditSubCategoryName"  name="subcategory_name" required>
                        <small id="emailHelp" class="form-text text-muted">This is your subcategory.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" id="UpdateBtn" class="btn btn-primary">Update</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $.noConflict();
        var SubCategoryList = $('#SubCategoryList').DataTable({
            serverSide:true,
            processing:true,
            colReorder:true,
            ajax:{
                url:"{{ route('subcategory.index') }}",
                type:'GET',
            },
            columns:[
                {data:'category_id'},
                {data:'subcategory_name'},
                {data:'subcat_slug'},
                {data:'category_name'},
                {data:'action',name:'action'}
            ]
        });

        $('#SubmitBtn').on('click',function(e){
            e.preventDefault()
            $.ajax({
                type:"POST",
                url:"{{route('subcategory.store')}}",
                data:$('#NewSubCategoryForm').serializeArray(),
                success: function(data){
            
                    $('#NewSubCategoryForm')[0].reset();
                    $('#NewSubCategoryModal').modal('hide');
                    SubCategoryList.draw(false);
                },
                error:function(data){
                    console.log('Error While adding new Subcategory' + data);
                }
            })
            
        });

        $('body').on('click','#DeleteBtn',function(e){
            e.preventDefault();
            var ID = $(this).data('id');
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type:'GET',
                    url:"/subcategory/delete/"+ID,
                    success:function(data){
                        SubCategoryList.draw(false);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    },
                    error:function(data){
                        Swal.fire(
                            'Error!',
                            'Delete failed !',
                            'error'
                        );
                        console.log(data);
                    },
                });
    
                
            }
            });
            
        });

        $('body').on('click','#EditBtn',function(e){
            e.preventDefault();
            var ID = $(this).data('id');

            {{--  console.log(ID);  --}}
            $.ajax({
                type: "GET",
                url: "/subcategory/edit/"+ID,
                success: function (data) {
                    $('#EditSubCategoryForm')[0].reset();
                    $('#EditSubCategoryName').val(data['subcategory_name']);
                    $('#EditSubCategoryModal').modal('show');
                },
                error: function(data) {
                    console.log(data);
                },
            });
            
            
        });
        $('#UpdateBtn').on('click',function(e){
            e.preventDefault();
            var ID = $('#IDEdit').val();
            {{-- console.log(ID); --}}
             $.ajax({
            type: "POST",
            url: "/subcategory/update/"+ID,
            data: $('#EditSubCategoryForm').serializeArray(),
            success: function (data) {
                $('#EditSubCategoryForm')[0].reset();
                $('#EditSubCategoryModal').modal('hide');
                Swal.fire(
                    'success',
                    'SubCategory updated successfully',
                    'success'
                );
            },
            error:function(data){
                console.log(data);
            }
        });


            
        });
    });
</script>
@endsection   
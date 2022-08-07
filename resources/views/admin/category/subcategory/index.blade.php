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
                                    {{-- @foreach ($data as $key=>$row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row->subcategory_name }}</td>
                                            <td>{{ $row->subcat_slug }}</td>
                                            <td>{{ $row->category_name}}</td>
                                            <td>
                                                <a href="" class="btn btn-info btn-sm edit" id="EditBtn" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                                                <a href="{{route('subcategory.delete',$row->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach --}}
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
                        <label for="category_name">SubCategory Name</label>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modal_body">

            </div>
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
                {data:'subcat_slug'},
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

    });
</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$('body').on('click','.edit', function(e){
        // $.noConflict();
        e.preventDefault();
		let subcat_id = $(this).data('id');
        // console.log(sub_cat);
        $.get("subcategory/edit/"+subcat_id,function(data){
            $("#modal_body").html(data);
        });
	});
</script> --}}
@endsection   
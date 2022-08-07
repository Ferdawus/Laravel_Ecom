@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Child Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                     <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button>
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
                            All Child Categories List Here
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped table-sm ytable">
                                <thead>
                                    <tr>
                                    <th>Sl</th>
                                    <th>Child_Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Sub_Category Name</th>
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
    
    <!-- category insert modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                        <small id="emailHelp" class="form-text text-muted">This is your main category.</small>
                    </div>

                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <!-- category Edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('category.update')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="e_category_name" name="category_name" required>
                        <input type="hidden" class="form-control" id="e_category_id" name="id">
                        <small id="emailHelp" class="form-text text-muted">This is your main category.</small>
                    </div>

                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function (){
        
        $(function(){
            var table = $('.ytable').DataTable({
                processing:true,
                serveSide:true,
                ajax:"{{ route('childcategory.index') }}",
			    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'childcategory_name'  ,name:'childcategory_name'},
                    {data:'category_name',name:'category_name'},
                    {data:'subcategory_name',name:'subcategory_name'},
                    {
                        data:'action',
                        name:'action',
                        orderable:true,
                        searchable:true
                    },
			    ],
                // ajax:{
                //     url:'/childcategory',
                //     type:'GET'
                // },
               
            });
        });
    });
</script>
@endsection    
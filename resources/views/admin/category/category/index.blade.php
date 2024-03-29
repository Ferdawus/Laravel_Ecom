@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
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
                            All Categories List Here
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                    <th>Sl</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $key=>$row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row->category_name }}</td>
                                            <td>{{ $row->category_slug}}</td>
                                            <td>
                                                <a href="" class="btn btn-info btn-sm " id="EditBtn" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                                                <a href="{{route('category.delete',$row->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    // $.noConflict();
	$('body').on('click','#EditBtn', function(e){
        e.preventDefault();
		let categoyId=$(this).data('id');
        console.log(categoyId);
        $.get("category/edit/"+categoyId,function(data){
            // console.log(data);
            $('#e_category_name').val(data.category_name);
            $('#e_category_id').val(data.id);
        });
	});
</script>
@endsection    
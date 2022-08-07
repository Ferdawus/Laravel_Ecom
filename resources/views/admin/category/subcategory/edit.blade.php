<form action="{{route('subcategory.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
    
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <select name="category_id" class="form-control">
                @foreach ($category as $row)
                    <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_name">SubCategory Name</label>
            <input type="text" class="form-control" name="subcategory_name" value="{{  $data->subcategory_name }}" required>
            <small id="emailHelp" class="form-text text-muted">This is your subcategory.</small>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
    </div>
</form>
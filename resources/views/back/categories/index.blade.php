@extends('back.layouts.app')
@section('title','Categories')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">News Categories</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ settings('name') }}</a></li>
                  <li class="breadcrumb-item active">News Categories</li>
                </ol>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card has-shadow">
              <div class="card-body">
                <h4 class="header-title">News Categories</h4>

                  <button class="btn btn-sm btn-outline-success waves-effect waves-light"
                          data-bs-toggle="modal" data-bs-target="#addCategory">
                    <i class="fas fa-plus"></i> Add new
                  </button>


                <div class="mb-5 mt-5">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Created By</th>
                      <th>Updated By</th>
                      <th>Actions</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->createdBy->name }}</td>
                        <td>{{ $category->updatedBy->name }}</td>
                        <td>
                          <a href="{{ route('category.edit',$category->slug) }}" class="btn btn-primary"> <i class="fas fa-pen"></i> </a>
                          <a href="{{ route('category.delete',$category->slug) }}" class="btn btn-danger"> <i class="fas fa-trash"></i> </a>
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
    </div>
  </div>

  <div class="modal  fade" tabindex="-1" role="dialog" id="addCategory" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mt-0">Add new Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.store') }}" method="post" class="custom-validation">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name"  value="{{ old('name') }}" name="name" class="form-control">
              @error('name')
              <div style="color:red;">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-success waves-effect waves-light" value="Add">
            </div>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


@endsection
@section('script')
  <script>
      $(document).ready(function(){
          $('#addCategory').modal('show');
      });


  </script>
@endsection


@extends('back.layouts.app')
@section('title',$category->name)
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Update News Category</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ settings('name') }}</a></li>
                  <li class="breadcrumb-item active">Update News Category</li>
                </ol>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card has-shadow">
              <div class="card-body">
                <h4 class="header-title">Update News Category</h4>

                <button class="btn btn-sm btn-outline-success waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addCategory">
                  <i class="fas fa-plus"></i> Add new
                </button>


                <div class="mb-5 mt-5 mx-auto">
                  <form action="{{ route('category.update',$category->slug) }}" method="post" class="custom-validation">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" id="name"  value="{{ old('name',$category->name) }}" name="name" class="form-control">
                      @error('name')
                      <div style="color:red;">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <input type="submit" class="btn btn-success waves-effect waves-light" value="Update">
                    </div>
                  </form>
                </div>


              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>


@endsection



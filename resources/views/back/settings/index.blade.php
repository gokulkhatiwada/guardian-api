@extends('back.layouts.app')
@section('title','Site Settings')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Site Settings</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ settings('name') }}</a></li>
                  <li class="breadcrumb-item active">Site Settings</li>
                </ol>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card has-shadow">
              <div class="card-body">
                <h4 class="header-title">Site Settings</h4>

                @if($settings->updated_by)
                  <code>Last updated by: </code>{{ $settings->updatedBy->name }} at
                  {{ $settings->updated_at->toDateTimeString() }}
                @endif
                <div class="mb-5 mt-5">
                  <form action="{{ route('setting.update') }}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" value="{{ old('name',$settings->name) }}" id="name" name="name"
                                 class="form-control @error('name') is-invalid @enderror">
                          @error('name')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="description" class="form-label">Description</label>
                          <input type="text" value="{{ old('description',$settings->description) }}"  id="description"
                                 name="description" class="form-control @error('description') is-invalid @enderror">
                          @error('description')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="metaTitle" class="form-label">Meta Title</label>
                          <input type="text" value="{{ old('metaTitle',$settings->meta_title) }}" id="metaTitle"
                                 name="metaTitle" class="form-control @error('metaTitle') is-invalid @enderror">
                          @error('metaTitle')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="metaDescription" class="form-label">Meta Description</label>
                          <textarea id="metaDescription" name="metaDescription"
                                    class="form-control @error('metaDescription') is-invalid @enderror">
                            {{ old('metaDescription',$settings->meta_description) }}
                          </textarea>
                          @error('metaDescription')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="email" class="form-label">Primary Email</label>
                          <input type="text" value="{{ old('email',$settings->email) }}" id="email"
                                 name="email" class="form-control @error('email') is-invalid @enderror">
                          @error('email')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="contact" class="form-label">Contact</label>
                          <input type="text" value="{{ old('contact',$settings->contact) }}" id="contact" name="contact"
                                 class="form-control @error('contact') is-invalid @enderror">
                          @error('contact')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" id="address" name="address" value="{{ old('address',$settings->address) }}"
                                 class="form-control @error('address') is-invalid @enderror">
                          @error('address')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>


                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                      <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Update" class="btn btn-danger">
                      </div>
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


@extends('back.layouts.app')
@section('title','API Credentials')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">API Credentials</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ settings('name') }}</a></li>
                  <li class="breadcrumb-item active">API Credentials</li>
                </ol>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card has-shadow">
              <div class="card-body">
                <h4 class="header-title">API Credentials</h4>

                @if($credentials->updated_by)
                  <code>Last updated by: </code>{{ $credentials->updatedBy->name }} at
                  {{ $credentials->updated_at->toDateTimeString() }}
                @endif
                <div class="mb-5 mt-5">
                  <form action="{{ route('guardian.api.update') }}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="url" class="form-label">Base URL</label>
                          <input type="text" value="{{ old('url',$credentials->base_url) }}" id="url" name="url"
                                 class="form-control @error('url') is-invalid @enderror">
                          @error('url')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="mb-3">
                          <label for="key" class="form-label">API Key</label>
                          <input type="text" value="{{ old('key',$credentials->api_key) }}"  id="key"
                                 name="key" class="form-control @error('key') is-invalid @enderror">
                          @error('key')
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


@extends('back.layouts.app')
@section('title','Logs')
@section('style')
  <style>
    .file-list {
        height: 200px;
        overflow-y: scroll;
        /*border-bottom: 1px solid;*/
    }
    .directory, .file {
        cursor: pointer;
    }
  </style>
@endsection
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Log Files</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ settings('name') }}</a></li>
                  <li class="breadcrumb-item active">Log Files</li>
                </ol>
              </div>

            </div>
          </div>
        </div>
        <!-- end page title -->



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <h4 class="header-title">Log Files</h4>
                <div class="row mb-5">
                  <div class="col-6">
                    <p class="card-title-desc">

                    </p>
                  </div>
                  <div class="col-6">
                    <a href="#" class="btn btn-success download float-right d-none"><i class="fas fa-download"></i> Download Zip</a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <ul class="list-group">
                      @forelse($directories as $directory)

                        <li class="list-group-item directory" data-url="{{ $directory }}">{{ basename($directory) }}</li>
                      @empty
                        <li class="list-group-item" >No Logs Found</li>
                      @endforelse
                    </ul>
                  </div>
                  <div class="col-8">
                      <div class="file-list">

                      </div>
                  </div>
                </div>

                <div class="row mt-2">
                  <iframe id="fileContent" height="400" width="100%" allowfullscreen frameborder="1">
                    <h3>Select file to preview</h3>
                  </iframe>
                </div>


              </div>
            </div>
          </div> <!-- end col -->
        </div> <!-- end row -->

      </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



  </div>
@endsection
@section('script')
  <script>
    $('.directory').on('click',function(){
        $(this).addClass('bg-light').siblings().removeClass('bg-light');

        var file = $(this).data('url');
        $.ajax({
            url: '{{ route('log.files') }}',
            data: {directory: file},
            beforeSend: function(){
                $('.download').addClass('d-none')
                $('.file-list').html('Requesting File...');
            },
            success:function (response) {
                $('.file-list').text('');

                var html = '<ul class="list-group">';
                response.forEach(function(item){
                    var filename = getFileName(item);
                    html += `<li class="list-group-item file" data-path=${item}>${filename}</li>`
                });
                html += '</ul>'
                $('.file-list').html(html);

                $('.download').removeClass('d-none').attr('href','/dashboard/download-log?path='+file);
            },
            error: function () {
                $('.file-list').html('File request denied');
            }
        });
    });

    $('.file-list').on('click','.file',function(){
        $(this).addClass('bg-light').siblings().removeClass('bg-light');
        var path = $(this).data('path');
        $.ajax({
            url: '{{ route('log.file.content') }}',
            data: {path:path},
            beforeSend: function(){
                $('#fileContent').contents().find('body').html('Requesting File...');
            },
            success:function (response) {
                $('#fileContent').contents().find('body').text('');
                $('#fileContent').contents().find('body').text(unescape(response));
            },
            error: function () {
                $('#fileContent').contents().find('body').html('File request denied');
            }
        })
    })


    function getFileName(path) {
        var parts = path.split('/');
        return parts[parts.length - 1];
    }
  </script>
@endsection
@extends('backend.layouts.master')
@section('title') Edit Drug @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Drug</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('drugs.index') }}">Drug</a></li>
                          <li class="active">Edit Drug</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong>Edit Drug</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('drugs.update',$drug->id)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif


                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$drug->name}}" class="form-control" required>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Brand Name <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="brand_name" placeholder=""  value="{{$drug->brand_name}}" class="form-control" required>
                  @error('brand_name')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Form <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="form" placeholder=""  value="{{$drug->form}}" class="form-control" required>
                @error('form')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Code <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="code" placeholder=""  value="{{$drug->code}}" class="form-control" required>
                @error('code')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="active" {{(($drug->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($drug->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                  </select>
                  @error('status')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <button class="btn btn-success" type="submit">Update</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css">

<style>
  #left-panel {
      background-color: #272c33;
  }

  #left-panel .navbar-default {
      background-color: #272c33;
      border-color: #272c33;
  }
</style>

@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#comment').summernote({
            placeholder: "Write detail Message.....",
            tabsize: 2,
            height: 150
        });
    });
</script>
@endpush
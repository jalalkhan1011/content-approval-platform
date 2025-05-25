@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Tag') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Tag') }}</li>
                </ol>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-4 col-md-4 col-sm-4"> </div>
            <div class="col-xl-4 col-md-4 col-sm-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Tag Edit') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.tags.update', $tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Tag Name') }}<span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $tag->name) }}" id="name"
                                    placeholder="{{ __('Enter Tag Name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('tag.tags.index') }}" class="btn btn-secondary"><i
                                        class="fa fa-arrow-circle-left"></i> {{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary ml-2">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Category') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Category') }}</li>
                </ol>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-2 col-md-2 col-sm-2"> </div>
            <div class="col-xl-8 col-md-8 col-sm-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Categhory Create') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="title" class="form-label">{{ __('Title') }}<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                        id="title" placeholder="{{ __('Enter Post Title') }}" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">{{ __('Description') }}<span
                                            class="text-danger"> *</span></label>
                                    <textarea class="form-control" name="description" id="description"
                                        placeholder="{{ __('Write Post Description here...') }}" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-sl-4 col-md-4 col-sm-4">
                                        <label for="category_id" class="form-label">{{ __('Category') }}<span
                                                class="text-danger"> </span></label>
                                        <select name="category_id[]" id="category_id" class="form-control" multiple>
                                            <option value="" disabled selected>{{ __('Select Category') }}</option>
                                            @foreach ($categories as $key => $category)
                                                <option value="{{ $key }}"
                                                    {{ in_array($key, old('category_id', [])) ? 'selected' : '' }}>
                                                    {{ __(ucfirst($category)) }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sl-8 col-md-8 col-sm-8">
                                        <label for="tag" class="form-label">{{ __('Tag') }}</label>
                                        <input type="text" class="form-control" name="tag"
                                            value="{{ old('tag') }}" placeholder="Tags (comma separated)">
                                        @error('tag')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sl-8 col-md-8 col-sm-8">
                                        <label for="image" class="form-label">{{ __('Image') }}</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            accept="image/*">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('post.posts.index') }}" class="btn btn-secondary"><i
                                        class="fa fa-arrow-circle-left"></i> {{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary ml-2">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

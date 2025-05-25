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
            <div class="col-xl-8 col-md-8 col-sm-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Ctegory List') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#{{ __('Sl') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ __(ucfirst($category->category_name ?: '')) }}</td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('category.categories.edit', $category->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit"><i
                                                                class="fa fa-edit"></i> {{ __('Edit') }}</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form
                                                            action="{{ route('category.categories.destroy', $category->id) }}"
                                                            method="POST" id="deleteButton{{ $category->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="sweetAlertDelete({{ $category->id }})"
                                                                title="Delete"><i class="fa fa-trash">
                                                                    {{ __('Delete') }}</i></button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Categhory Create') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">{{ __('Category Name') }}<span
                                        class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="category_name"
                                    value="{{ old('category_name') }}" id="category_name"
                                    placeholder="{{ __('Enter Category Name') }}" required>
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

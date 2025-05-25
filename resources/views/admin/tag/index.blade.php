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
            <div class="col-xl-8 col-md-8 col-sm-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Tag List') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#{{ __('Sl') }}</th>
                                        <th>{{ __('Tag') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ __(ucfirst($tag->name ?: '')) }}</td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('tag.tags.edit', $tag->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit"><i
                                                                class="fa fa-edit"></i> {{ __('Edit') }}</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form
                                                            action="{{ route('tag.tags.destroy', $tag->id) }}"
                                                            method="POST" id="deleteButton{{ $tag->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="sweetAlertDelete({{ $tag->id }})"
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
                        {{ __('Tag Create') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.tags.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Tag Name') }}<span
                                        class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" id="name"
                                    placeholder="{{ __('Enter Tag Name') }}" required>
                                @error('name')
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

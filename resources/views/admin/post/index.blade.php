@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Post') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Post') }}</li>
                </ol>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6">
                                {{ __('Post List') }}
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 text-right">
                                @if (Auth::user()->role == 'user')
                                    <a href="{{ route('post.posts.create') }}" class="btn btn-sm btn-success"
                                        title="Add Post"><i class="fa fa-plus"></i> {{ __('Add Post') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#{{ __('Sl') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created By') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ __(ucfirst(Str::limit($post->title, 30 ?: ''))) }}</td>
                                            <td>{{ __(ucfirst(Str::limit($post->description, 50 ?: ''))) }}</td>
                                            <td>
                                                {{ __(ucfirst($post->status ?: '')) }}</td>
                                            <td>{{ __($post->user->name ?: '') }}</td>
                                            <td>
                                                <ul class="list-inline">
                                                    @if (Auth::user()->role == 'user')
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('post.posts.edit', $post->id) }}"
                                                                class="btn btn-sm btn-warning" title="Edit"><i
                                                                    class="fa fa-edit"></i> {{ __('Edit') }}</a>
                                                        </li>
                                                    @endif
                                                    @if (Auth::user()->role == 'admin')
                                                        @if (is_null($post->deleted_at))
                                                            @if ($post->status == 'pending')
                                                                <li class="list-inline-item">
                                                                    <form
                                                                        action="{{ route('post.posts.approve', $post->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-success"
                                                                            title="Approve"><i class="fa fa-check">
                                                                                {{ __('Approve') }}</i></button>
                                                                    </form>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <form
                                                                        action="{{ route('post.posts.reject', $post->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                            title="Reject"><i class="fa fa-check">
                                                                                {{ __('Reject') }}</i></button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        @else
                                                            <li class="list-inline-item">
                                                                <form action="{{ route('post.posts.restore', $post->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-info"
                                                                        title="Restore"><i class="fa fa-undo">
                                                                            {{ __('Restore') }}</i></button>
                                                                </form>
                                                        @endif
                                                        <li class="list-inline-item">
                                                            <form action="{{ route('post.posts.destroy', $post->id) }}"
                                                                method="POST" id="deletePostButton{{ $post->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="sweetAlertPostDelete({{ $post->id }})"
                                                                    title="Delete"><i class="fa fa-trash">
                                                                        {{ __('Delete') }}</i></button>
                                                            </form>
                                                        </li>
                                                    @endif
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
        </div>
    </div>
@endsection

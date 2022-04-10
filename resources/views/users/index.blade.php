@extends('layouts.master', ['usersLink' => 'active'])

@section('title') Users ({{ $users->total() }}) @stop

@section('meta')
    <meta name="title" content="" />
    <meta name="description" content="" />
@stop

@push('style')
    <link rel="stylesheet" href="{{ mix('/css/app-stack.css') }}" />
@endpush

@section('content')
    <div class="container">
        <div class="content">
            <div class="text-end">
                <a href="{{ route('users.create') }}" class="btn btn-secondary">Create new user <span class="oi oi-person"></span></a>
            </div>
            <h1>Users ({{ $users->total() }})</h1>
            <div class="table-responsive mt-1">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Created at</th>
                            <th>Verified at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->email_verified_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger" onclick="deleteEntity('{{ route('users.destroy', $user->id) }}', event, 'Delete user {{ $user->email }} ?')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-box">
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ mix('/js/app-stack.js') }}"></script>
@endpush

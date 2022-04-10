@extends('layouts.master', ['usersLink' => 'active'])

@section('title') Edit user {{ $user->email }} @stop

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
            <a href="{{ route('users.index') }}">< Back to user list</a>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label>Name *</label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" required />
                                    {!! $errors->first('name', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>E-mail *</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" required />
                                    </div>
                                    {!! $errors->first('email', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                * required fields

                <div class="box-footer border-top pt-2 d-block mb-4">
                    <button type="submit" class="btn btn-primary btn-flat" name="button" value="index">
                        <i class="fa fa-angle-left"></i>
                        < Update and back
                    </button>
                    <button type="submit" class="btn btn-primary btn-flat">Update</button>
                    <button class="btn btn-secondary btn-flat" name="button" type="reset">Reset</button>
                    <a class="btn btn-danger float-right btn-flat" href="{{ route('users.index') }}"><i class="fa fa-times"></i> Close</a>
                </div>
            </form>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ mix('/js/app-stack.js') }}"></script>
@endpush

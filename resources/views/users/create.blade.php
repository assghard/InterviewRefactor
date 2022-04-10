@extends('layouts.master', ['usersLink' => 'active'])

@section('title') Create new user @stop

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
            <form action="{{ route('users.store') }}" method="POST" autocomplete="false">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label>Name *</label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required />
                                    {!! $errors->first('name', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>E-mail *</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required />
                                    </div>
                                    {!! $errors->first('email', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label>Password *</label>
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" value="" required autocomplete="new-password" />
                                    {!! $errors->first('password', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label>Password confirmation *</label>
                                    <input id="password_confirmation" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" value="" required />
                                    {!! $errors->first('password_confirmation', '<span class="invalid-feedback d-block"><b>:message</b></span>') !!}
                                </div>
                            </div>
                        </div>
                        <ul>
                            <li>At least: one Uppercase letter, one Lower case letter, one numeric value, one special character, must be more than 8 characters long</li>
                            <li>Password example: P@s$word12345!</li>
                        </ul>
                    </div>
                </div>

                * required fields

                <div class="box-footer border-top pt-2 d-block mb-4">
                    <button type="submit" class="btn btn-primary btn-flat">Submit</button>
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

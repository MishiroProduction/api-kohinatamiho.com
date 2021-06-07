@extends('layouts.base', ['activePage' => 'AdminUser'])

@section('content-header')
<div>
    <h3>
        <span class="oi oi-person"></span>
        管理ユーザー作成
    </h3>
    <div class="text-right">
        <a href="{{ route('admin_users.index') }}" class="btn btn-round btn-info">
            <span class="oi oi-chevron-left"></span>
            管理ユーザー一覧に戻る
        </a>
    </div>
</div>
@endsection

@section('content')
{{ Form::open(['url' => route('admin_users.store'), 'method' => 'post']) }}
    <div class="form-group info">
        <label for="InputUserId">User ID</label>
        {{ Form::text('user_id', old('user_id'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => true]) }}
    </div>
    <div class="form-group">
        <label for="InputPassword">Password</label>
        {{ Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => '8 characters or more', 'required' => true]) }}
    </div>
    <div class="form-group">
        <label for="InputPasswordConfirm">Password Confirm</label>
        {{ Form::password('password_confirm', ['class' => 'form-control input-sm', 'placeholder' => '', 'required' => true]) }}
    </div>
    <div class="form-group">
        <label for="TextareaUserName">Uesr Name</label>
        {{ Form::text('name', old('name'), ['class' => 'form-control input-sm', 'required' => true]) }}
    </div>
    <div class="form-group">
        <label for="InputRole">Role</label>
        {{ Form::select('role', \App\Models\AdminUser::roles(), old('body'), ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link', 'required' => true]) }}
    </div>
    <div class="form-group">
        <label for="InputState">State</label>
        {{ Form::select('status', \App\Models\AdminUser::statuses(), old('body'), ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link', 'required' => true]) }}
    </div>
    <button type="submit" class="btn btn-round btn-info">Submit</button>
{{ Form::close() }}
@endsection

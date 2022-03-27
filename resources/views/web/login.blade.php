@extends('layouts.master')

@section('title') Đăng nhập @endsection

@section('content')
    <h2 class="title">ĐĂNG NHẬP</h2>
    <form action="{{ route('web.post-login') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Mật khẩu:</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-success">Đăng nhập</button>
                <a href="{{ route('web.register') }}" class="btn btn-primary d-inline-block ml-3">Đăng ký</a>
            </div>  
        </div>
    </form>
@endsection

@push('js')
@endpush

@push('css')
@endpush
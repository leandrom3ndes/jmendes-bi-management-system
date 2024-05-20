@extends('layouts.default')
@section('header')
    <style>
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 32px;
            margin-bottom: 40px;
        }
    </style>
@stop
@section('page_name')
    Erro
@stop
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">404!!!! <br>
                The page you are looking for was not found.</div>
        </div>
    </div>
@stop
@section('footerContent')

@stop

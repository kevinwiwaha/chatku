@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <chat-list-comp />

        </div>
        <div class="col-md-6">
            <online-user-comp />
        </div>
    </div>
    <div class="row">
        <chat-box-comp />
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title',__('Cwners'))
@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <livewire:dashboard.customers.update :owner='$owner' />
    </div>
</div>

@endsection
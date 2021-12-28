@extends('layouts.admin')

@section('title',__('Owners'))
@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        @livewire('dashboard.owners.store')
    </div>
</div>

@endsection

@extends('test.master')

@section('title', 'Votaciones')
@section('vue-control', 'pollsManagement')

@section('main.content')
    <div class="page-title">
        <div class="title_left">
        <h3>Votaciones <small>Panel de Control</small></h3>
        </div>

        <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
            </div>
        </div>
        </div>
    </div>

    <votations-table ref="pollsTable"></votations-table>    

    <poll-form-wizard v-on:poll-created="notifyComp"></poll-form-wizard>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/votations.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/votations.js') }}"></script>
    <script src="{{ asset('js/votationsVue.js') }}"></script>

    <script type="text/javascript">
        
    </script>
@endpush
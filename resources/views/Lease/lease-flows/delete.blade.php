@extends('layouts.master')
@section('content')

    {!!Form::open(['method' => 'delete','route'=>['lease-flows.destroy',$leaseFlow->id],'id'=>'dealflow-delete-form','class'=>'form-horizontal form-label-left']) !!}

    <section class=" mb-4 pb-3 alert black-text primary-background ">

        <div class="jumbotron mt-4 mb-0">
            <h2 class="h1-responsive"></h2>
            <p class="lead">@lang('master.Are you sure you want to delete this?')</p>
            <hr class="my-2">
            <p>@lang('master.Delete') {!! $leaseFlow->id !!}
            </p>
            <a href="{!! url()->previous() !!}" class="btn primary-background text-white btn-lg waves-effect waves-light" role="button"><i
                        class="fas fa-arrow-left"></i> @lang('master.Back')</a>
            <button type="submit" value="Delete" name="Delete" id="register_submit" class="btn btn-danger white-text btn-lg waves-effect waves-light" role="button"><i class="fas fa-trash"></i> @lang('master.Delete')</button>
        </div>

    </section>
    {{ Form::close() }}

@stop
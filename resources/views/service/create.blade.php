@extends('layouts.admin.admin')

@section('title', 'Create a Service')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                @include('service.partials.form',['header' => 'Create a service'])
            </form>
        </div>
    </section>
@endsection


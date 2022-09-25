@extends('layouts.admin.admin')

@section('title', 'Create a Service Category')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('service-category.store')}}" method="POST" enctype="multipart/form-data">
                @include('servicecategory.partials.form',['header' => 'Create a Service Category'])
            </form>
        </div>
    </section>
@endsection


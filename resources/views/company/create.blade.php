@extends('layouts.admin.admin')

@section('title', 'Create a Company')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                @include('company.partials.form',['header' => 'Create a service'])
            </form>
        </div>
    </section>
@endsection


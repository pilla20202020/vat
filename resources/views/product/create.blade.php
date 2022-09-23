@extends('layouts.admin.admin')

@section('title', 'Create a Product')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @include('product.partials.form',['header' => 'Create a Product'])
            </form>
        </div>
    </section>
@endsection


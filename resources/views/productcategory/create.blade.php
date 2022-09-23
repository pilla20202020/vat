@extends('layouts.admin.admin')

@section('title', 'Create a Product Category')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('product-category.store')}}" method="POST" enctype="multipart/form-data">
                @include('productcategory.partials.form',['header' => 'Create a Product Category'])
            </form>
        </div>
    </section>
@endsection


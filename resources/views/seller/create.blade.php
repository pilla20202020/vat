@extends('layouts.admin.admin')

@section('title', 'Create a Seller')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('seller.store')}}" method="POST" enctype="multipart/form-data">
                @include('seller.partials.form',['header' => 'Create a Seller'])
            </form>
        </div>
    </section>
@endsection


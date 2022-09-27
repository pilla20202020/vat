@extends('layouts.admin.admin')

@section('title', 'Create a Customer')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                @include('customer.partials.form',['header' => 'Create a Customer'])
            </form>
        </div>
    </section>
@endsection


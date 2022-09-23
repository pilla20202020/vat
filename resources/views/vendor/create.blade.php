@extends('layouts.admin.admin')

@section('title', 'Create a vendor')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('vendors.store')}}" method="POST" enctype="multipart/form-data">
                @include('vendor.partials.form',['header' => 'Create a vendor'])
            </form>
        </div>
    </section>
@endsection


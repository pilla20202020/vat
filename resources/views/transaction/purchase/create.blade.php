@extends('layouts.admin.admin')

@section('title', 'Create a Purchase Order')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                @include('transaction.purchase.partials.form',['header' => 'Create a Purchase Order'])
            </form>
        </div>
    </section>
@endsection


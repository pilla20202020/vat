@extends('layouts.admin.admin')

@section('title', 'Create a Job Order')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('joborder.store') }}" method="POST" enctype="multipart/form-data">
                @include('transaction.joborder.partials.form',['header' => 'Create a Job Order'])
            </form>
        </div>
    </section>
@endsection


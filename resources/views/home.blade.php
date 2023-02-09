@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <div class="row mb-3">
                           <a href="{{ route('books') }}">Add Books</a>
                    </div>
                    <div class="row mb-3">
                        <a href="{{ route('setbooks') }}">Get Books From API </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

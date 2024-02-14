// Example Blade view (e.g., resources/views/people.blade.php)
@extends('layouts.app')

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection

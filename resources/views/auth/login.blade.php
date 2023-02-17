@extends('layouts.app')

@section('content')
<div class="container">
    <login-component token="{{ csrf_token() }}"></login-component>
</div>
@endsection

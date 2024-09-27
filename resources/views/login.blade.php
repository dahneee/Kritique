@extends('layout')
@section('title', 'login')
@section('content')
<div class='container d-flex justify-content-center align-items-center' style="height: 100vh; width:100vw; background-color: beige; ">

    <form class="mt-5" style="width: 500px;">
        <div class="mb-3">
        <h1 class="d-flex justify-content-center align-items-center">Kritique</h1>
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-dark">Submit</button>
    </form>
</div>
@endsection

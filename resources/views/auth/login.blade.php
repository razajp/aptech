@extends('layouts.app')
@section('title', 'Login | Aptech')
@section('content')
    <div class="bg-[--secondary-bg-color] p-10 rounded-xl shadow-lg max-w-md w-full fade-in mx-auto">
        <h1 class="text-3xl font-bold text-center mb-2 text-[--primary-color]">Login</h1>

        <form id="login-form" method="POST" action="{{ route('loginPost') }}" class="space-y-4">
            @csrf
            <!-- User Name -->
            <x-input 
                label="Email" 
                name="email" 
                id="email" 
                placeholder="Confirm your user name" 
                required 
            />

            <x-input 
                label="Password" 
                name="password" 
                id="password" 
                type="password" 
                placeholder="Enter your password" 
                required 
            />

            <!-- login Button -->
            <button type="submit" class="bg-gray-200 px-5 py-2 rounded-lg hover:bg-gray-300 transition-all duration-300 ease-in-out font-medium">Login</button>
        </form>
    </div>
@endsection
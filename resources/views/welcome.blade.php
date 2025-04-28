@extends('layouts.app')
@section('title', 'Welcom | Aptech')
@section('content')
    <div class="flex flex-col items-start space-y-3">
        <h1>welcom to aptech</h1>
        <a href="/fetchLogs" class="bg-blue-400 text-gray-100 font-medium px-6 py-2.5 rounded-lg border border-transparent transition-all 0.3s ease-in-out hover:bg-blue-500">Fetch Data From Device</a>
    </div>
@endsection
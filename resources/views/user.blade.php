@extends('layouts.app')

@section('content')
    <div class="flex bg-gray-100 border-b border-gray-300 py-4">
        <div class="container mx-auto flex justify-between">
          <div class="flex">
          </div>
          <div class="flex">
            <a href="/logout">Logout</a>
          </div>
        </div>

    </div>
    <div class="container mx-auto py-2">
      <router-view></router-view>
    </div>
@endsection

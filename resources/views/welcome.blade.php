@extends('layouts.app')

@section('content')
    <div class="flex bg-gray-100 border-b border-gray-300 py-4">
        <div class="container mx-auto flex justify-between"  v-if="!user">
          <div class="flex" v-if="user">
            <router-link class="mr-4" to="/login">Login</router-link>
            <router-link to="/register">Registration</router-link>
          </div>
        </div>
        <div class="container mx-auto flex justify-between" v-else>
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

<script>

</script>

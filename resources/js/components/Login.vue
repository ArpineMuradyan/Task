<template>
  <div class="flex flex-wrap w-full justify-center items-center pt-32">
    <div class="flex flex-wrap max-w-xl">
      <div class="p-2 text-2xl text-grey-800 font-semibold">
        <h1>
          Login to your account
        </h1>
      </div>
      <div class="p-2 w-full">
        <label for="email">Email</label>
        <input class="w-full bg-gray-100 rounded focus:outline-none
        focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="email"
        :class="errors.email ? 'border-red-400' : 'border-gray-400'"
        style="border-width: 1px;" v-model="form.email">
        <span class="w-full text-red-500" v-if="errors.email">{{errors.email[0]}}</span>
      </div>
      <div class="p-2 w-full">
        <label for="password">Password</label>
        <input class="w-full bg-gray-100 rounded focus:outline-none
        focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password"
        :class="errors.password ? 'border-red-400' : 'border-gray-400'"
        style="border-width: 1px;" v-model="form.password" name="password">
        <span class="w-full text-red-500" v-if="errors.password">{{errors.password[0]}}</span>
      </div>
      <div class="p-2 w-full mt-4">
        <button @click.prevent="loginUser" type="submit" class="flex text-white bg-indigo-500
        border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        email: '',
        password: ''
      },
      errors: []
    }
  },
  methods: {
    loginUser(){
      axios.post('/api/login', this.form).then(response => {
      console.log(response.data.success)
      if(response.data.success){
        this.$router.push({name: "Dashboard"})
      } else {
        this.errors = response.data.errors;
      }
      }).catch((error) => {
        this.errors = error.response.data.errors;
      })
    }
  }

}
</script>

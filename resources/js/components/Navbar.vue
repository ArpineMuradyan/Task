<template>
<div class="flex bg-gray-100 border-b border-gray-300 py-4">
    <div class="container mx-auto flex justify-between" v-if="!auth">
      <div class="flex">
        <router-link class="mr-4" to="/login" exact>Login</router-link>
        <router-link to="/register">Registration</router-link>
      </div>
    </div>
    <div class="container mx-auto flex justify-between" v-else>
      <div class="flex">
      </div>
      <div class="flex">
        <button @click.prevent="logout">Logout</button>
      </div>
    </div>

</div>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      auth: false
    }
  },
  watch:{
    $route (to, from){
      axios.get('/api/authenticated').then(response=>{
       if(response.data.auth){
          this.auth = true
       } else {
          this.auth = false
       }

      }).catch(()=>{
        this.auth = false
      })
    }
  },
  methods: {
    logout(){
      axios.post('/api/logout').then(() => {
        this.$router.push({name: "Login"})
        this.auth = false
      })
    }
  }
}
</script>

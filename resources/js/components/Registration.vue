<template>
  <div class="flex flex-wrap w-full justify-center items-center pt-32">
    <div class="flex flex-wrap max-w-xl">
      <div class="p-2 text-2xl text-gray-800 font-semibold">
        <h1>
          Register an account
        </h1>
      </div>
      <div class="p-2 w-full">
        <label class="w-full" for="name">Name</label>
        <input :class="errors.name ? 'border-red-400' : 'border-gray-400'"
        class="w-full bg-gray-100 rounded  focus:outline-none
        focus:border-indigo-500 text-base px-4 py-2" placeholder="Name" type="text"
        style="border-width: 1px;" v-model="form.name">
        <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
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
      <div class="p-2 w-full">
        <label for="confirm_password">Confirm Password</label>
        <input class="w-full bg-gray-100 rounded border-gray-400 focus:outline-none
        focus:border-indigo-500 text-base px-4 py-2" placeholder="Confirm Password"
        :class="errors.password ? 'border-red-400' : 'border-gray-400'" name="password_confirmation"

        style="border-width: 1px;" type="password" v-model="form.password_confirmation">
        <span class="w-full text-red-500" v-if="errors.password">{{errors.password[0]}}</span>
      </div>
      <div class="p-2 w-full mt-4">
        <button @click.prevent="saveForm" type="submit" class="flex text-white bg-indigo-500
        border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
          Register
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return{
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: []
    }
  },
  methods:{
    emailChange(){
      var emailValidate = /^[A-Za-z]+(\.|_|-)?([A-Za-z0-9]+(\.|_|-)?)+?([A-Za-z0-9]+(\.|_|-)?)+?[A-Za-z0-9]@[A-Za-z]+(\.|_)?([A-Za-z0-9]+(\.|_|-)?)+?\.[a-z]{2,4}$/;
      if (this.form.email.trim() == "") {
        this.errors.email = ['The email field is required.']
      } else if (this.form.email.length > 50 || emailValidate.test(this.form.email) == false) {
          this.errors.email = ['The email must be a valid email address.']
      } else {
          this.errors.email = ''
      }
    },
    nameChange(){
      if (this.form.name.trim() == "") {
        this.errors.name = ['The name field is required.']
      } else {
          this.errors.name = ''
      }
    },
    passwordChange(){
      if (this.form.password.trim() == "") {
        this.errors.password = ['The password field is required.']
      } else if (this.form.password.length<6 && this.form.password.length>0) {
        this.errors.password = ['The password must be at least 6 characters.']
      } else {
          this.errors.password = ''
      }
    },
    passwordConfirmChange(){
      if (this.form.password.trim() != this.form.password_confirmation.trim()) {
        this.errors.password = ['The password confirmation does not match.']
      } else {
        this.errors.password = ''
      }
    },
    saveForm(){
        axios.post('/api/register', this.form).then(response => {
            if(response.data.success){
              this.$router.push({name: "Login"})
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

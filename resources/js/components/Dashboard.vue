<template>
  <div>
    <div class="users">
        <div class="mx-8 border-b-2 border-gray-600 text-2xl text-gray-800">
          Users
        </div>
        <div class="m-8">
          <table class="table-fixed border-collapse border border-gray-800">
              <thead>
                <tr>
                  <th class="w-1/5 p-1 border border-gray-600">#</th>
                  <th class="w-2/5 p-1 border border-gray-600">Name</th>
                  <th class="w-2/5 p-1 border border-gray-600">Email</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users.user">
                  <td class="p-1 border border-gray-600">{{user.id}}</td>
                  <td class="p-1 border border-gray-600">{{user.name}}</td>
                  <td class="p-1 border border-gray-600">{{user.email}}</td>
                </tr>
              </tbody>
          </table>
        </div>
    </div>
    <div class="addBoard">
      <div class="mx-8 border-b-2 border-gray-600 text-2xl text-gray-800">
        Board
      </div>
      <div class="flex items-center justify-center m-8 my-auto">
          <button class="mt-8 bg-indigo-500 px-4 p-3 text-white rounded-lg" @click="openModal">Add New Board</button>
      </div>
      <!--Modal-->
      <div class="modal modal-open fixed w-full h-full top-0 left-0 flex items-center justify-center"
      :class="popupMode ? 'z-0' : 'opacity-0 pointer-events-none -z-10'">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">


          <!-- Add margin if you want to see some of the overlay behind the modal-->
          <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
              <p class="text-2xl font-bold">Add New Board</p>
              <div class="modal-close cursor-pointer z-50">
                <svg  @click="closeModal()" class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
              </div>
            </div>

            <!--Body-->
            <div class="p-2 w-full">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                User name
              </label>
              <div class="relative">
                <select v-model="form.user" class="block appearance-none w-full bg-gray-100 text-gray-700
                  py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  :class="errors.user ? 'border-red-400' : 'border-gray-400'" style="border-width: 1px;">
                  <option v-for="user in usersSelect.user" v-bind:value="user.id">{{user.name}}</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
                <span class="w-full text-red-500" v-if="errors.user">{{errors.user[0]}}</span>
              </div>
            </div>
            <div class="p-2 w-full">
              <label class="w-full" for="description">Description</label>
              <textarea class="w-full bg-gray-100 rounded focus:outline-none
              focus:border-indigo-500 text-base px-4 py-2"
              :class="errors.description ? 'border-red-400' : 'border-gray-400'"
              v-model="form.description"  style="border-width: 1px;"></textarea>
              <span class="w-full text-red-500" v-if="errors.description">{{errors.description[0]}}</span>
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2">
              <button @click="save" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Save</button>
              <button @click="closeModal" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="myTasks">
      <div class="mx-8 border-b-2 border-gray-600 text-2xl text-gray-800">
        My Tasks
      </div>
      <div class="m-8">
        <table class="table-fixed border-collapse border border-gray-800">
            <thead>
              <tr>
                <th class="w-1/5 p-1 border border-gray-600">#</th>
                <th class="w-2/5 p-1 border border-gray-600">Description</th>
                <th class="w-2/5 p-1 border border-gray-600">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in tasks.tasks">
                <td class="p-1 border border-gray-600">{{task.id}}</td>
                <td class="p-1 border border-gray-600">{{task.description}}</td>
                <td class="p-1 border border-gray-600">
                <button @click="changeStatus(task.id, 1)" class="px-2 bg-transparent p-1 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">OK</button>
                <button @click="changeStatus(task.id, 0)" class="px-2 bg-indigo-500 p-1 rounded-lg text-white hover:bg-indigo-400">X</button>
                </td>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
    <div class="inProgress">
      <div class="mx-8 border-b-2 border-gray-600 text-2xl text-gray-800">
        In progress
      </div>
      <div class="m-8">
        <table class="table-fixed border-collapse border border-gray-800">
            <thead>
              <tr>
                <th class="w-1/5 p-1 border border-gray-600">#</th>
                <th class="w-2/5 p-1 border border-gray-600">Description</th>
                <th class="w-2/5 p-1 border border-gray-600">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in tasks.tasks">
                <td class="p-1 border border-gray-600">{{task.id}}</td>
                <td class="p-1 border border-gray-600">{{task.description}}</td>
                <td v-if="task.status==1" class="p-1 border border-gray-600">

                  <button class="px-2 bg-transparent p-1 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">OK</button>
                </td>
                <td v-else class="p-1 border border-gray-600">
                  <button class="px-2 bg-indigo-500 p-1 rounded-lg text-white hover:bg-indigo-400">X</button>
                </td>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        users: [],
        form: {
          user: '',
          description: '',
        },
        errors: [],
        usersSelect: [],
        popupMode: false,
        tasks: [],
        changeStatusInfo: {
          id: '',
          status: ''
        }
      }
    },
    methods: {
      closeModal(){
        this.popupMode=false
        this.form.user = ''
        this.form.description = ''
        this.errors = []
      },
      openModal(){
        this.popupMode=true
      },
      save(){
        axios.post('/api/saveTask', this.form).then(response => {
          if(response.data.success){
            this.popupMode=false
            this.tasks = response.data
          } else {
            this.errors = error.response.data.errors;
          }
        }).catch((error) => {
          this.errors = error.response.data.errors;
        })
      },
      changeStatus(id, status){
        this.changeStatusInfo.id = id
        this.changeStatusInfo.status = status
        axios.post('/api/changeStatus', this.changeStatusInfo).then(response => {
          this.tasks = response.data
        }).catch((error) => {
          this.errors = error.response.data.errors;
        })
      }
    },
    mounted(){
      axios.get('/api/getUsersInfo').then((res)=>{
        this.users = res.data
      }),
      axios.get('/api/getUsers').then((res)=>{
        this.usersSelect = res.data
      }),
      axios.get('/api/getTask').then((res)=>{
        this.tasks = res.data
      })
    },
  }
</script>

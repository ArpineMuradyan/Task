import Login from './components/Login';
import Registration from './components/Registration';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';

export default{
  mode: 'history',
  linkActiveClass: 'font-semibold',
  routes: [
    {
      path: '/',
      component: Login,
      beforeEnter: (to, from, next) => {
        axios.get('/api/authenticated').then(response=>{
          if(response.data.auth){
             return next({name: 'Dashboard'})
          } else {
             next()
          }
        }).catch(()=>{
          next()
        })
      }
    },
    {
      path: '/login',
      component: Login,
      name: 'Login',
      beforeEnter: (to, from, next) => {
        axios.get('/api/authenticated').then(response=>{
          if(response.data.auth){
             return next({name: 'Dashboard'})
          } else {
             next()
          }
        })
      }
    },
    {
      path: '/register',
      component: Registration,
      beforeEnter: (to, from, next) => {
        axios.get('/api/authenticated').then(response=>{
          if(response.data.auth){
             return next({name: 'Dashboard'})
          } else {
             next()
          }
        })
      }
    },
    {
      path: '/dashboard',
      component: Dashboard,
      name: 'Dashboard',
      beforeEnter: (to, from, next) => {
        axios.get('/api/authenticated').then(response=>{
          console.log(response.data.auth)
          if(response.data.auth){
             next()
          } else {
             return next({name: 'Login'})
          }
        })
      }
    },
    {
      path: '*',
      component: NotFound
    }
  ]
}

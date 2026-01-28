# Vue 3 + Vite

This template should help get you started developing with Vue 3 in Vite. The template uses Vue 3 `<script setup>` SFCs, check out the [script setup docs](https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup) to learn more.

Learn more about IDE Support for Vue in the [Vue Docs Scaling up Guide](https://vuejs.org/guide/scaling-up/tooling.html#ide-support).


#to set up view project:
npm create vite>
project name**>
packagename>>
select framework:  vue>>


npm install vue-router
 
const routes = [
    {
  path: '/admin',
  component: AdminLayout,
  children: [
    {
      path: 'dashboard',
      component: Dashboard
    },
    {
      path: 'users',
      component: Users
    }
  ]
},
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/about',
    name: 'about',
    component: About
  }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

createApp(App).use(router).mount('#app')

<router-view />


<router-link to="/about">About</router-link>
const route = useRoute()
console.log(route.params.id)


const router = useRouter()
router.push('/about')
router.push({ name: 'student', params: { id: 10 } })

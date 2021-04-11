import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home'
import Note from '../views/Note'

const routes = [

    {
        path: '/', 
        name: 'Home',
        component: Home,
    },

    {
      path: '/notes/:id', 
      name: 'Note',
      component: Note
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;
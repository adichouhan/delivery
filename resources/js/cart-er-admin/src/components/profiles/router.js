import profileList from './components/list'
import profilesCreate from './components/create'

const profileRouter = [
    {
        path: '/profiles',
        name: 'profiles',
        component: profileList,
        meta: { requiresAuth: true }
    },
    {
        path: '/profile/create',
        component: profilesCreate,
        meta: { requiresAuth: true }
    },
    {
        path: '/profile/create',
        component: profileList,
        meta: { requiresAuth: true }
    },
]

export  default  profileRouter
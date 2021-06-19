import productList from './components/list'
import productCreate from './components/create'

const productRouter = [
    {
        path: '/products',
        name: 'Products',
        component: productList,
        meta: { requiresAuth: true }
    },
    {
        path: '/products/create',
        component: productCreate,
        meta: { requiresAuth: true }
    },
    {
        path: '/products/create',
        component: productList,
        meta: { requiresAuth: true }
    },
]

export  default  productRouter
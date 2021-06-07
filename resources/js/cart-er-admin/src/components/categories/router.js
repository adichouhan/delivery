import categoryList from './components/create'


const productRouter = [
    {
        path: '/categories',
        name: 'Categories',
        component: categoryList,
        meta: { requiresAuth: true }
    },
    
]

export  default  productRouter
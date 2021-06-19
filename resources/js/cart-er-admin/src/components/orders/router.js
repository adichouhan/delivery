import orderList from './components/list'

const orderRouter = [
    {
        path: '/orders',
        name: 'Orders',
        component: orderList,
        meta: { requiresAuth: true }
    },
]

export  default  orderRouter
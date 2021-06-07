import axios from 'axios'
export default {
    getProductList({commit}) {
        axios.get('/api/admin/products')
            .then(response => {
                if(response.status == 200){
                    commit('setProductList', response.data)
                }
            }).catch(error => {
            console.log(error)
        })
    },

    addCategory({commit}, payload) {
        axios.post('/api/admin/category/store', payload)
            .then(response => {

            }).catch(error => {
            console.log(error)
        })

    },

    addNewProduct({commit}, payload) {
        axios.post('/api/admin/products/add', payload)
            .then(response => {

            }).catch(error => {
            console.log(error)
        })

    },


    //To authenticate user Details
    getAuthenticateUserLogin(context, payload) {
        payload.form.post('/api/login')
            .then((response) => {
                if(200 === response.data.status){
                    context.commit('setErrors', {errors:  false});
                    context.commit('setUserProfile', {responseData: response.data});
                    context.commit('setLoginStatus', {boolLoggedIn: true})
                    context.commit('showLoading', {boolShowLoading: false});
                    payload.router.push('/dashboard')
                }
                else {
                    context.commit('setErrors', {errors:  [response.data.error.message]});
                }
            }, (err) => {
                context.dispatch('showErrors', response);
            });
    }



}



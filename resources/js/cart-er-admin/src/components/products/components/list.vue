<template lang="html">
    <section class="tables">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-4">Products</h5>
                            </div>
                            <div class="col-4">
                                <b-button variant="primary" class="pull-right"><router-link class="nav-link text-white" to="/products/create">Create Product</router-link></b-button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table center-aligned-table">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">Product No</th>
                                    <th class="border-bottom-0">Product Name</th>
                                    <th class="border-bottom-0">Description</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Units</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0"></th>
                                    <th class="border-bottom-0"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="objProduct in arrProductList" >
                                    <td>{{ objProduct.id }}</td>
                                    <td>{{ objProduct.name }}</td>
                                    <td>{{ objProduct.description }}</td>
                                    <td>{{ objProduct.price }}</td>
                                    <td>{{ objProduct.units }}</td>
                                    <td><img :src="objProduct.image"></td>
                                    <td><a href="#" class="btn btn-outline-success btn-sm">View Product</a></td>
                                    <td><a href="#" class="btn btn-outline-danger btn-sm">Delete</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script lang="js">
    import { mapState } from 'vuex';
    export default {
        name: 'productlist',
        data () {
            return {
                            
            }
        },
        created() {
            this.getProductList();
        },
        methods:{
            getProductList() {
                this.$store.dispatch('getProductList');
            }
        },
        computed: {
            ...mapState([
                'arrProductList',
            ]),
        },
    }
</script>

<style scoped lang="scss">
    .tables {

    }
</style>

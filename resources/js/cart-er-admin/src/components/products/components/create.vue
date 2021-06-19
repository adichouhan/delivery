<template lang="html">
    <section class="forms">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Product</h4>
                        <b-form-group label="Name" label-for="input5">
                            <b-form-input type="text" v-model="objProduct.name" id="name"
                                          placeholder="Name"></b-form-input>
                        </b-form-group>
                        <b-form-group label="SKU" label-for="input5">
                            <b-form-input type="text" v-model="objProduct.sku" id="sku"
                                          placeholder="SKU"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Description" label-for="input10">
                            <textarea id="description" v-model="objProduct.description" class="form-control"
                                      rows="6"></textarea>
                        </b-form-group>
                        <div class="mb-3">
                            <b-form-select v-model="objProduct.in_stock" :options="options"></b-form-select>
                        </div>
                        <b-form-group label="Price" label-for="input6">
                            <b-form-input type="text" id="price" v-model="objProduct.price" placeholder="Price"
                                          name="price"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Unit" label-for="unit">
                            <b-form-input type="number" id="unit" v-model="objProduct.units" placeholder="Product Unit"
                                          name="units"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Upload Image" label-for="input8">
                            <b-form-file id="inpu8" type="file" v-model="objProduct.image" @change="selectFile" name="image"
                                         placeholder="Choose a image..."></b-form-file>
                        </b-form-group>

                        <b-button type="submit" variant="success" class="mr-2" @click="addProduct()">Submit</b-button>
                        <b-button variant="light">Cancel</b-button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script>
    // eslint-disable
    import {mapState} from 'vuex'

    export default {
        name: 'AddProduct',
        data() {
            return {
                objProduct: {
                    name: '',
                    price: '',
                    image: '',
                    description: '',
                    units: '',
                    sku: '',
                    in_stock: null,
                },
                options: [
                    { value: null, text: 'Please select is in stock' },
                    { value: '1', text: 'Yes' },
                    { value: '0', text: 'No' }
                ],
                errors: [],
            };
        },

        computed: {},
        components: {},
        methods: {
            addProduct() {
                this.$store.dispatch('addNewProduct', this.objProduct)
            },

            selectFile(event) {
                // `files` is always an array because the file input may be in multiple mode
                // this.image = event.target.files[0].name;
                this.image = '';
            }

        }
    };

</script>
<style scoped>

</style>

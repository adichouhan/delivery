<template lang="html">
    <section class="tables">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4> Create Category </h4>
                        <div>
                         <b-form-group label="Name" label-for="input5">
                            <b-form-input type="text" v-model="objCategory.name" id="category"
                                          placeholder="Name"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Parent Category" label-for="input5">
                            <b-form-input type="text" v-model="objCategory.parent_category" id="parent_category"
                                          placeholder="Parent Category" ></b-form-input>
                        </b-form-group>
                         <b-form-checkbox
                            id="checkbox-1"
                            v-model="objCategory.status"
                            name="checkbox-1">
                                 Enable Category
                         </b-form-checkbox>
                        <div class="mt-3">
                            
                         <b-button type="submit" variant="success" class="mr-2" @click="addCategory()">Submit</b-button>
                        <b-button variant="light">Cancel</b-button>
                        </div>
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
        name: 'Category',
        data () {
            return {
                   objCategory: {
                    name: '',
                    subCategory : '',
                    status : ''
                },          
            }
        },

        created() {
            
        },

        methods:{
             addCategory() {
                this.$store.dispatch('addCategory', this.objCategory)
            },
        },

        computed: {
            ...mapState([
                
            ]),
        },
    }
</script>

<style scoped lang="scss">
    
</style>

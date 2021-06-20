<template lang="html">
    <section class="forms">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New User</h4>
                        <b-form-group label="Name" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.name" id="name"
                                          placeholder="Name"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Email" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.email" id="email"
                                          placeholder="Email Id"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Password" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.password" id="password"
                                          placeholder="Password"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Phone" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.phone_number" id="phone_number"
                                          placeholder="Phone Number"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Location" label-for="input10">
                            <textarea id="location" v-model="objProfile.location" class="form-control"
                                      rows="6"></textarea>
                        </b-form-group>
                        <b-form-group label="Card" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.card_number" id="card_number"
                                          placeholder="Card Number"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Upload file" label-for="files">
                            <b-form-file v-model="objProfile.image" id="files" :state="Boolean(objProfile.image)" v-on:change="onImageChange" placeholder="Choose a file..."></b-form-file>
                        </b-form-group>
                        <b-button type="submit" variant="success" class="mr-2" @click="addProfile()">Submit</b-button>
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
        name: 'AddUser',
        data() {
            return {
                objProfile: {
                    name: '',
                    phone_number: '',
                    image: null,
                    location: '',
                    card_number: '',
                    password: '',
                    email: '',
                },
                errors: [],
            };
        },

        computed: {},
        components: {},
        methods: {
            addProfile() {
                this.$store.dispatch('addNewProfile', this.objProfile)
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.objProfile.image = e.target.result;
                };
                reader.readAsDataURL(file)
            }

        }
    };

</script>
<style scoped>

</style>

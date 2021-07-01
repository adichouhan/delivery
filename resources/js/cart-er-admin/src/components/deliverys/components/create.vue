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
                            <b-form-input type="number" v-model="objProfile.phone_number" id="phone_number"
                                          placeholder="Phone Number"></b-form-input>
                        </b-form-group>
                        <!--                        <b-form-group label="Location" label-for="input10">-->
                        <!--                            <textarea id="location" v-model="objProfile.location" class="form-control"-->
                        <!--                                      rows="6"></textarea>-->
                        <!--                        </b-form-group>-->
                        <b-form-group label="Location" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.location" disabled id="Location"
                                          placeholder="Location"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Card" label-for="input5">
                            <b-form-input type="text" v-model="objProfile.card_number" id="card_number"
                                          placeholder="Card Number"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Tracking Codes" label-for="input5">
                            <b-form-input type="number" v-model="objProfile.tracking_codes" id="card_number"
                                          placeholder="Tracking codes"></b-form-input>
                        </b-form-group>

                        <b-form-group horizontal label="Notifications">
                            <b-form-radio-group id="on" v-model="objProfile.is_notification" name="radioSubComponent">
                                <b-form-radio value="1">On</b-form-radio>
                                <b-form-radio value="0">Off</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>

                        <b-form-group label="Upload file" label-for="files">
                            <b-form-file v-model="objProfile.image" id="files" :state="(objProfile.image)" v-on:change="onImageChange" placeholder="Choose a file..."></b-form-file>
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
        name: 'create',
        data() {
            return {
                objDelivery: {
                    sender: '',
                    reciver: '',
                    location: null,
                    note: '',
                    tracking_id: '',
                    Eta: '',
                    status: 0,
                },
                errors: [],
            };
        },
    };

</script>
<style scoped>

</style>

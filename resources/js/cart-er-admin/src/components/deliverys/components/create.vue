<template lang="html">
    <section class="forms">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New User</h4>
                        <b-form-group label="Name" label-for="input5">
                            <b-form-input type="text" v-model="objDelivery.name" id="name"
                                          placeholder="Name"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Email" label-for="input5">
                            <b-form-input type="text" v-model="objDelivery.email" id="email"
                                          placeholder="Email Id"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Password" label-for="input5">
                            <b-form-input type="text" v-model="objDelivery.password" id="password"
                                          placeholder="Password"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Phone" label-for="input5">
                            <b-form-input type="number" v-model="objDelivery.phone_number" id="phone_number"
                                          placeholder="Phone Number"></b-form-input>
                        </b-form-group>
                        <!--                        <b-form-group label="Location" label-for="input10">-->
                        <!--                            <textarea id="location" v-model="objProfile.location" class="form-control"-->
                        <!--                                      rows="6"></textarea>-->
                        <!--                        </b-form-group>-->
                        <b-form-group label="Location" label-for="input5">
                            <b-form-input type="text" v-model="objDelivery.location" disabled id="Location"
                                          placeholder="Location"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Card" label-for="input5">
                            <b-form-input type="text" v-model="objDelivery.card_number" id="card_number"
                                          placeholder="Card Number"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Tracking Codes" label-for="input5">
                            <b-form-input type="number" v-model="objDelivery.tracking_codes" id="card_number"
                                          placeholder="Tracking codes"></b-form-input>
                        </b-form-group>

                        <b-form-group horizontal label="Notifications">
                            <b-form-radio-group id="on" v-model="objDelivery.is_notification" name="radioSubComponent">
                                <b-form-radio value="1">On</b-form-radio>
                                <b-form-radio value="0">Off</b-form-radio>
                            </b-form-radio-group>
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

        created() {
            this.getDeliveryDetails();
        },

        methods: {
            save() {
                let id= this.$route.params.id
                let url= '/api/admin/delivery/'+id
                axios.post(url,{
                    username: this.objDelivery.name,
                    email: this.objProfile.email,
                    password: this.objProfile.password,
                    phone_number: this.objProfile.phone_number,
                    is_notification: this.objProfile.is_notification,
                    tracking_codes: this.objProfile.tracking_codes,
                })
                    .then(response => {
                        if(response.status == 200){
                            this.$router.push('/profiles')
                        }
                    }).catch(error => {
                    console.log(error)
                })
            },
            getDeliveryDetails(){
                let id= this.$route.params.id
                let url= '/api/admin/delivery/'+id
                axios.get(url)
                    .then(response => {
                        console.log(response.data.sender);
                        if(response.status == 200){
                            this.objDelivery.sender_name     =   response.data.sender.username;
                            this.objDelivery.receiver_name   =   response.data.receiver.username;
                            this.objDelivery.location        =   response.data.location;
                            this.objDelivery.note            =   response.data.note;
                            this.objDelivery.tracking_id     =   response.data.tracking_id;
                            this.objDelivery.ETA             =   response.data.ETA;
                        }
                    }).catch(error => {
                    console.log(error)
                })
            },
        }
    };

</script>
<style scoped>

</style>

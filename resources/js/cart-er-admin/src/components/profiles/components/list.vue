<template lang="html">
    <section class="tables">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-4">User Profiles</h5>
                            </div>
                            <div class="col-4">
                                <b-button variant="primary" class="pull-right"><router-link class="nav-link text-white" to="/profile/create">Add Deliverys</router-link></b-button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table center-aligned-table">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">Sr.No</th>
                                    <th class="border-bottom-0">Profile Photo</th>
                                    <th class="border-bottom-0">User Name</th>
                                    <th class="border-bottom-0">Email Id</th>
                                    <th class="border-bottom-0">Phone Number</th>
                                    <th class="border-bottom-0">Location</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="objProfile in arrProfile" >
                                    <td>{{ objProfile.id }}</td>
                                    <td>
                                        <img class="img-sm rounded-circle mb-2 mb-md-0" :src='"/profile/" + objProfile.avatar' alt="profile image">
                                    </td>
                                    <td>{{ objProfile.username }}</td>
                                    <td>{{ objProfile.email }}</td>
                                    <td>{{ objProfile.phone_number}}</td>
                                    <td>{{ objProfile.location }}</td>
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
        name: 'delivery',
        data () {
            return {

            }
        },
        created() {
            this.getProfileList();
        },
        methods:{
            getProfileList() {
                this.$store.dispatch('getProfileList');
            },
        },
        computed: {
            ...mapState([
                'arrProfile',
            ]),
        },
    }

</script>

<style scoped lang="scss">
    .tables {

    }
</style>

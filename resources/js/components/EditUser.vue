<template>
    <div class="text-2xl text-green-800">

        <div class="container">
            <h3 class="text-center">All Users</h3><br/>

            <div class="row">
                <div class="col-md-6">
                    <form @submit.prevent="updateUser">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" v-model="user.email">
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "EditUser",
        data() {
            return {
                user: {}
            }
        },
        created() {
            axios
                .get(`/api/users/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.user = response.data;
                });
        },
        methods: {
            updateUser() {
                axios
                    .post(`/api/users/update/${this.$route.params.id}`, this.user)
                    .then((response) => {
                        if(response.data.errors){
                            var email = response.data.errors.email;
                            var name = response.data.errors.name;

                            if(email[0]){
                                this.$toaster.error(email[0]);
                            }
                            if(name[0]){
                                this.$toaster.error(name[0]);
                            }
                        }
                        else{
                            this.$router.push({ name: "Dashboard"});
                            this.$toaster.success('Successfully Updated');
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>

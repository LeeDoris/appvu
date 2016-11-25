<template>
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form @keydown.enter.prevent="deleteUser" role="form">
            <div class="box-body">
                <img class="profile-user-img img-responsive img-circle"
                     :src="user.avatar" alt="User profile picture">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input v-model="user.name" class="form-control" name="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input v-model="user.username" class="form-control" name="Username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="Email">Email address:</label>
                    <input v-model="user.email" type="email" class="form-control" name="Email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="gravatar">Avatar:</label>
                    <input v-model="user.avatar" class="form-control disabled" name="gravatar" placeholder="Avatar" disabled="true">
                </div>
                <div class="form-group">
                    <label for="biography">Bio:</label>
                    <textarea v-model="user.bio" class="form-control" name="bio" rows="5" id="biography"></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Current Password:</label>
                    <input v-model="user.password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input v-model="user.new_password" type="password" class="form-control" name="new_password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm Password:</label>
                    <input v-model="user.new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-flat btn-info pull-right" @click="updateUser(user)">Save admin</button>
                <button class="btn btn-flat btn-danger" @click="deleteUser(user)">Delete</button>
            </div>
        </form>
    </div>
    <!-- /.box -->
</template>
<script>
    import { stack_bottomright, show_stack_success, show_stack_error } from '../../Pnotice.js'

    export default {
        created() {
            this.fetchUser()
        },
        data () {
            return {
                user: {
                    name: '',
                    username: '',
                    email: '',
                    new_password: '',
                    new_password_confirmation: '',
                    avatar: '',
                    bio: ''
                }
            }
        },
        methods: {
            fetchUser () {
                let itemId = this.$route.params.hashid
                this.$http({url: '/api/admin/' + itemId, method: 'GET'}).then(function (response) {
                    this.$set('user', response.data)
                })
            },
            updateUser (user) {
                event.preventDefault();
                this.$http.patch('/api/admin/' + user.hashid, user).then(function (response) {
                    show_stack_success('Category saved', response)
                }, function (response){
                    show_stack_error('Failed to save category', response)
                })
            },
            deleteUser (user) {
                event.preventDefault();
                let self = this
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this admin!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function() {
                    self.$http.delete('/api/admin/' + user.hashid, user).then(function (response) {
                        self.$router.go('/admin')
                        swal(
                                'Deleted!',
                                'Your admin has been deleted.',
                                'success'
                        );
                    }, function (response){
                        show_stack_error('Failed to delete admin', response)
                    })
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your admin is safe :)',
                                'error'
                        );
                    }
                });
            }
        },
    }
</script>
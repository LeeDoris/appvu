<template>
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body">
                <img class="profile-user-img img-responsive img-circle"
                     :src="user.avatar" alt="User profile picture">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" name="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input class="form-control" name="Username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="Email">Email address:</label>
                    <input type="email" class="form-control" name="Email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="gravatar">Avatar:</label>
                    <input class="form-control disabled" name="gravatar" placeholder="Avatar" disabled="true">
                </div>
                <div class="form-group">
                    <label for="biography">Bio:</label>
                    <textarea class="form-control" name="bio" rows="5" id="biography"></textarea>
                </div>
                <div class="form-group">
                    <label for="new_password">Password:</label>
                    <input type="password" class="form-control" name="new_password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm Password:</label>
                    <input type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-flat btn-info pull-right" @click="createUser(user)">Submit</button>
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
                user: {}
            }
        },
        methods: {
            fetchUser () {
                this.$http({url: '/api/admin', method: 'GET'}).then(function (response) {
                    this.$set('user', response.data)
                })
            },
            createUser (user) {
                this.$http.patch('/api/admin/' + user.hashid, user).then(function (response) {
                    show_stack_info('Creating Admin...', response)
                    if( user.new_password == user.new_password_confirmation ){
                        show_stack_success('Create Success', response)
                    }else {
                        show_stack_error('Failed to create admin', response)
                    }
                })
            },
        },
    }
</script>
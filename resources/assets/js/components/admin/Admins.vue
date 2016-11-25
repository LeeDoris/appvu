<template>
    <section class="content">
        <h1>Admin</h1>
        <button type="button" v-link="{ name: 'createadmins' }" class="btn btn-lg btn-primary btn-flat" style="margin-bottom: 15px;">Add new admin</button>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Admins</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Bio</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="user in users">
                                <td class="col-md-2">{{user.name}}</td>
                                <td class="col-md-2">{{user.username}}</td>
                                <td class="col-md-2">{{user.email}}</td>
                                <td class="col-md-2">{{user.bio}}</td>
                                <td class="col-md-2">
                                    <div class="btn-group">
                                        <button type="button" v-link="{ name: 'editadmins', params: {hashid: user.hashid}}" class="btn btn-warning">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" @click="deleteUser(user)">Delete</button>
                                        <!--<button class="btn btn-danger" @click="deleteUser(user)">Delete</button>-->
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>
<script>
    import { stack_bottomright, show_stack_success, show_stack_error, show_stack_info } from '../../Pnotice.js'
    export default {
        created() {
            this.fetchUsers()
        },
        data () {
            return {
                users: {
                }
            }
        },
        methods: {
            fetchUsers () {
                this.$http({url: '/api/admin', method: 'GET'}).then(function (response) {
                    this.$set('users', response.data.data)
                })
            },
            deleteUser (user) {
                let self = this
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this admin!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function () {
                    self.users.$remove(user)
                    self.$http.delete('/api/admin/' + user.hashid, user).then(function (response) {
                        swal(
                                'Deleted!',
                                'Your admin has been deleted.',
                                'success'
                        );
                    }, function (response) {
                        show_stack_error('Failed to delete admin', response)
                    })
                }, function (dismiss) {
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

<template>
    <section class="content">
        <h1>Comments</h1>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Comments</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th class="col-md-2">User</th>
                                <th class="col-md-7">Comment</th>
                                <th class="col-md-2">Comment ID</th>
                                <th class="col-md-1">Action</th>
                            </tr>

                            <tr v-for="discussion in discussions">
                                <td>{{discussion.user_id}}</td>
                                <td>{{discussion.body}}</td>
                                <td>{{discussion.chatter_category_id}}</td>
                                <td class="col-sm-3">
                                    <div class="btn-group">
                                        <button class="btn btn-danger" @click="deleteDiscussion(discussion)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <v-paginator :resource.sync="discussions" :resource_url="resource_url" :options="options"></v-paginator>
                        </div>
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
    import VuePaginator from 'vuejs-paginator/dist/vuejs-paginator.min.js'

    export default {
        components: {
            VPaginator: VuePaginator,
        },
        ready () {
            this.fetchDiscussion()
        },
        data () {
            return {
                options: {
                    remote_data: 'data',
                    remote_current_page: 'meta.pagination.current_page',
                    remote_last_page: 'meta.pagination.total_pages',
                    remote_next_page_url: 'meta.pagination.links.next',
                    remote_prev_page_url: 'meta.pagination.links.previous'
                },
                discussions: [],
            }
        },
        methods: {
            fetchDiscussion () {
                this.$http({url: '/api/discussion', method: 'GET'}).then(function (response) {
                    this.$set('discussions', response.data.data)
                })
            },
            deleteDiscussion (discussion) {
                let self = this
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this discussion!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function() {
                    self.discussions.$remove(discussion)
                    self.$http.delete('/api/discussion/' + discussion.id, discussion).then(function (response) {
                        swal(
                                'Deleted!',
                                'Your discussion has been deleted.',
                                'success'
                        );
                    }, function (response){
                        show_stack_error('Failed to delete discussion', response)
                    })
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your discussion is safe :)',
                                'error'
                        );
                    }
                });
            },
        },
        computed: {
            resource_url: function () {
                return '/api/discussion'
            },
        },
    }
</script>

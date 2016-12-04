<template>
    <section class="content">
        <h1>Forum Category</h1>
        <button type="button" @click="createCategory" class="btn btn-lg btn-primary btn-flat" style="margin-bottom: 15px;">Add new category</button>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th class="col-md-3">Order</th>
                                <th class="col-md-3">Category</th>
                                <th class="col-md-3">Color</th>
                                <th class="col-md-3">Action</th>
                            </tr>

                            <tr v-for="chattercategory in chattercategorys">
                                <td>{{chattercategory.order}}</td>
                                <td>{{chattercategory.name}}</td>
                                <td>{{chattercategory.color}}</td>
                                <td class="col-sm-3">
                                    <div class="btn-group">
                                        <a href="/forums/category/{{chattercategory.slug}}" target="blank"  class="btn btn-success" role="button">View</a>
                                        <button type="button" v-link="{ name: 'chattercategoryedit', params: {id: chattercategory.id}}" class="btn btn-warning">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" @click="deleteCategory(chattercategory)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <v-paginator :resource.sync="chattercategorys" :resource_url="resource_url" :options="options"></v-paginator>
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
            this.fetchCategory()
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
                chattercategorys: [],
            }
        },
        methods: {
            fetchCategory () {
                this.$http({url: '/api/chattercategory', method: 'GET'}).then(function (response) {
                    this.$set('chattercategorys', response.data.data)
                })
            },
            createCategory () {
                this.$http({url: '/api/chattercategory', method: 'POST'}).then(function (response) {
                    show_stack_info('Creating Category...', response)
                    this.$router.go('/chattercategory/'  + response.data.id + '/edit')
                })
            },
            deleteCategory (chattercategory) {
                let self = this
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this category!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function() {
                    self.chattercategorys.$remove(chattercategory)
                    self.$http.delete('/api/chattercategory/' + chattercategory.id, chattercategory).then(function (response) {
                        swal(
                                'Deleted!',
                                'Your category has been deleted.',
                                'success'
                        );
                    }, function (response){
                        show_stack_error('Failed to delete category', response)
                    })
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your category is safe :)',
                                'error'
                        );
                    }
                });
            },
        },
        computed: {
            resource_url: function () {
                return '/api/chattercategory'
            },
        },
    }
</script>

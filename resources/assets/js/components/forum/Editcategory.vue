<template>
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Category</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form @keydown.enter.prevent="deleteCategory" class="form-horizontal">
            <div class="box-body">

                <div class="form-group">
                    <label for="name" class="col-sm-1 control-label">Category</label>
                    <div class="col-sm-11">
                        <input class="form-control" id="name" placeholder="category"
                               v-model="chattercategory.name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="order" class="col-sm-1 control-label">Order</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="order" placeholder="order" v-model="chattercategory.order">
                    </div>
                </div>

                <div class="form-group">
                    <label for="color" class="col-sm-1 control-label">Color</label>
                    <div class="col-sm-3">
                        <input type="color" class="form-control" id="color" placeholder="#" v-model="chattercategory.color">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-flat btn-info pull-right" @click="updateCategory(chattercategory)">Save category</button>
                <button class="btn btn-flat btn-danger" @click="deleteCategory(chattercategory)">Delete</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>

<script>
    import { stack_bottomright, show_stack_success, show_stack_error } from '../../Pnotice.js'

    export default {
        created() {
            this.chattercategoryId = this.$route.params.id
            this.fetchCategory()
        },
        data () {
            return {
                chattercategory: {},
                chattercategoryId: ''
            };
        },
        methods: {
            fetchCategory () {
                this.$http({url: '/api/chattercategory/' + this.chattercategoryId , method: 'GET'}).then(function (response) {
                    this.$set('chattercategory', response.data)
                })
            },
            updateCategory (chattercategory) {
                event.preventDefault();
                this.$http.patch('/api/chattercategory/' + chattercategory.id, chattercategory).then(function (response) {
                    show_stack_success('Category saved', response)
                }, function (response){
                    show_stack_error('Failed to save category', response)
                })
            },
            deleteCategory (chattercategory) {
                event.preventDefault();
                let self = this
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this category!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function() {
                    self.$http.delete('/api/chattercategory/' + chattercategory.id, chattercategory).then(function (response) {
                        self.$router.go('/chattercategory')
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
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1 {
        color: #42b983;
    }
</style>

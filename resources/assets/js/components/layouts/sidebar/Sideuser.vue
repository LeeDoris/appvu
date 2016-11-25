<template>
    <div>
    {{creatingPost}}
    <!-- Sidebar user panel (optional) -->
    <div v-link="{ path: '/profile' }" class="user-panel">
        <div class="pull-left image">
            <img class="profile-user-img img-responsive img-circle"
                 :src="user.avatar" alt="User profile picture">
        </div>
        <div class="pull-left info">
            <p>{{user.name}}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    </div>
</template>
<script>
    import { stack_bottomright, show_stack_success, show_stack_error, show_stack_info } from '../../../Pnotice.js'

    export default {
        created() {
            this.fetchUser()
        },
        data () {
            return {
                user: {}
            }
        },
        computed: {
            creatingPost: function () {
                return this.$route.name === 'editpost'
            }
        },
        methods: {
            fetchUser () {
                this.$http({url: '/api/me', method: 'GET'}).then(function (response) {
                    this.$set('user', response.data)
                })
            },
            createPost () {
                if( !this.creatingPost ){
                    this.$http({url: '/api/posts', method: 'POST'}).then(function (response) {
                        show_stack_info('Creating post...', response)
                        this.$router.go('/posts/'  + response.data.hashid + '/edit')
                    }, function (response){
                        show_stack_error('Failed to create post!', response)
                    })
                } else {
                    swal('Sorry', 'Please navigate elsewhere before creating new post.', 'info')
                }
            }
        }
    }
</script>
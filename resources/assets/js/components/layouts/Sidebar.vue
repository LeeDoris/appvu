<template>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <sideuser></sideuser>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <menu></menu>
    </section>
    <!-- /.sidebar -->
</template>

<script>
  import { stack_bottomright, show_stack_success, show_stack_error, show_stack_info } from '../../Pnotice.js'
  import Menu from '../../components/layouts/sidebar/Menu.vue'
  import Sideuser from '../../components/layouts/sidebar/Sideuser.vue'

  export default {
    components: {
      Menu,
      Sideuser
    },
    replace: false
  }
</script>
<template>
<div >
  <navbar></navbar>
  <sidebar class="main-sidebar" style="position: fixed"></sidebar>

  <div id="app">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->
        <!-- route outlet -->
        <router-view></router-view>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <footer class="main-footer">
    <div>
      <strong>Copyright &copy; <a href="http://almsaeedstudio.com">Li Doris</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>
</template>

<script>
</script>
<script>
import Navbar from './components/layouts/Navbar.vue'
import Sidebar from './components/layouts/Sidebar.vue'


export default {
  components: {
    Navbar,
    Sidebar
  },
  replace: false
}
</script>

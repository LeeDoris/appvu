<!--<template>-->
    <!--<ul class="sidebar-menu">-->
        <!--<li class="header">MAIN NAVIGATION</li>-->
        <!--<li v-for="item in list | filterBy menuFilter in 'name'" :class='{treeview:item.name,active:$route.path.indexOf(item.path)>=0}'>-->
            <!--<a v-link="{path:item.path}">-->
                <!--<i :class="item.class"></i>-->
                <!--<span>{{item.name}}</span>-->
            <!--</a>-->
        <!--</li>-->
    <!--</ul>-->
<!--</template>-->
<template>
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li v-for="item in list | filterBy menuFilter in 'name'" :class='{treeview:item.child,active:$route.path.indexOf(item.path)>=0}'>
        <a v-link="{path:item.path}" v-if='!item.child'>
            <i class="fa fa-th"></i>
            <span>{{item.name}}</span>
        </a>
        <a v-if='item.tree'>
            <i :class="item.class"></i>
            <span>{{item.name}}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" v-if='item.tree' v-show='$route.path.indexOf(item.path)>=0' style="display: none;">
            <li v-for='subItem in item.child'>
                <a href="#" v-link="{path:subItem.path}">
                    <i class="fa fa-circle-o"></i>
                    {{subItem.name}}
                </a>
            </li>
        </ul>
    </li>
</ul>
</template>
<script>
    export default {
        data () {
            return {
                menuFilter: '',
                list: require('../../../components/layouts/sidebar/aside.config.js')
            }
        }
    }
</script>
<template>
  <dark-mode></dark-mode>
  <router-view></router-view>
  <back-to-top></back-to-top>
  <main-footer></main-footer>
</template>

<script setup>
import {RouterView} from 'vue-router'
import BackToTop from "@/components/Default/BackToTop.vue";
import DarkMode from "@/management/components/Main/DarkMode.vue";
import MainFooter from "@/management/components/Main/MainFooter.vue";
</script>

<style scoped>

</style>
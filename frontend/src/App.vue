<template>
  <main-header/>
  <router-view/>
  <BackToTop/>
  <main-footer/>
</template>

<script setup>
import {RouterView} from 'vue-router'
import MainHeader from "@/components/Default/MainHeader.vue";
import MainFooter from "@/components/Default/MainFooter.vue";
import BackToTop from "@/components/Default/BackToTop.vue";
</script>

<style scoped>

</style>

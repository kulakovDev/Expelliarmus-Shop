<template>
  <main-header/>
  <router-view/>
  <main-footer/>
</template>

<script setup>
import {RouterView} from 'vue-router'
import MainHeader from "@/components/Default/MainHeader.vue";
import MainFooter from "@/components/Default/MainFooter.vue";
</script>

<style scoped>

</style>

<template>
  <div class="mb-6 grid grid-cols-2 gap-8">
    <card-holder class="col-span-2 sm:col-span-1" v-model="cardHolder"></card-holder>
    <card-number class="col-span-2 sm:col-span-1" v-model="cardNumber"></card-number>
    <card-expiration v-model="cardExpiration"></card-expiration>
    <card-secret v-model="cardSecret"></card-secret>
  </div>
</template>

<script>

import CardHolder from "@/components/CreditCard/CardHolder.vue";
import CardNumber from "@/components/CreditCard/CardNumber.vue";
import CardExpiration from "@/components/CreditCard/CardExpiration.vue";
import CardSecret from "@/components/CreditCard/CartSecret.vue";

export default {
  components: {CardExpiration, CardNumber, CardHolder, CardSecret},
  data() {
    return {
      cardHolder: '',
      cardExpiration: '',
      cardNumber: '',
      cardSecret: ''
    }
  }
}
</script>

<style scoped>

</style>
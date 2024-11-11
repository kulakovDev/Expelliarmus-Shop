<template>
  <div class="flex flex-col gap-y-4">
    <card-holder v-model="cardHolder" class="text-start"></card-holder>
    <card-number v-model="cardNumber" class="text-start"></card-number>
    <div class="flex justify-between gap-x-4">
      <card-expiration v-model="cardExpiration" class="text-start"></card-expiration>
      <card-secret v-model="cardSecret" class="text-start"></card-secret>
    </div>
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
      cardHolder: 'aa',
      cardExpiration: '',
      cardNumber: '',
      cardSecret: ''
    }
  }
}
</script>


<style scoped>

</style>
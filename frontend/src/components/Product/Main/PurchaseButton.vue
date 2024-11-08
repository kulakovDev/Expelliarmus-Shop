<template>
  <div>
    <button
        @click="handleButtonClick"
        :class="{
          'bg-white text-black underline underline-offset-4 decoration-2 decoration-dashed border border-gray-700 border-green-600 hover:text-green-600': isInCart,
          'bg-[#db4444] border border-[#db4444] text-white hover:bg-red-900' : !isInCart
        }"
        class="px-8 py-3 text-center rounded-md">
      {{ isInCart ? 'Show Cart' : 'Buy Now' }}
    </button>
  </div>
</template>

<script>
import { DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

export default {
  components: { DialogTitle, DialogPanel, TransitionChild, TransitionRoot },
  data() {
    return {
      isInCart: false
    }
  },
  methods: {
    handleButtonClick() {
      if (this.isInCart) {
        this.handleCartOpenModal();
      } else {
        this.addToCart();
      }
    },
    addToCart() {
      this.isInCart = true;

      this.$mitt.emit('add-to-cart');
    },
    handleCartOpenModal() {
      this.$emit('open-cart-modal');
    }
  }
}
</script>

<style scoped>
</style>

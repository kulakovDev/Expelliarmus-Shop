<template>
  <main class="container-custom bg-[#f5f5f5] shadow-light-mode dark:shadow-[0_8px_30px_rgb(255,255,255,0.12)] rounded-2xl h-screen dark:bg-[#1c1c1c]">
    <slot></slot>
  </main>
</template>

<script>

</script>


<style scoped>
.container-custom {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  padding-left: 1rem;
  padding-right: 1rem;
}

@media (min-width: 640px) {
  .container-custom {
    max-width: 640px;
  }
}

@media (min-width: 768px) {
  .container-custom {
    max-width: 768px;
    margin-top: 2.5rem;
  }
}

@media (min-width: 1024px) {
  .container-custom {
    max-width: 1024px;
    margin-top: 2.5rem;
  }
}

@media (min-width: 1280px) {
  .container-custom {
    max-width: 1280px;
  }
}

@media (min-width: 1536px) {
  .container-custom {
    max-width: 1536px;
  }
}

@media (min-width: 1664px) {
  .container-custom {
    max-width: 1664px;
  }
}

@media (min-width: 1728px) {
  .container-custom {
    max-width: 1728px;
  }
}

</style>
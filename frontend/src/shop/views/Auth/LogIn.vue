<template>
  <main class="container mx-auto my-20 max-w-screen-2xl">
    <div class="flex items-center justify-center">
      <img src="/default/auth-image.png" alt="Login image">
      <div class="mx-auto max-w-md">
        <div class="space-y-6 mb-12">
          <p class="text-4xl">Log in to Expelliarmus</p>
          <p>Enter your details below</p>
        </div>
        <form class="max-w-md mx-auto space-y-10">
          <div class="relative z-0 w-full mb-5 group">
            <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer" placeholder=" " required />
            <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
          </div>
          <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer" placeholder=" " required />
            <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
          </div>
          <div class="flex justify-between items-center">
            <router-link to="#" type="button" class="px-12 py-4 bg-[#DB4444] text-center cursor-pointer text-white hover:bg-red-900 rounded-md">Log In</router-link>
            <router-link class="text-[#DB4444]" to="#">Forgot password?</router-link>
          </div>
          <p class="text-gray-600 text-center text-sm">Don't have an account yet? <span><router-link class="text-black hover:underline underline-offset-8" to="/sign-up">Register now!</router-link></span></p>
        </form>
      </div>
    </div>
  </main>
</template>

<script>

</script>

<style scoped>

</style>
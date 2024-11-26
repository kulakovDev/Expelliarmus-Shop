<template>
  <main class="container mx-auto my-20">
    <div class="flex items-center justify-center">
      <img src="/default/auth-image.png" alt="Login image" />
      <div class="mx-auto max-w-md">
        <div class="space-y-6 mb-12">
          <p class="text-4xl">Log in to Expelliarmus</p>
          <p>Enter your details below</p>
        </div>
        <Form
          class="max-w-md mx-auto space-y-10"
          @submit="login"
          method="post"
          :validation-schema="schema"
        >
          <div class="relative z-0 w-full mb-5 group">
            <Field
              type="email"
              name="email"
              id="email"
              v-model="user.email"
              class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
              placeholder=" "
              required
            />
            <label
              for="email"
              class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
              >Email address</label
            >
            <ErrorMessage
              name="email"
              class="text-sm text-red-600"
            ></ErrorMessage>
          </div>
          <div class="relative z-0 w-full mb-5 group">
            <Field
              type="password"
              name="password"
              v-model="user.password"
              id="password"
              class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
              placeholder=" "
              required
            />
            <label
              for="password"
              class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
              >Password</label
            >
            <ErrorMessage
              name="password"
              class="text-sm text-red-600"
            ></ErrorMessage>
          </div>
          <div class="flex justify-between items-center">
            <button
              type="submit"
              class="px-12 py-4 bg-[#DB4444] text-center cursor-pointer text-white hover:bg-red-900 rounded-md"
            >
              Log In
            </button>
            <router-link class="text-[#DB4444]" to="#"
              >Forgot password?
            </router-link>
          </div>
          <div class="flex flex-col justify-center items-center gap-y-4">
            <p class="text-gray-600 text-center text-sm">
              Don't have an account yet?
              <span
                ><router-link
                  @click.prevent="scrollToTop"
                  class="text-black hover:underline underline-offset-8"
                  to="/sign-up"
                  >Register now!</router-link
                ></span
              >
            </p>
            <span class="text-sm text-red-600 font-bold" v-if="loginError">{{
              loginError.toString()
            }}</span>
          </div>
        </Form>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";
import { reactive, ref } from "vue";
import { useScrolling } from "@/composables/useScrolling.js";
import { useAuthStore } from "@/stores/useAuthStore.js";
import { useRouter } from "vue-router";

const { scrollToTop } = useScrolling();
const router = useRouter();

const schema = yup.object().shape({
  email: yup.string().email().required(),
  password: yup.string().required(),
});

const user = reactive({
  email: null,
  password: null,
});

const loginError = ref(null);

const auth = useAuthStore();

function login() {
  auth
    .login(user)
    .then((response) => {
      auth.fetchCurrentUser();
      router.push({ name: "home" });
    })
    .catch((e) => {
      if (e.response?.data?.errors?.email) {
        loginError.value = e.response.data.errors.email[0];
      }
    });
}
</script>

<style scoped></style>

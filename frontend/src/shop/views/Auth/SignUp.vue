<script setup>
import * as yup from "yup";
import { ErrorMessage, Field, Form } from "vee-validate";
import { ref } from "vue";
import { useScrolling } from "@/composables/useScrolling.js";

const { scrollToTop } = useScrolling();

const user = ref({
  email: null,
  first_name: null,
  password: null,
});

const schema = yup.object().shape({
  email: yup.string().email().required(),
  password: yup.string().min(6).required(),
  first_name: yup.string().max(50).required("your name is required"),
  passwordConfirmation: yup
    .string()
    .required()
    .oneOf([yup.ref("password")], "Passwords do not match"),
});
</script>

<template>
  <main class="container mx-auto my-20">
    <div class="flex items-center justify-center">
      <img src="/default/auth-image.png" alt="Login image" />
      <div class="mx-auto max-w-md">
        <div class="space-y-6 mb-12">
          <p class="text-4xl">Create an account</p>
          <p>Enter your details below</p>
        </div>
        <Form
          class="max-w-md mx-auto space-y-10"
          method="post"
          :validation-schema="schema"
        >
          <div class="relative z-0 w-full mb-5 group">
            <Field
              name="first_name"
              id="name"
              v-model="user.first_name"
              class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
              placeholder=" "
              required
            />
            <label
              for="name"
              class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
              >Name</label
            >
            <ErrorMessage
              class="text-red-600 text-sm"
              name="first_name"
            ></ErrorMessage>
          </div>
          <div class="relative z-0 w-full mb-5 group">
            <Field
              name="email"
              id="email"
              v-model="user.email"
              type="email"
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
              class="text-red-600 text-sm"
              name="email"
            ></ErrorMessage>
          </div>
          <div class="relative z-0 w-full mb-5 group">
            <Field
              name="password"
              type="password"
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
              class="text-red-600 text-sm"
              name="password"
            ></ErrorMessage>
          </div>
          <div class="relative z-0 w-full mb-5 group">
            <Field
              type="password"
              name="passwordConfirmation"
              id="password_confirm"
              class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
              placeholder=" "
              required
            />
            <label
              for="password_confirm"
              class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
              >Confirm password</label
            >
            <ErrorMessage
              class="text-red-600 text-sm"
              name="passwordConfirmation"
            ></ErrorMessage>
          </div>
          <div class="space-y-6">
            <button
              type="button"
              class="w-full px-12 py-4 bg-[#DB4444] text-center cursor-pointer text-white hover:bg-red-900 rounded-md"
            >
              Create an Account
            </button>
            <p class="text-gray-600 text-center text-sm">
              Are you ready have an account?
              <span
                ><router-link
                  @click.prevent="scrollToTop"
                  class="text-black hover:underline underline-offset-8"
                  to="/log-in"
                  >Log in</router-link
                ></span
              >
            </p>
          </div>
        </Form>
      </div>
    </div>
  </main>
</template>

<style scoped></style>

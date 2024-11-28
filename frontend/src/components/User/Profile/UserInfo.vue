<script setup>
import { useAuthStore } from "@/stores/useAuthStore.js";
import BaseTextInput from "@/components/Default/BaseTextInput.vue";
import { useForm } from "vee-validate";
import * as yup from "yup";

const authStore = useAuthStore();

const { errors, handleSubmit, defineField } = useForm({
  validationSchema: yup.object({
    email: yup.string().email().required().label("Email"),
    first_name: yup.string().max(50).required().label("First name"),
    last_name: yup.string().max(255).notRequired().label("Last name"),
  }),
  initialValues: {
    email: authStore.user?.email,
    first_name: authStore.user?.first_name,
    last_name: authStore.user?.last_name,
  },
});

const [email, emailAttrs] = defineField("email");
const [first_name, firstNameAttrs] = defineField("first_name");
const [last_name, lastNameAttrs] = defineField("last_name");

const onSubmit = handleSubmit((values) => {
  console.log(values);
});
</script>

<template>
  <form class="space-y-6" method="post" @submit="onSubmit">
    <section class="grid grid-cols-2 grid-rows-2 gap-8">
      <base-text-input
        id="first-name"
        name="first_name"
        v-model="first_name"
        v-bind="firstNameAttrs"
        label="First Name"
        :error="errors.first_name"
        data-vv-as="First name"
      >
      </base-text-input>
      <base-text-input
        id="last-name"
        name="last_name"
        v-model="last_name"
        v-bind="lastNameAttrs"
        label="Last Name"
        :error="errors.last_name"
      >
      </base-text-input>
      <base-text-input
        id="email"
        name="email"
        v-model="email"
        v-bind="emailAttrs"
        label="Email"
        :error="errors.email"
      >
      </base-text-input>
    </section>
    <section class="flex justify-end gap-x-8">
      <button
        type="submit"
        class="px-12 py-4 bg-[#db4444] text-white text-center hover:bg-red-900 rounded-md"
      >
        Save Changes
      </button>
    </section>
  </form>
</template>

<style scoped></style>

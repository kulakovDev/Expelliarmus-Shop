<script setup>
import { useAuthStore } from "@/stores/useAuthStore.js";
import BaseTextInput from "@/components/Default/BaseTextInput.vue";
import { useForm } from "vee-validate";
import * as yup from "yup";
import api from "@/utils/api.js";
import { HttpStatusCode } from "axios";
import { useToast } from "vue-toastification";
import {
  emailRule,
  firstNameRule,
  lastNameRule,
} from "@/utils/validationRules.js";

const authStore = useAuthStore();

const { errors, handleSubmit, defineField } = useForm({
  validationSchema: yup.object({
    email: emailRule(yup),
    first_name: firstNameRule(yup),
    last_name: lastNameRule(yup).notRequired(),
  }),
  initialValues: {
    email: authStore.email,
    first_name: authStore.firstName,
    last_name: authStore.lastName,
  },
});

const [email, emailAttrs] = defineField("email");
const [first_name, firstNameAttrs] = defineField("first_name");
const [last_name, lastNameAttrs] = defineField("last_name");

const toast = useToast();

const onSubmit = handleSubmit(async (values) => {
  await api()
    .put("/user/profile-information", values)
    .then((response) => {
      if (response.status === HttpStatusCode.Ok) {
        authStore.$patch({
          user: {
            ...authStore.user,
            email: values.email,
            first_name: values.first_name,
            last_name: values.last_name,
          },
        });
        toast.success(
          "Success! If you update your email, please, check inbox.",
        );
      }
    })
    .catch((e) => {
      if (e.response?.data?.message) {
        toast.error(e.response.data.message);
      }
    });
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

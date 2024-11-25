import { defineStore } from "pinia";
import api from "@/utils/api.js";
import { login } from "@/utils/auth.js";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    error: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state?.user,
  },
  actions: {
    async login(user) {
      await login(user)
        .then((response) => {
          this.fetchCurrentUser();
        })
        .catch((e) => {
          if (e.response?.data?.errors.email) {
            this.error = e.response?.data?.errors.email[0];
          }
        });
    },
    async fetchCurrentUser() {
      try {
        const response = await api().get("/api/v1/current-user");
        this.user = response?.data?.data.attributes;
      } catch (e) {
        this.forgetUser();
      }
    },
    forgetUser() {
      this.user = null;
    },
  },
});

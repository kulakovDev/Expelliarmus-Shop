import { defineStore } from "pinia";
import api from "@/utils/api.js";
import { login } from "@/utils/auth.js";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    isSessionVerificationInitialize: false,
  }),
  getters: {
    isAuthenticated: (state) => !!state?.user,
  },
  actions: {
    async login(user) {
      return await login(user);
    },

    async fetchCurrentUser() {
      try {
        const response = await api().get("/api/v1/current-user");
        this.user = response?.data?.data.attributes;
      } catch (e) {
        if (e.response.status === 401) {
          this.user = null;
        }
      } finally {
        this.isSessionVerificationInitialize = true;
      }
    },
  },
});

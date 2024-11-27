import { defineStore } from "pinia";
import api from "@/utils/api.js";
import { login, logout } from "@/utils/auth.js";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    isSessionVerified: false,
  }),
  getters: {
    isAuthenticated: (state) => !!state?.user,
  },
  actions: {
    async login(user) {
      return await login(user);
    },

    async fetchCurrentUser(force = false) {
      if (this.isSessionVerified && !force) {
        this.isSessionVerified = false;
        return;
      }

      try {
        const response = await api().get("/api/v1/current-user");
        this.user = response?.data?.data.attributes;
      } catch (e) {
        if (e.response.status === 401 || e.response.status === 419) {
          this.forgetUser();
        }
      }
    },

    async attempt() {
      try {
        const response = await api().get("/api/v1/current-user");
        this.user = response?.data?.data.attributes;
      } catch (e) {
        if (e.response.status === 401 || e.response.status === 419) {
          this.forgetUser();
        }
      } finally {
        this.isSessionVerified = true;
      }
    },

    async logout() {
      return await logout().then(() => {
        this.forgetUser();
      });
    },

    forgetUser() {
      this.user = null;
      this.isSessionVerified = false;
    },
  },
});

import axios from "axios";
import router from "@/router.js";
import { useAuthStore } from "@/stores/useAuthStore.js";

export default function api() {
  const api = axios.create({
    baseURL: "http://api.expelliarmus.com:8080",
    withCredentials: true,
    withXSRFToken: true,
    xsrfCookieName: "XSRF-TOKEN",
    xsrfHeaderName: "X-XSRF-TOKEN",
    headers: {
      Accept: "application/json",
    },
  });

  api.interceptors.request.use(async (config) => {
    if (config.method !== "get" && !config.headers["X-XSRF-TOKEN"]) {
      await axios.get("http://api.expelliarmus.com:8080/sanctum/csrf-cookie", {
        withCredentials: true,
      });
    }

    return config;
  });

  api.interceptors.response.use(
    function (response) {
      return response;
    },
    function (error) {
      if (error.request.status === 403) {
      }

      if ([419].includes(error.request.status)) {
        router.push({ name: "login" });
      }

      const auth = useAuthStore();

      return Promise.reject(error);
    },
  );

  return api;
}

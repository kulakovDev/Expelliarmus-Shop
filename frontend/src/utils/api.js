import axios from "axios";

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

  return api;
}

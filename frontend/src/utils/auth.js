import api from "@/utils/api.js";

export const login = async (user) => {
  return api().post("/login", {
    email: user.email.toString(),
    password: user.password.toString(),
  });
};

export const logout = async () => {
  return api().post("/logout");
};

export const register = async (user) => {
  return api().post("/register", {
    first_name: user.first_name,
    email: user.email,
    password: user.password,
    password_confirmation: user.password_confirmation,
  });
};

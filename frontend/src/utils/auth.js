import api from "@/utils/api.js";

export const login = async (user) => {
  return api().post("/login", {
    email: user.email.toString(),
    password: user.password.toString(),
  });
};

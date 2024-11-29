export const passwordRule = (yup, label = "Password", min = 6) => {
  return yup.string().required().min(min).label(label);
};

export const currentPasswordRule = (yup, label = "Current password") => {
  return yup.string().required().label(label);
};

export const newPasswordRule = (
  yup,
  label = "New password",
  currentPasswordLabel = "current_password",
  min = 6,
) => {
  return yup
    .string()
    .min(min)
    .label(label)
    .notOneOf(
      [yup.ref(currentPasswordLabel)],
      "The new password must not be the same as the old one.",
    );
};

export const passwordConfirmationRule = (
  yup,
  rootPasswordLabel = "password",
  label = "Password confirmation",
) => {
  return yup
    .string()
    .required()
    .label(label)
    .oneOf([yup.ref(rootPasswordLabel)], "Password must be the same");
};

export const emailRule = (yup, label = "Email") => {
  return yup.string().email().required().label(label);
};

export const firstNameRule = (yup, label = "First name", max = 50) => {
  return yup.string().max(50).required().label(label);
};

export const lastNameRule = (yup, label = "Last name", max = 255) => {
  return yup.string().max(max).label(label);
};

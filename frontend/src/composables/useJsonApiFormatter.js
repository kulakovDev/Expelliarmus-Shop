export function useJsonApiFormatter() {
  function toJsonApi(data, type, relationships = {}) {
    const result = {
      data: {
        type: type,
        attributes: { ...data },
        relationships: {},
      },
    };

    for (const [key, value] of Object.entries(relationships)) {
      if (value && typeof value === "object" && !Array.isArray(value)) {
        result.data.relationships[key] = {
          data: { ...value },
        };
      } else if (Array.isArray(value)) {
        result.data.relationships[key] = {
          data: value.map((item) => ({ ...item })),
        };
      }
    }

    return JSON.stringify(result);
  }

  function fromJsonApiErrorsFields(errors) {
    const formattedErrors = [];

    Object.keys(errors).forEach((key) => {
      const errorMessages = errors[key];

      let formattedKey = key
        .replace(/(\.data|data\.)/g, "")
        .replace(/\.(\d+)\./g, "[$1].")
        .replace(/relationships\s/gi, "");

      errorMessages.forEach((message) => {
        formattedErrors.push({ [formattedKey]: message });
      });
    });

    return formattedErrors;
  }

  return {
    toJsonApi,
    fromJsonApiErrorsFields,
  };
}

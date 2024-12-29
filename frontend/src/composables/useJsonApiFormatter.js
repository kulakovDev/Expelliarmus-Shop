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

  return {
    toJsonApi,
  };
}

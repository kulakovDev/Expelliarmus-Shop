import api from "@/utils/api.js";

export const ProductService = {
  async getAvailableAttributes() {
    const response = await api().get("/available-product-attributes");

    return response.data.map((attribute) => ({
      id: attribute.id,
      name: attribute.name,
      type: attribute.type,
    }));
  },
};

import api from "@/utils/api.js";
import { useJsonApiFormatter } from "@/composables/useJsonApiFormatter.js";

export const ProductService = {
  async getAvailableAttributes() {
    const response = await api().get("/available-product-attributes");

    return response.data.map((attribute) => ({
      id: attribute.id,
      name: attribute.name,
      type: attribute.type,
    }));
  },

  async createProduct(productData, relationships) {
    const formatter = useJsonApiFormatter();

    const data = formatter.toJsonApi(
      productData.value,
      "products",
      relationships,
    );

    console.log(data);
  },
};

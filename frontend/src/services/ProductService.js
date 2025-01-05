import api from "@/utils/api.js";
import { useJsonApiFormatter } from "@/composables/useJsonApiFormatter.js";

export const ProductService = {
  async getAvailableAttributes() {
    const response = await api().get(
      "/management/available-product-attributes",
    );

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

    return api().post("/management/products/create", data, {
      headers: {
        "Content-Type": "application/json",
      },
    });
  },

  async uploadImagesForProduct(productId, images) {
    const formData = new FormData();

    images.forEach((image, index) => {
      formData.append(`images[]`, image.file);
    });

    return await api().post(
      "/management/product/" + productId + "/images",
      formData,
      {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      },
    );
  },
};

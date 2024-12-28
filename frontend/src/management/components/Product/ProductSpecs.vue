<template>
  <div class="space-y-4">
    <div
      v-for="(item, index) in productSpecs.data"
      :key="index"
      class="spec-item"
    >
      <!-- Условие, чтобы рендерить группу даже с пустым именем -->
      <div v-if="item.group !== undefined" class="space-y-4">
        <div class="flex items-center gap-4">
          <focused-text-input
            id="group_name"
            name="group_name"
            v-model="item.group"
            label="Group Name"
            placeholder="Enter group name"
            required
          />
        </div>

        <div
          v-for="(value, valueIndex) in item.value"
          :key="valueIndex"
          class="flex gap-4 ml-5 items-end"
        >
          <focused-text-input
            v-model="item.value[valueIndex].spec_name"
            id="spec_name"
            name="spec_name"
            label="Specification name"
            required
          />

          <focused-text-input
            v-model="item.value[valueIndex].value"
            id="value"
            name="Value"
            label="Value"
            required
          />

          <button
            @click="removeGroupField(index, valueIndex)"
            class="bg-red-500 p-2 text-white rounded-md hover:bg-red-800"
          >
            Delete
          </button>
        </div>

        <button
          @click="addGroupField(index)"
          class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700"
        >
          Add new field to group
        </button>
      </div>

      <!-- Блок для отдельного поля -->
      <div v-else class="flex gap-4 items-end">
        <focused-text-input
          v-model="item.value[0].spec_name"
          id="spec_name"
          name="spec_name"
          label="Specification name"
          required
        />

        <focused-text-input
          v-model="item.value[0].value"
          id="value"
          name="Value"
          label="Value"
          required
        />

        <button
          @click="removeField(index)"
          class="bg-red-500 p-2 text-white rounded-md hover:bg-red-800"
        >
          Delete
        </button>
      </div>
    </div>

    <div class="flex gap-4">
      <button
        @click="addGroup"
        class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700"
      >
        Add new group
      </button>
      <button
        @click="addField"
        class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700"
      >
        Add separate field
      </button>
    </div>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const productSpecs = reactive({
  data: [],
});

const addGroup = () => {
  productSpecs.data.push({
    id: null,
    value: [{ spec_name: "", value: "" }],
    group: "",
  });
  emitUpdate();
};

const addField = () => {
  productSpecs.data.push({
    id: null,
    value: [{ spec_name: "", value: "" }],
  });
  emitUpdate();
};

const addGroupField = (groupIndex) => {
  productSpecs.data[groupIndex].value.push({ spec_name: "", value: "" });
  emitUpdate();
};

const removeField = (index) => {
  productSpecs.data.splice(index, 1);
  emitUpdate();
};

const removeGroupField = (groupIndex, fieldIndex) => {
  productSpecs.data[groupIndex].value.splice(fieldIndex, 1);
  if (
    productSpecs.data[groupIndex].value.length === 0 &&
    !productSpecs.data[groupIndex].group.trim()
  ) {
    productSpecs.data.splice(groupIndex, 1);
  }
  emitUpdate();
};

const emit = defineEmits(["updateSpecs"]);

const emitUpdate = () => {
  emit("updateSpecs", productSpecs.data);
};
</script>

<style scoped></style>

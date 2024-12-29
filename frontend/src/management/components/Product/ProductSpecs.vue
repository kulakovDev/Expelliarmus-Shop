<template>
  <div class="space-y-4">
    <div
      v-for="(group, groupIndex) in productSpecs.data"
      :key="groupIndex"
      class="mr-2"
    >
      <div v-if="group.group !== null" class="space-y-4">
        <div class="flex flex-wrap gap-4 items-center">
          <focused-text-input
            v-model="group.group"
            id="group_name"
            name="group_name"
            label="Group Name"
            placeholder="Enter group name"
            required
            class="w-full sm:w-80"
          />
          <button
            type="button"
            @click="removeGroup(groupIndex)"
            class="bg-red-500 p-2 text-white rounded-md hover:bg-red-800 ml-4"
          >
            Delete Group
          </button>
        </div>

        <div
          v-for="(spec, specIndex) in group.value"
          :key="specIndex"
          class="space-y-4 ml-5"
        >
          <div class="flex flex-wrap gap-4 items-start flex-col sm:flex-row">
            <focused-text-input
              v-model="spec.spec_name"
              id="spec_name"
              name="spec_name"
              label="Specification name"
              required
              class="w-full sm:w-80"
            />

            <div class="flex flex-col gap-4 w-full sm:w-auto">
              <div
                v-for="(val, valIndex) in spec.value"
                :key="valIndex"
                class="flex gap-4 items-end flex-col sm:flex-row"
              >
                <focused-text-input
                  v-model="spec.value[valIndex]"
                  id="value"
                  name="Value"
                  label="Value"
                  required
                  class="w-full sm:w-60"
                />

                <button
                  type="button"
                  @click="removeSpecValue(groupIndex, specIndex, valIndex)"
                  class="bg-red-500 p-2 text-white rounded-md hover:bg-red-800"
                >
                  Delete
                </button>
              </div>
              <button
                type="button"
                @click="addSpecValue(groupIndex, specIndex)"
                class="bg-blue-500 p-2 text-white rounded-md hover:bg-blue-800"
              >
                Add Value
              </button>
            </div>
          </div>
        </div>

        <button
          type="button"
          @click="addGroupField(groupIndex)"
          class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700 mt-4 sm:mt-6"
        >
          Add new field to group
        </button>
      </div>

      <div v-else class="flex flex-wrap gap-4 items-start">
        <focused-text-input
          v-model="group.value[0].spec_name"
          id="spec_name"
          name="spec_name"
          label="Specification name"
          required
          class="w-full sm:w-80"
        />

        <div class="flex flex-col gap-4 w-full sm:w-auto">
          <div
            v-for="(val, valIndex) in group.value[0].value"
            :key="valIndex"
            class="flex items-end gap-4 flex-col sm:flex-row"
          >
            <focused-text-input
              v-model="group.value[0].value[valIndex]"
              id="value"
              name="Value"
              label="Value"
              required
              class="w-full sm:w-60"
            />

            <button
              type="button"
              @click="removeSpecValue(groupIndex, 0, valIndex)"
              class="bg-red-500 p-2 text-white rounded-md hover:bg-red-800"
            >
              Delete
            </button>
          </div>
          <button
            type="button"
            @click="addSpecValue(groupIndex, 0)"
            class="bg-blue-500 p-2 text-white rounded-md hover:bg-blue-800"
          >
            Add Value
          </button>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap gap-4 justify-between sm:justify-start">
      <button
        type="button"
        @click="addGroup"
        class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700 sm:w-auto w-full"
      >
        Add new group
      </button>
      <button
        type="button"
        @click="addField"
        class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700 sm:w-auto w-full"
      >
        Add separate field
      </button>
    </div>
  </div>
</template>

<script setup>
import { reactive, watch } from "vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const productSpecs = reactive({
  data: Array.from({ length: 0 }, () => ({
    group: null,
    value: [{ spec_name: "", value: [""] }],
  })),
});

const addGroup = () => {
  productSpecs.data.push({
    group: "",
    value: [{ spec_name: "", value: [""] }],
  });
};

const addField = () => {
  productSpecs.data.push({
    group: null,
    value: [{ spec_name: "", value: [""] }],
  });
};

const addGroupField = (groupIndex) => {
  productSpecs.data[groupIndex].value.push({ spec_name: "", value: [""] });
};

const addSpecValue = (groupIndex, specIndex) => {
  productSpecs.data[groupIndex].value[specIndex].value.push("");
};

const removeSpecValue = (groupIndex, specIndex, valIndex) => {
  const group = productSpecs.data[groupIndex];
  const spec = group.value[specIndex];

  spec.value.splice(valIndex, 1);

  if (spec.value.length === 0) {
    group.value.splice(specIndex, 1);
  }

  if (group.value.length === 0 && !group.group) {
    productSpecs.data.splice(groupIndex, 1);
  }
};

// Метод для удаления группы
const removeGroup = (groupIndex) => {
  productSpecs.data.splice(groupIndex, 1);
};

const emit = defineEmits(["updateSpecs"]);

const prepareDataForBackend = () => {
  return productSpecs.data.flatMap((item) => {
    if (item.group) {
      return item.value.map((spec) => ({
        spec_name: spec.spec_name.trim(),
        value: spec.value.map((val) => val.trim()),
        group: item.group.trim(),
      }));
    } else {
      return item.value.map((spec) => ({
        spec_name: spec.spec_name.trim(),
        value: spec.value.map((val) => val.trim()),
        group: null,
      }));
    }
  });
};

const emitUpdate = () => {
  emit("updateSpecs", prepareDataForBackend());
};

watch(
  productSpecs.data,
  () => {
    emitUpdate();
  },
  { deep: true },
);
</script>

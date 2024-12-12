<template>
  <tab-group
    :selectedIndex="selectedTab"
    as="div"
    class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-12"
  >
    <tab-list id="tab-list" class="md:col-span-1 flex flex-col gap-y-6">
      <Tab
        v-for="(image, index) in images"
        :key="index"
        class="w-44 h-40 bg-[#f3f4f6] rounded-md relative flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]"
        @click="setMainImage(index)"
      >
        <img
          v-if="image.url"
          :src="image.url"
          alt="Uploaded image"
          class="rounded-md max-w-full max-h-full"
        />
      </Tab>

      <Tab
        v-if="images.length < 4"
        class="w-44 h-40 bg-[#f3f4f6] rounded-md relative flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]"
      >
        <input
          type="file"
          class="absolute inset-0 opacity-0 cursor-pointer"
          accept="image/*"
          @change="handleFileChange"
        />
        <div
          class="rounded-md bg-gray-200 flex justify-center items-center flex-col w-full h-full"
        >
          <img src="/default/add.png" alt="Add" class="w-12 h-12" />
          <span>Add new photo</span>
        </div>
      </Tab>
    </tab-list>

    <tab-panels
      class="md:col-span-3 rounded-md bg-[#f3f4f6] max-w-xl max-h-712 overflow-hidden"
    >
      <template v-if="images.length > 0">
        <tab-panel
          v-for="(image, index) in images"
          :key="index"
          class="flex justify-center items-center h-full"
        >
          <img
            v-if="image.url"
            :src="image.url"
            alt="Main image"
            class="rounded-md max-w-full max-h-full"
          />
        </tab-panel>
      </template>
      <template v-else>
        <tab-panel class="flex justify-center items-center h-full">
          <img
            src="https://dummyimage.com/576x712/000/fff"
            alt="Main image"
            class="rounded-md max-w-full max-h-full"
          />
        </tab-panel>
      </template>
    </tab-panels>
  </tab-group>
</template>

<script setup>
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import { nextTick, reactive, ref } from "vue";

const images = reactive([]);
const mainImage = ref("");
const selectedTab = ref(0);

function handleFileChange(event) {
  const file = event.target.files[0];
  if (file && images.length < 4) {
    const fileUrl = URL.createObjectURL(file);

    images.push({ file, url: fileUrl, order: images.length + 1 });

    if (images.length === 1) {
      mainImage.value = fileUrl;
    }

    selectedTab.value = images.length - 1;

    nextTick(() => {
      const lastTab = document.querySelector(
        `#tab-list > *:nth-child(${images.length})`,
      );
      lastTab?.focus();
    });
  }
}

function setMainImage(index) {
  mainImage.value = images[index].url;
  selectedTab.value = index;
}
</script>

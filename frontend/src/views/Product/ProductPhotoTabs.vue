<template>
  <tab-group as="div" class="grid grid-cols-4 gap-12">
    <tab-list class="col-span-1 flex flex-col gap-y-6">
      <Tab class="w-44 h-40 bg-[#f3f4f6] rounded-md flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]">
        <img src="https://dummyimage.com/176x160/000/fff" alt="" class="rounded-md max-w-full max-h-full">
      </Tab>
      <Tab class="w-44 h-40 bg-[#f3f4f6] rounded-md flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]">
        <img src="https://dummyimage.com/176x160/000/fff" alt="" class="rounded-md max-w-full max-h-full">
      </Tab>
      <Tab class="w-44 h-40 bg-[#f3f4f6] rounded-md flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]">
        <img src="https://dummyimage.com/176x160/000/fff" alt="" class="rounded-md max-w-full max-h-full">
      </Tab>
      <Tab class="w-44 h-40 bg-[#f3f4f6] rounded-md flex justify-center items-center focus:ring-8 focus:ring-[#e29e32]">
        <img src="https://dummyimage.com/176x160/000/fff" alt="" class="rounded-md max-w-full max-h-full">
      </Tab>
    </tab-list>
    <tab-panels class="col-span-3 rounded-md bg-[#f3f4f6] max-w-xl max-h-712 overflow-hidden">
      <tab-panel class="flex justify-center items-center h-full">
        <img src="https://dummyimage.com/576x712/000/fff" alt="" class="rounded-md">
      </tab-panel>
      <tab-panel class="flex justify-center items-center h-full">
        <img src="https://dummyimage.com/576x712/000/fff" alt="" class="rounded-md">
      </tab-panel>
      <tab-panel class="flex justify-center items-center h-full">
        <img src="https://dummyimage.com/576x712/000/fff" alt="" class="rounded-md">
      </tab-panel>
      <tab-panel class="flex justify-center items-center h-full">
        <img src="https://dummyimage.com/576x712/000/fff" alt="" class="rounded-md">
      </tab-panel>
    </tab-panels>
  </tab-group>
</template>


<script>
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";

export default {
  components: {TabPanel, TabPanels, Tab, TabList, TabGroup},
};
</script>

<style scoped>

</style>
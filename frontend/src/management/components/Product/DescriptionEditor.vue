<script setup>
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { Markdown } from "tiptap-markdown";
import { onBeforeUnmount, watch } from "vue";
import { Underline } from "@tiptap/extension-underline";

const props = defineProps({
  modelValue: null,
});

const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
  extensions: [
    StarterKit.configure({
      heading: {
        levels: [2, 3, 4],
      },
      code: false,
      codeBlock: false,
    }),
    Markdown,
    Underline,
  ],
  editorProps: {
    attributes: {
      class:
        "prose prose-sm max-w-none p-4 rounded-bl-lg rounded-br-lg focus:ring-inset focus:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500",
    },
  },
  onUpdate: () =>
    emit("update:modelValue", editor.value?.storage.markdown.getMarkdown()),
});

onBeforeUnmount(() => {
  editor.value?.destroy();
});

watch(
  () => props.modelValue,
  (value) => {
    if (value === editor.value?.storage.markdown.getMarkdown()) {
      return;
    }
    editor.value?.commands.setContent(value);
  },
  { immediate: true },
);
</script>

<template>
  <div
    v-if="editor"
    class="rounded-lg bg-white dark:bg-gray-200 text-left shadow-md border-0"
  >
    <menu class="flex divide-x-2 border-b-2 flex-wrap">
      <li>
        <button
          @click="() => editor.chain().focus().toggleBold().run()"
          type="button"
          class="px-3 py-2 rounded-tl-lg"
          :class="[
            editor.isActive('bold')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Bold"
        >
          <i class="fa-solid fa-bold"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleItalic().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('italic')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Italic"
        >
          <i class="fa-solid fa-italic"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleUnderline().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('underline')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Underline"
        >
          <i class="fa-solid fa-underline"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleBlockquote().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('blockquote')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Blockquote"
        >
          <i class="fa-solid fa-quote-left"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleBulletList().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('bulletList')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Bullet List"
        >
          <i class="fa-solid fa-list-ul"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleOrderedList().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('orderedList')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Numeric List"
        >
          <i class="fa-solid fa-list-ol"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().setHorizontalRule().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('horizontalRule')
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Horizontal Rule"
        >
          Horizontal Rule
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 2 }).run()
          "
          type="button"
          class="px-3 py-2 h-full"
          :class="[
            editor.isActive('heading', { level: 2 })
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Heading 1"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.243 4.493v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501m4.501-8.627 2.25-1.5v10.126m0 0h-2.25m2.25 0h2.25"
            />
          </svg>
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 3 }).run()
          "
          type="button"
          class="px-3 py-2 h-full"
          :class="[
            editor.isActive('heading', { level: 3 })
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Heading 2"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21.75 19.5H16.5v-1.609a2.25 2.25 0 0 1 1.244-2.012l2.89-1.445c.651-.326 1.116-.955 1.116-1.683 0-.498-.04-.987-.118-1.463-.135-.825-.835-1.422-1.668-1.489a15.202 15.202 0 0 0-3.464.12M2.243 4.492v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501"
            />
          </svg>
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 4 }).run()
          "
          type="button"
          class="px-3 py-2 h-full"
          :class="[
            editor.isActive('heading', { level: 4 })
              ? 'bg-yellow-700 text-white'
              : 'hover:bg-yellow-500',
          ]"
          title="Heading 3"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M20.905 14.626a4.52 4.52 0 0 1 .738 3.603c-.154.695-.794 1.143-1.504 1.208a15.194 15.194 0 0 1-3.639-.104m4.405-4.707a4.52 4.52 0 0 0 .738-3.603c-.154-.696-.794-1.144-1.504-1.209a15.19 15.19 0 0 0-3.639.104m4.405 4.708H18M2.243 4.493v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501"
            />
          </svg>
        </button>
      </li>
    </menu>
    <EditorContent :editor="editor"></EditorContent>
  </div>
</template>

<style scoped></style>

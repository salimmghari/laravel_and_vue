<template>
  <div class="w-100 mb-5 p-5 secondary-bg-color primary-radius primary-border primary-shadow">
    <AppField label="Title:" type="text" placeholder="The title" :defaultValue="title" :onChange="titleChange" />
    <AppField label="Body:" placeholder="The body" :defaultValue="body" :onChange="bodyChange" :multiLine="true" />
    <AppButton v-if="onCreate !== undefined" className="success-bg-color" title="Create" :onClick="create" />
    <AppButton v-if="onUpdate !== undefined" className="mb-4 warning-bg-color" title="Update" :onClick="update" />
    <AppButton v-if="onDelete !== undefined" className="danger-bg-color" title="Delete" :onClick="delete_" />
  </div>
</template>
<script lang="ts">
  import {defineComponent} from 'vue';
  import AppField from './AppField.vue';
  import AppButton from './AppButton.vue';

  
  export interface Note {
    id: number;
    title: string;
    body: string;
  }


  export default defineComponent({
    name: 'AppNote',
    components: {
      AppField,
      AppButton
    },
    props: {
      title: {
        type: String,
        required: true
      },
      body: {
        type: String,
        required: true
      },
      onTitleChange: {
        type: Function,
        required: true
      },
      onBodyChange: {
        type: Function,
        required: true
      },
      onCreate: {
        type: Function,
        required: false
      },
      onUpdate: {
        type: Function,
        required: false
      },
      onDelete: {
        type: Function,
        required: false
      }
    },
    methods: {
      titleChange(event: Event) {
        this.onTitleChange(event);
      },
      bodyChange(event: Event) {
        this.onBodyChange(event);
      },
      create() {
        if (this.onCreate !== undefined) this.onCreate();
      },
      update() {
        if (this.onUpdate !== undefined) this.onUpdate();
      },
      delete_() {
        if (this.onDelete !== undefined) this.onDelete();
      }
    }
  });
</script>
<style scoped>
</style>
  
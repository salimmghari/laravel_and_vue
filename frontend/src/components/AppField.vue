<template>
    <label class="w-100 mb-2 primary-color">{{ label }}</label>
    <textarea v-if="multiLine" class="w-100 mb-4 px-3 py-2 primary-color secondary-bg-color primary-shadow primary-radius primary-border" style="height: 200px;" :placeholder="placeholder" :defaultValue="defaultValue" @change="change"></textarea>
    <input v-else class="w-100 mb-4 px-3 py-2 primary-color secondary-bg-color primary-shadow primary-radius primary-border" :type="type" :placeholder="placeholder" :defaultValue="defaultValue" @change="change" />
</template>
<script lang="ts">
    import {defineComponent} from 'vue';


    export interface Field {
        label: string;
        type: string;
        placeholder: string;
        onChange: (event: Event) => void;
    }


    export default defineComponent(
        {
            name: 'AppButton',
            props: {
                label: {
                    type: String,
                    required: true
                },
                type: {
                    type: String,
                    required: false
                },
                placeholder: {
                    type: String,
                    required: false
                },
                defaultValue: {
                    type: String,
                    required: false
                },
                multiLine: {
                    type: Boolean,
                    required: false,
                    default: false
                },
                onChange: {
                    type: Function,
                    required: true
                }
            },
            methods: {
                change(event: Event) {
                    this.onChange(event);
                }
            }
        }
    );
</script>
<style scoped>
</style>
  
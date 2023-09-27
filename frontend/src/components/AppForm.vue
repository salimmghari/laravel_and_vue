<template>
    <form class="w-100 p-5 secondary-bg-color primary-radius primary-border primary-shadow">
        <AppTitle :title="title" />
        <AppField v-for="(field, index) in fields" :key="index" :label="field.label" :type="field.type" :placeholder="field.placeholder" :onChange="field.onChange" /> 
        <AppLink :link="link" :onClick="linkClick" />
        <AppButton :title="title" :onClick="click" />
    </form>
</template>
<script lang="ts">
    import {defineComponent} from 'vue';
    import AppTitle from './AppTitle.vue';
    import AppField, {Field} from './AppField.vue';
    import AppLink from './AppLink.vue';
    import AppButton from './AppButton.vue';


    export default defineComponent(
        {
            name: 'AppForm',
            components: {
                AppTitle,
                AppField,
                AppLink,
                AppButton
            },
            props: {
                title: {
                    type: String,
                    required: true
                },
                fields: {
                    type: Array as () => Field[],
                    required: true
                },
                link: {
                    type: String,
                    required: true
                },
                onLinkClick: {
                    type: Function,
                    required: true
                },
                onClick: {
                    type: Function,
                    required: true
                }
            },
            methods: {
                click() {
                    this.onClick();
                },
                linkClick() {
                    this.onLinkClick();
                }
            }
        }
    );
</script>
<style scoped>
</style>
  
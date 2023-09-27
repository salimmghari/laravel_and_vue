<template>
    <button :class="'w-100 px-3 py-2 secondary-color primary-bg-color primary-shadow primary-radius ' + className" @click="click">{{ title }}</button>
</template>
<script lang="ts">
    import {defineComponent} from 'vue';

    
    export default defineComponent(
        {
            name: 'AppButton',
            props: {
                className: {
                    type: String,
                    required: false
                },
                title: {
                    type: String,
                    required: true
                },
                onClick: {
                    type: Function,
                    required: true
                }
            },
            methods: {
                click(event: MouseEvent) {
                    event.preventDefault();
                    this.onClick();
                }
            }
        }
    );
</script>
<style scoped>
</style>
  
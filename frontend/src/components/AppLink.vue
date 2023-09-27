<template>
    <p class="mb-4 info-color small pointer text-center" @click="click">{{ link }}</p>
</template>
<script lang="ts">
    import {defineComponent} from 'vue';

    
    export default defineComponent(
        {
            name: 'AppLink',
            props: {
                link: {
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
  
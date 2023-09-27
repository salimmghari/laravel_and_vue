<template>
    <h2 class="mb-5 text-center">{{ title }}</h2>
</template>
<script lang="ts">
    import {defineComponent} from 'vue';

    
    export default defineComponent(
        {
            name: 'AppTitle',
            props: {
                title: {
                    type: String,
                    required: true
                }
            }
        }
    );
</script>
<style scoped>
</style>
  
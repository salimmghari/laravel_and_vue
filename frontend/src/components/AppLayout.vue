<template>
    <div :class="'w-100 d-flex flex-column justify-content-center align-items-center p-5 secondary-bg-color ' + className">
        <slot></slot>
    </div>
</template>
<script lang="ts">
    import {defineComponent} from 'vue';

    
    export default defineComponent(
        {
            name: 'AppLayout',
            props: {
                className: {
                    type: String,
                    required: false
                }
            }
        }
    );
</script>
<style scoped>
</style>
  
<template>
    <div v-show="isActive">
        <slot></slot>
    </div>
</template>
<script>
    export default {
        props: {
            selected: {default: false}
        },
        data: function() {
            return {
                isActive: false
            }
        },
        created: function() {
            this.isActive = this.selected;
        },
        methods: {
        }
     }
</script>
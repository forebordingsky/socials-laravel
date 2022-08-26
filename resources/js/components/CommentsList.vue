<script setup>
    const props = defineProps(['comments','parent'])
</script>

<template>
    <div>
       <comment-component v-for="comment, index in comments" :key="index" :comment="comment" :parent="parent"/>
    </div>
</template>



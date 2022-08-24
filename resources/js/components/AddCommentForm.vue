<script setup>
import { onMounted, ref } from 'vue';

    const props = defineProps(['commentId'])
    const csrfToken = ref();
    onMounted(() => {
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content
    })

</script>

<template>
    <form action="/profile/add-comment" method="POST" class="border rounded py-2 px-3 ml-3">
        <input type="hidden" :value="csrfToken" name="_token"/>
        <input type="hidden" name="parent_id" value="{{ commentId }}"/>
        <div class="flex mb-2">
            <label>Header</label>
            <input class="ml-2 border-b w-full focus:border-b-2 focus:outline-none" type="text" name="header">
        </div>
        <div class="flex flex-col mb-2">
            <label class="mb-1">Description</label>
            <textarea name="description" rows="3" class="border rounded focus:outline-none focus:border-2 text-sm p-1"></textarea>
        </div>
        <button class="border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" type="submit">Add comment</button>
    </form>
</template>

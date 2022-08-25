<script setup>
import { computed, inject, onMounted, ref } from 'vue';

    const props = defineProps(['comment','parent'])
    const privileges = inject('privileges')
    const csrfToken = ref();
    const showForm = ref(false);
    onMounted(() => {
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content
    })
    const deleteRoute = computed(() => {
        return '/profile/' + (props.comment.user ? props.comment.user.id : privileges.userId) + '/delete-comment/' + props.comment.id
    })
</script>

<template>
    <div class="border rounded shadow-md mb-2">
        <div class="border-b">
            <div class="py-1 px-3 flex gap-1 items-baseline">
                <span v-if="parent" class="text-sm italic">Answer to <strong>{{ parent.header }}</strong> by {{ parent.user.email }}:</span>
                <h3 class="font-medium">{{ comment.header }}</h3>
                <span class="text-sm">by {{ comment.user.email }}</span>
                <!-- Проверяем может ли пользователь удалить комментарий (да, если это его страница или если это он написал комментарий) -->
                <form v-if="!comment.deleted && (privileges.owned || privileges.userId == comment.user_id)"
                    :action="deleteRoute" method="POST" class="ml-auto">
                    <input type="hidden" :value="csrfToken" name="_token"/>
                    <button class="border rounded py-0.5 px-1 hover:bg-red-500 hover:text-white text-sm" type="submit">Delete</button>
                </form>
            </div>
        </div>
        <div class="border-b">
            <p class="py-2 px-3">
                <span>{{ comment.description }}</span>
            </p>
        </div>
        <div class="py-0.5 px-3 flex items-baseline">
            <span class="text-xs">{{ comment.updated_at }}</span>
            <button v-if="privileges.auth && privileges.userId != comment.user_id"
                @click="showForm = !showForm" class="ml-auto text-sm">
                    {{ !showForm ? 'Reply' : 'Hide' }}
            </button>
        </div>
    </div>
    <div v-if="privileges.auth && privileges.userId != comment.user_id" class="mb-2">
        <reply-comment-form v-show="showForm"
            :comment-id="comment.id"
            :user-id="comment.user ? comment.user.id : privileges.profileId"/>
    </div>
    <comments-list-component v-if="comment.replies.length > 0" :comments="comment.replies" :parent="comment" class="ml-2"/>
</template>


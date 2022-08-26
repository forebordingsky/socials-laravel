<script setup>
import { computed, inject, onMounted, ref } from 'vue';

    const props = defineProps(['comment','parent'])

    const users = inject('users')

    const showForm = ref(false);
    const csrfToken = ref();
    onMounted(() => {
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content
    })

    const canDelete = computed(() => {
        if (users.auth && !props.comment.deleted) {
            return (users.auth.id === props.comment.user_id || users.auth.id === props.comment.profile_user_id)
        }
        return false
    })

    const canReply = computed(() => {
        return users.auth && users.auth.id !== props.comment.user_id
    })
    const deleteRoute = computed(() => {
        return '/profile/delete-comment/' + props.comment.id
    })
</script>

<template>
    <div class="border rounded shadow-md mb-2">
        <div class="border-b">
            <div class="py-1 px-3 flex gap-1 items-baseline">
                <span v-if="parent" class="text-sm italic">Answer to <strong>{{ parent.header }}</strong> by {{ parent.user ? parent.user.email : users.profile.email }}:</span>
                <h3 class="font-medium">{{ comment.header }}</h3>
                <span class="text-sm">by {{ comment.user ? comment.user.email : users.profile.email }}</span>
                <!-- Проверка комментарий был написан авторизованным пользователем или это ответ на комментарий авторизованного пользователя -->
                <form v-if="canDelete"
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
            <button v-if="canReply"
                @click="showForm = !showForm" class="ml-auto text-sm">
                    {{ !showForm ? 'Reply' : 'Hide' }}
            </button>
        </div>
    </div>
    <div v-if="canReply" class="mb-2">
        <reply-comment-form v-show="showForm"
            :comment-id="comment.id"
            :comment-user-id="comment.user_id"/>
    </div>
    <comments-list-component v-if="comment.replies.length > 0" :comments="comment.replies" :parent="comment" class="ml-2"/>
</template>


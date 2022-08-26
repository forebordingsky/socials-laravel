<script setup>
import axios from 'axios';
import { computed, provide, ref } from 'vue';

    const props = defineProps(['auth','user'])
    const comments = ref(props.user.latest_comments)
    const user = {
        email: props.user.email,
        id: props.user.id
    }

    provide('users',{
        auth: props.auth,
        profile: user
    })

    //Загружаем все оставшиеся комментарии и скрываем кнопку
    const load = () => {
        axios.get(`/api/profile/${user.id}/comments`)
            .then(response => comments.value = comments.value.concat(response.data))
            .catch(error => console.log(error));
    }

    const canLoad = computed(() => {
        return comments.value.length < props.user.profile_comments_count
    })

</script>

<template>
    <comments-list-component :comments="comments"/>
    <load-button-component v-if="canLoad" @load="load"/>
</template>

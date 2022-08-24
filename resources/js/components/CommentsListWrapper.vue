<script setup>
import axios from 'axios';
import { computed, provide, ref } from 'vue';

    const props = defineProps(['comments','count','auth','owned','profileId','userId'])
    const auth = props.auth
    const owned = props.owned
    const userId = props.userId
    const commentsList = ref(props.comments)
    const loaded = ref(false)
    provide('privileges',{auth, owned,userId})

    const listLenght = computed(() => {
        return commentsList.value.length
    })
    //Загружаем все оставшиеся комментарии и скрываем кнопку
    const load = () => {
        axios.get(`/api/profile/${props.profileId}/comments`)
            .then(response => commentsList.value = commentsList.value.concat(response.data))
            .catch(error => console.log(error));
        loaded.value = !loaded.value
    }

</script>

<template>
    <comments-list-component :comments="commentsList"/>
    <load-button-component v-if="!loaded && listLenght < count" @load="load"/>
</template>

require('./bootstrap');

import { createApp } from 'vue'

import  CommentsListWrapper  from './components/CommentsListWrapper.vue';
import  CommentsList  from './components/CommentsList.vue';
import  Comment  from './components/Comment.vue';
import  LoadButton  from './components/LoadButton.vue';
import  ReplyCommentForm  from './components/ReplyCommentForm.vue';

const app = createApp({
  /* root component options */
})

app.component('comments-list-wrapper', CommentsListWrapper)
app.component('comments-list-component', CommentsList)
app.component('comment-component', Comment)
app.component('load-button-component', LoadButton)
app.component('reply-comment-form', ReplyCommentForm)

app.mount('#app')

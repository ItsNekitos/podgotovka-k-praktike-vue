<template>
    <div id="main">
        <p>{{ place.name }}</p>
        <p>{{ place.desc }}</p>
        <img :src="PUBLIC + place.photo" alt="" />

        <!-- Comments -->
        <div class="post" id="countblock">
            <section class="comments" v-if="isUser">
                <h3>Comments</h3>
                <div>
                    <textarea v-model="comment"></textarea><br />
                    <p class="red" v-if="errors.comment">
                        {{ errors.comment.join('. ') }}
                    </p>
                    <button type="button" @click="addComment" class="button big fit">Добавить комментарий</button>
                </div>
            </section>
            <article class="comment" v-for="value in comments">
                <div class="comment-autor">
                    <p>{{ value.user.name }}</p>
                </div>
                <p>{{ value.comment }}</p>
            </article>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SinglePage',
    props: ['pageId', 'server', 'PUBLIC', 'changePage', 'isUser'],
    data() {
        return {
            place: null,
            comments: [],
            comment: null,
            errors: {},
        };
    },
    mounted() {
        this.getPlace();
    },
    methods: {
        getPlace() {
            this.server('place/' + this.pageId)
                .then((result) => {
                    this.place = result.place;
                    this.comments = result.comments;
                })
                .catch((error) => console.log('error', error));
        },
        addComment() {
            let formdata = new FormData();
            if (this.comment) formdata.append('comment', this.comment);
            this.server('comment/' + this.pageId, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    } else {
                        this.getPlace();
                        this.comment='';
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
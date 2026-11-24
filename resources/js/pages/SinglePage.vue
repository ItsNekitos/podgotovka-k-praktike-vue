<template>
    <div id="main" v-if="place" style="display: flex; align-items: center; flex-direction: column; margin-top: 20px;">
        <div class="card mb-3" style="width: 75%;">
            <img :src="PUBLIC + place.photo" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ place.name }}</h5>
                <p class="card-text">{{ place.desc }}</p>
            </div>
        </div>

        <div style="width: 75%;">
            <section class="comments" v-if="isUser" style="margin-bottom: 20px;">
                <h3>Отзывы</h3>
                <div>
                    <div class="mb-2">
                        <textarea class="form-control" id="commentText" rows="3" placeholder="Напишите текст..."
                            v-model="comment"></textarea>
                    </div>
                    <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.comment">
                        {{ errors.comment.join('. ') }}
                    </p>
                    <button type="button" @click="addComment" class="btn btn-primary">Добавить отзыв</button>
                </div>
            </section>

            <article class="comment" v-for="value in comments">
            <div class="card mb-3">
                <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <h4>{{ value.user.name }}</h4>
                            </div>
                        </div>
                        <p class="card-text mb-2" style="margin-left: 10px;">{{ value.comment }}</p>
                </div>
            </div>
            </article>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SinglePage',
    props: ['pageId', 'server', 'PUBLIC', 'changePage', 'isUser', 'user'],
    data() {
        return {
            place: null,
            comments: [],
            comment: null,
            user_order: null,
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
                    this.user_order = result.user_order;
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
                        this.comment = '';
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
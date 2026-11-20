<template>
    <div id="main">
        <article class="post">
            <h1>{{ pageId ? 'Редактировать' : 'Добавить' }} место</h1>
            <input type="text" v-model="name" placeholder="Post name" />
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <input type="text" v-model="desc" placeholder="desc" />
            <p class="red" v-if="errors.desc">
                {{ errors.desc.join('. ') }}
            </p>

            <input type="file" id="photo" />
            <p class="red" v-if="errors.photo">
                {{ errors.photo.join('. ') }}
            </p>
            <button type="button" @click="pageadd" class="button big fit">{{ pageId ? 'Редактировать' : 'Добавить' }} место</button>
        </article>
        <div v-if="pageId">
            <img :src="PUBLIC + photo" alt="" />
        </div>
    </div>
</template>
<script>
export default {
    name: 'PlacePage',
    props: ['server', 'changePage', 'pageId', 'PUBLIC'],
    data() {
        return {
            name: null,
            desc: null,
            photo: null,
            errors: {},
        };
    },
    mounted() {
        if (this.pageId) {
            this.getPlace();
        }
    },
    methods: {
        getPlace() {
            this.server('place/' + this.pageId)
                .then((result) => {
                    this.name = result.place.name;
                    this.desc = result.place.desc;
                    this.photo = result.place.photo;
                })
                .catch((error) => console.log('error', error));
        },
        pageadd() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.desc) formdata.append('desc', this.desc);
            let photo = document.querySelector('#photo');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server(this.pageId ? 'placeedit/' + this.pageId : 'placeadd', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.id) {
                        this.changePage('UserPage', 'places');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>

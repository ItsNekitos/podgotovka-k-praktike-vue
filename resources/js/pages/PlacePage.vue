<template>
    <div style="width: 100%; display:flex; flex-direction: column; align-items: center; justify-content: center;">
        <div style="margin-bottom: 100px; margin-top: 25px;">
            <h1>{{ pageId ? 'Редактировать' : 'Добавить' }} место</h1>
        </div>
        <div style="width:70%; margin-bottom: 20px;">
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Название места</label>
                <input type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp"
                    v-model="name">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputDesc1" class="form-label">Описание</label>
                <input type="text" class="form-control" id="exampleInputDesc1" v-model="desc">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.desc">
                {{ errors.desc.join('. ') }}
            </p>
            <div class="mb-3">
                <input type="file" id="photo" />
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.photo">
                {{ errors.photo.join('. ') }}
            </p>
            <button type="button" @click="pageadd" class="btn btn-primary">{{ pageId ? 'Редактировать' : 'Добавить' }}
                место</button>
            <div v-if="pageId" class="mb-3">
                <img :src="PUBLIC + photo" alt="" />
            </div>
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
                        alert(this.pageId ? 'Конфепенц-зал успешно отредактирован' : 'Конфепенц-зал успешно создан');
                        this.changePage('UserPage', 'places');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>

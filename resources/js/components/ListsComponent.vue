<template>
    <div class="container">
        <div v-if="show" v-for="list in all_doc">
            <div>
                <div>
                    <a @click="show_doc(list)" href="javascript:void(0);">{{list['name_doc']}}</a>
                </div>
                <div v-if="datas">
                    <button  @click="delete_doc(list['id'])"  type="submit" class="btn btn-danger">Видалити</button>
                    <button  type="button" class="btn btn-warning">Редагувати</button>
                </div>
                <hr>
            </div>
        </div>
        <div v-if="!show">
            <div>
                <div class="alert alert-danger" role="alert" v-if="error">
                    {{error}}
                </div>
                <div>
                   <h1> {{curent_doc['name_doc']}}</h1>
                    <div v-if="datas">
                        <input type="text" v-model="title">
                        <button  @click.prevent="change_title()"  type="submit" class="btn btn-success">змінити Імя</button>
                    </div>
                    <hr>
                </div>
                <div v-for="file in files">
                    {{file['name_file']}}
                    <div v-if="datas">
                        <button  @click="delete_file(file['id'])"  type="submit" class="btn btn-danger">Видалити</button>
                    </div>
                    <hr>
                </div>
                <!--<label for="file">Добавити файли:</label>-->
                <!--<input @change="processFile" id="file" ref="myFiles" name="userfile" type="file" multiple accept="application/pdf" required/>-->
                <!--<button type="submit" @click.prevent="send" class="btn btn-success" name="add_file">Добавити</button>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListsComponent",
        props:[
            'datas',
            'lists'
        ],
        data:function(){
            return{
                error:'',
                title:'',
                curent_doc:'',
                all_doc:[],
                show:true,
                files:[],
                files_add:''
            }
        },
        mounted() {
            this.all_doc = this.lists;
        },
        methods:{
            show_doc(list){
                this.curent_doc = list;
                this.show = false;
                const options = {
                    method: 'POST',
                    data: {id:list['id']},
                    url: '/show_doc',
                };
                axios(options)
                    .then((response) => {
                        this.files = response.data;
                    })
                    .catch(err => console.log(err));
            },
            delete_doc(id){
                const options = {
                    method: 'POST',
                    data: {id:id},
                    url: '/delete',
                };
                axios(options)
                .then((response) => {
                    this.all_doc = response.data;
                })
                .catch(err => console.log(err));
            },
            delete_file(id){
                // console.log(this.curent_doc['id']);
                // console.log(id);
                const options = {
                    method: 'POST',
                    data: {id_file:id, id_doc:this.curent_doc['id']},
                    url: '/delete_file',
                };
                axios(options)
                .then((response) => {
                    console.log(response.data);
                    this.files = response.data;
                })
                .catch(err => console.log(err));
            },
            change_title(id){
                this.error = '';
                const options = {
                    method: 'POST',
                    data: {title:this.title, id:this.curent_doc['id']},
                    url: '/update_doc',
                };
                axios(options)
                    .then((response) => {
                       if (!response.data)
                            this.curent_doc['name_doc'] = this.title;
                    else
                           this.error = "таке імя вже існує";
                    })
                    .catch(err => console.log(err));
            },
            // send() {
            //     // console.log(this.title);
            //     // console.log(this.files);
            //     this.error = '';
            //     this.sucsses = '';
            //     if (this.title && this.files.length){
            //         let formdata = this.toFormData(this.files);
            //         // console.log(formdata);
            //         axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            //         const options = {
            //             method: 'POST',
            //             data: formdata,
            //             url: '/add_file',
            //         };
            //         axios(options)
            //             .then((response) => {
            //                 console.log(response.data);
            //                 if (response.data)
            //                     this.error = response.data;
            //                 else {
            //                     this.title = '';
            //                     this.sucsses = "Файл успішно добавлено";
            //                 }
            //             })
            //             .catch(err => console.log(err));
            //     }
            //     else
            //     {
            //         this.error = "Заповніть всі поля";
            //     }
            // },
            // processFile() {
            //     this.files_add = this.$refs.myFiles.files;
            // },
            // toFormData(obj) {
            //     let formData = new FormData();
            //     // console.log(obj);
            //     for (var i =0; i< this.files_add.length;i++){
            //         let file = this.files_add[i];
            //         formData.append('files['+i+']', file);
            //     }
            //     return formData;
            // },
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="container">
        <div class="alert alert-danger" role="alert" v-if="error">
            {{error}}
        </div>
        <div class="alert alert-success" role="alert" v-if="sucsses">
           {{sucsses}}
        </div>
        <form enctype="multipart/form-data" >
            <label for="titles">Назва документу:</label>
            <input v-model="title" id="titles" type="text" name="name" placeholder="title" required><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <label for="file">Добавити файли:</label>
            <input @change="processFile" id="file" ref="myFiles" name="userfile" type="file" multiple accept="application/pdf" required/>
            <button type="submit" @click.prevent="send" class="btn btn-success" name="add_file">Добавити</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AddComponent",
        data:function () {
            return{
                title:'',
                files:'',
                error:'',
                sucsses:''
            }
        },
        methods:{
            send() {
                // console.log(this.title);
                // console.log(this.files);
                this.error = '';
                this.sucsses = '';
                if (this.title && this.files.length){
                    let formdata = this.toFormData(this.files);
                    // console.log(formdata);
                    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                    const options = {
                        method: 'POST',
                        data: formdata,
                        url: '/add_file',
                    };
                    axios(options)
                        .then((response) => {
                            console.log(response.data);
                            if (response.data)
                                this.error = response.data;
                            else {
                                this.title = '';
                                this.sucsses = "Файл успішно добавлено";
                            }
                        })
                        .catch(err => console.log(err));
                }
                else
                {
                    this.error = "Заповніть всі поля";
                }
            },
            processFile() {
                this.files = this.$refs.myFiles.files;
            },
            toFormData(obj) {
                let formData = new FormData();
                // console.log(obj);
                for (var i =0; i< this.files.length;i++){
                    let file = this.files[i];
                    formData.append('files['+i+']', file);
                }
                formData.append('title', this.title);
                return formData;
            },
        }
    }
</script>

<style scoped>
    .container{
        margin: auto;
    }

    form {
        margin: auto;
    }

</style>
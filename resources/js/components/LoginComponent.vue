<template>
    <div class="container">
        <form class="form-horizontal">
            <fieldset >
                <div class="alert alert-danger" role="alert" v-if="error">
                    {{error}}
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label col-xs-2">Login</label>
                        <input v-model="user" type="email" class="form-control" id="inputEmail" placeholder="Email" required>
                </div>
                <div class="form-group" >
                    <label for="inputPassword" class="control-label col-xs-2">Password</label>
                        <input v-model="password" type="password" class="form-control" id="inputPassword" placeholder="Пароль" required>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary"  @click.prevent="login" @keydown.enter="login" >Войти</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</template>

<script>
    export default {
        name: "LoginComponent",
        data:function () {
            return {
               user:'',
                password:'',
                error:'',
            }
        },
        methods:{
            login:function () {
                if (this.user && this.password){
                    const options = {
                        method: 'POST',
                        data: {user:this.user,password: this.password},
                        url: '/login',
                    };
                    axios(options)
                    .then((response) => {
                        console.log(response.data);
                        if (response.data)
                            this.error = response.data;
                        else
                            window.location.href = '/';
                    })
                    .catch(err => console.log(err));
                }
                else
                  this.error = "Заповніть всі поля";
            }
        }
    }
</script>

<style scoped>
    .form-horizontal {
        width: 500px;
        margin: auto;
    }
    .container {
        margin: auto;
    }
</style>
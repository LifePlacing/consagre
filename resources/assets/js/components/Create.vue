<template lang="html">
  <div>
    <h2>Adicionar Novo Usuario</h2>
    <form class="form-horizontal" action="/users" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="name"> Nome: </label>
        <div class="col-sm-10">

          <input type="text" class="form-control" name="name"  id="name" v-model="name">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email"> Email: </label>
        <div class="col-sm-10">
          <input type="email" class="form-control" name="email"  id="email" v-model="email">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="password"> Senha: </label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="password"  id="password" v-model="password">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="sexo"> Sexo: </label>
        <div class="col-sm-10">
          <select class="form-control" name="sexo" id="sexo" v-model="sexo">
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="birthday"> Data de Nascimento: </label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="birthday"  id="birthday" v-model="birthday">
        </div>
      </div>

      <button type="button" name="button" class="btn btn-defeult" v-on:click="addNewUser()">Adicionar</button>

    </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      name: '',
      email: '',
      password: '',
      sexo: '',
      birthday: ''
    }
  },
  methods:{
    addNewUser(){
      axios.post('/api/users', {
          name: this.name,
          email: this.email,
          password: this.password,
          birthday: this.birthday,
          sexo: this.sexo,
      }).then(response=>{
          this.name = ''
          this.email = ''
          this.password = ''
          this.birthday = ''
          this.sexo = ''
      }).catch(error =>{
        console.log(error);
      })
    }

  }
}
</script>

<style lang="css">
</style>

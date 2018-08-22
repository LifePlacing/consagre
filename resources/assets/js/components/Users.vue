<template>
  <div>
    <table class="table">
    <thead class="thead-dark">
      <tr>
      <th scope="col">Cod</th>  <th scope="col">Nome</th> <th scope="col">E-mail</th><th scope="col">Sexo</th><th scope="col">Data de Nascimento</th><th scope="col"></th>
      </tr>
    </thead>
      <tr v-for="user in users">
      <td>{{user.id}}</td>
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
      <td>{{user.sexo}}</td>
      <td>{{user.birthday}}</td>
      <td><a href="" class="btn btn-primary"> Editar </a> || <a href="" class="btn btn-danger"> Excluir </a></td>
      </tr>

    </table>
  </div>
</template>

<script>
export default {
  data(){
    return{
      users: [],
      }
  },
  mounted(){
    this.getUsers()
  },
  methods:{
    getUsers(){
      axios.get('/api/users').then(response =>{
          this.users = response.data
      })
    }
  }
}
</script>

<style>
</style>

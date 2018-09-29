<template lang="html">
  <div class="form-group">
        <h5>CEP</h5>

          <span class="invalid-feedback" v-show="naoLocalizado">
          <strong>* CEP não encontrado ou invalido </strong>
          </span>

          <div class="form-inline">
            <input type="text" name="cep" ref="cep" id="cep" class="form-control col-sm-4 numero required" v-model="cep" v-on:keyup="buscar" maxlength="8" size="8" placeholder="00000-00" inputmode="numeric" autocomplete="off">

            <div class="col-sm-8">
              <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" class="lembra-cep" target="_blank" >
              <i class="fa fa-caret-right"></i>Não sei meu CEP</a>
            </div>
          </div>
          
              <div class="form-group">
                  <input type="text" class="form-control" name="localidade" id="localidade" v-model="endereco.localidade" placeholder="Cidade" aria-describedby="city" readonly>
              </div>

              <div class="form-group">
              <input type="text" class="form-control" name="estado" id="estado" v-model="endereco.uf" aria-describedby="address" placeholder="Estado" readonly>
              </div> 

              <div class="form-group">
                <input type="text" name ="bairro" v-model="endereco.bairro" class="form-control required" id="bairro" placeholder="Bairro">
              </div> 

              <div class="form-group">
                <label for="logradouro">Endereço</label>
                <input type="text" name="logradouro" v-model="endereco.logradouro" class="form-control required" id="logradouro" placeholder="ex: Rua Dom Pedro">
              </div>

              <div class="form-row">
                <div class="col-sm-6 mb-2">
                  <label for="unidade" class="">Número</label>
                  <input type="text" name="unidade" v-model="endereco.unidade" class="form-control numero required" pattern="[0-9]+$" id="unidade" placeholder="Para melhor localização no mapa" inputmode="numeric">
                  <div class="erro-form erro-number"></div>                  
              </div>

              <div class="col-sm-6 mb-2">
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" v-model="endereco.complemento" class="form-control" id="complemento" placeholder="ex: ap 40 bloco C">
              </div>

          </div>
  </div>

</template>

<script>
export default {

  data(){
    return{
      cep: '',
      endereco: {},
      naoLocalizado:false,
    }
  },

  methods:{
    buscar(){
      let cepNumber = jQuery(this.$refs.cep).val().replace('-', '');
      this.naoLocalizado = false;
      if (!isNaN(cepNumber) && cepNumber.length === 8) {
        $.getJSON("https://viacep.com.br/ws/" + cepNumber + "/json/", function(endereco)
          {
            if (endereco.erro) {
              this.endereco={};
              this.naoLocalizado = true;
              return;
            }
            this.endereco = endereco;                       
            
          }.bind(this));
      }
    }
  }
}
</script>

<style lang="css">


</style>

<template>

<div class="linha">

<div class="col popover__wrapper">
	<a href="#">
		<i class="fa fa-usd fa-2x" aria-hidden="true" v-if=" minpreco == 0 "></i>
		<h5 class="faixa-de-preco" v-if=" minpreco == 0 ">Preço</h5>
		<i class="fa fa-sort-desc" aria-hidden="true" v-if=" minpreco == 0 "></i>

		<h5 class="precos" v-else=" minpreco > 0 "> 
		{{ minpreco }} -até- {{ maxpreco }}<span v-if="maxpreco == 50000">+</span> 
		</h5>
	
	</a>

	  <div class="push popover__content">
	    <p class="popover__message">Faixa de Preço:</p>

	    <div class="form-group">	    	
	    	<input type="text" class="valuetxt" v-model="minpreco" name="minpreco"/>
	    	-ATÉ-
	    	<input type="text" class="valuetxt" v-model="maxpreco" name="maxpreco"/>
	    </div>
				    
		<div class="form-group">

			<span>Valor Minimo:</span>

			<input type="range" class="range" min="0" max="5000" step="100" v-model="minpreco"/>

			<span>Valor Maximo:</span>

			<input type="range" class="range" min="6000" max="50000" step="1000" v-model="maxpreco"/>

		</div>


	  </div>


</div>

<div class="col popover__wrapper">
	<a href="#">
		<i class="fa fa-bed fa-2x" aria-hidden="true"></i>
		<h5>Quartos</h5>
		<i class="fa fa-sort-desc" aria-hidden="true"></i>
	</a>

	<div class="push popover__content">
		<p class="popover__message">Quantos Quartos?</p>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="qOpt1" >
			  <label class="form-check-label" for="inlineCheckbox1">1</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2" name="qOpt2">
			  <label class="form-check-label" for="inlineCheckbox2">2</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="3" name="qOpt3">
			  <label class="form-check-label" for="inlineCheckbox3">3</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="4" name="qOpt4">
			  <label class="form-check-label" for="inlineCheckbox4">4 ou mais</label>				
			</div>
			

	</div>
</div>

<div class="col popover__wrapper">
	<a href="#">
		<i class="fa fa-bath fa-2x" aria-hidden="true"></i>
		<h5>Suites</h5>
		<i class="fa fa-sort-desc" aria-hidden="true"></i>
	</a>

	<div class="push popover__content">
		<p class="popover__message">Quantos Suítes?</p>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxs1" value="1" name="sOpt1" >
			  <label class="form-check-label" for="inlineCheckboxs1">1</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxs2" value="2" name="sOpt2">
			  <label class="form-check-label" for="inlineCheckboxs2">2</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxs3" value="3" name="sOpt3">
			  <label class="form-check-label" for="inlineCheckboxs3">3</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxs4" value="4" name="sOpt4">
			  <label class="form-check-label" for="inlineCheckboxs4">4 ou mais</label>					
			</div>


											
	</div>

</div>


<div class="col popover__wrapper">
	<a href="#">
		<i class="fa fa-car fa-2x" aria-hidden="true"></i>
		<h5>Vagas</h5>
		<i class="fa fa-sort-desc" aria-hidden="true"></i>
	</a>

	<div class="push popover__content">
		<p class="popover__message">Vagas de Garagem?</p>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxv1" value="1" name="vOpt1" >
			  <label class="form-check-label" for="inlineCheckboxv1">1</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxv2" value="2" name="vOpt2">
			  <label class="form-check-label" for="inlineCheckboxv2">2</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxv3" value="3" name="vOpt3">
			  <label class="form-check-label" for="inlineCheckboxv3">3</label>
			</div>

			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="checkbox" id="inlineCheckboxv4" value="4" name="vOpt4">
			  <label class="form-check-label" for="inlineCheckboxv4">4 ou mais</label>					
			</div>


	</div>

</div>

<div class="col popover__wrapper">
	<a href="#">
		<i class="fa fa-area-chart fa-2x" aria-hidden="true" v-if="area_inicial == 0"></i>
		<h5 v-if="area_inicial == 0" >Área</h5>
		<i class="fa fa-sort-desc" aria-hidden="true" v-if="area_inicial == 0"></i>
		<h5 v-else="area_inicial > 0" class="precos">
		{{ area_inicial }} - {{ area_final }}<span v-if="area_final == 10000">+</span> &nbspM<sup>2</sup></h5>
	</a>
	<div class="push popover__content">

		<p class="popover__message">Área (M<sup>2</sup>)</p>

	    <div class="form-group">
	    	<input type="text" class="valuetxt" name="areaInicial" v-model="area_inicial"/> 
	    	-ATÉ-
	    	<input type="text" class="valuetxt" name="areaFinal" v-model="area_final"/>
	    </div>
				    
		<div class="form-group">

			<span>De:</span>

			<input type="range" class="range" min="0" max="5000" step="50" v-model="area_inicial"/> 

			<span>Até:</span>

			<input type="range" class="range" min="6000" max="10000"  step="500" v-model="area_final" /> 
			

		</div>									

	</div>	

</div>						
</div>

</template>

<script>

export default {
  data(){
    return{
     minpreco: 0,
     maxpreco: 50000,
     area_inicial: 0,
     area_final:10000
    }
  }
}

</script>

<style lang="css">
</style>

<template>
  <div class="small">
      <h1>Estadisticas de los inmuebles</h1>
      <div>
          <div style="display:block">
              <h2>Inmuebles por ubicacion</h2>
              <donut-chart :chart-data="datacollection" :height="450"></donut-chart>
          </div>
          <div style="display:block">
              <h2>Promedio de precios por ubicacion</h2>
              <donut2-chart :chart-data="datacollection" :height="450"></donut2-chart>
          </div>
      </div>
    
  </div>
</template>

<script>

import donutChart from './mychart.js'
import donut2Chart from './mychart2.js'
export default {
  components: {
    donutChart,
    donut2Chart
  },
  data(){
    return {
      datacollection: null
    }
  },
  mounted () {

  },
  methods: {

  }
}
</script>

<style lang="css">
.small{
    text-align: center;
}
.small div{
    display: inline-flex;
}
.small div div{
            margin: 0px 0px 0px 80px;

}
.small div div h2{
            margin: 15px 0;

}
</style>
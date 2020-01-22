import { Bar } from 'vue-chartjs'
export default {
  extends: Bar,
  mounted () {
    var inm
  axios
  .get("/getallinm")
  .then(data => {
      inm=data.data
      console.log(inm)
      let charData=[["Bejuma",0,0],["Carlos Arvelo",0,0],["Diego Ibarra",0,0],["Guacara",0,0],["Juan José Mora",0,0],
      ["Libertador",0,0],["Los Guayos",0,0],["Miranda",0,0],["Montalbán",0,0],["Naguanagua",0,0],["Puerto Cabello",0,0],
      ["San Diego",0,0],["San Joaquín",0,0],["Valencia",0,0]]
      inm.forEach(inmueble => {
          charData.forEach(element => {
              if(element[0]==inmueble.ubicacion){
                  element[1]+=1
                  element[2]+=parseInt(inmueble.precio)
              }
          });
      });
      charData.forEach(a => a.splice(0, 1));
      let dataset=[]
      charData.forEach(a =>{
        if(a[1]==0 || a[0]==0){
            dataset.push(0)
        }else{
            dataset.push(Math.round(a[1]/a[0]*100)/100)
        }
        
    });
  // Overwriting base render method with actual data.
  this.renderChart({
    labels: ["Bejuma","Carlos Arvelo","Diego Ibarra","Guacara","Juan José Mora","Libertador","Los Guayos","Miranda",
    "Montalbán","Naguanagua","Puerto Cabello","San Diego","San Joaquín","Valencia"],
    datasets: [
      {
        label: 'Promedio de precios',
        backgroundColor: 'green',
        data: dataset
      }
    ]
  })
  this._data._chart.config.options.legend.display=false
  })
  
}
}